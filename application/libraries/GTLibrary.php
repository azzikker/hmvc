<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class GTLibrary
{
		//Function Construct
	    public function __construct()
	    {
		    
	    }
		//JSON Combo Model
		public function JSONComboModel($tblName,$FieldID,$FieldData,$FieldWhere)
		{
			if (!$ID) { $query = $this->db->query("select $FieldID as ID, $FieldData as DATA from $tblName"); }
			else { $query = $this->db->query("select $FieldID as ID, $FieldData as DATA from $tblName where $FieldWhere = '$ID'"); }
			return $query;							
		}
		//JSON Combo Controller
		public function JSONComboController()
		{
			$ID = $this->uri->segment(3);
			$data["query"] = $this->gsector_model->selectGSectorCombo($ID);		
			echo json_encode($data['query']->result());	
		}
		
		/** GT UPLOAD
		 * Upload a Picture into 3 Different Folder (Optimize, Thumbs and Original)
		 * @author: Guillermo Tabligan
		 * @param string $filename: "File Name for your picture"
		 * @param string $origpath: "Path (Original Picture)"
		 * @param string $optipath: "Path (Optimize Picture)"
		 * @param string $thumpath: "Path (Thumbnail Picture)"
		 * @return: void
		 */
        public function gtupload($filename, $origpath, $optipath, $thumbpath)
        {  
            $config['upload_path'] = $origpath;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']    = '999';
            $config['max_width']  = '1024';
            $config['max_height']  = '999';
            $config['overwrite'] = true;
    
            $CI =& get_instance();
            $CI->load->library('upload', $config);
    
            if ( ! $CI->upload->do_upload())
            {
                $error = array('error' => $CI->upload->display_errors());
                echo("Error Code: 001<br>");
                foreach($error as $err)
                {
                    echo($err . "<br>");    
                }
                die();
            }
            else
            {               
                $original_path = $config['upload_path'] .  $_FILES["userfile"]['name'];
                $data = array('upload_data' => $CI->upload->data());
                //original
                rename($original_path, $config['upload_path'] . $filename);
                $original_path = $config['upload_path'] . $filename;
				//optimize
                $optimize_path = $optipath .  $filename; 
                $this->save_image($original_path, $optimize_path);
                //thumnail
                $thumnail_path = $thumbpath . $filename; 
                $this->save_image($optimize_path, $thumnail_path, 200); 
                
                //delete orig
                $this->deleteimage($original_path);
            }             
        }
		
        /* GT Upload Support Function */
		public function save_image($image_to_save, $save_as, $size_limit = 0, $quality = 75)
		{
			$scr_image = $this->create_source_from_img($image_to_save);
			list($src_width, $src_height) = getimagesize($image_to_save);
			$new_size = $this->size_converter($src_width, $src_height, $size_limit);
			$temp_image = imagecreatetruecolor($new_size['width'], $new_size['height']);
			imagecopyresampled($temp_image, $scr_image, 0, 0, 0, 0, $new_size['width'], $new_size['height'], $src_width, $src_height);
			if(!imagejpeg($temp_image, $save_as, $quality));
		}
		
		/* GT Upload Support Function */
		
		private function size_converter($src_width, $src_height, $size_limit = 0)
		{
			$new_size = array('width' => $src_width, 'height' => $src_height);
			if(!$size_limit) return $new_size;
			if($src_width > $src_height)
			{
				if($src_width < $size_limit) $new_width = $src_width;
				else $new_width = $size_limit;
				$new_height=($src_height/$src_width)*$new_width;
			}
			else 
			{
				if($src_height < $size_limit) $new_height = $src_height;
				else $new_height = $size_limit;
				$new_width = ($src_width/$src_height)*$new_height;
			}
			$new_size = array('width' => $new_width, 'height' => $new_height);
			return $new_size;
		}
		/* GT Upload Support Function */
		private function create_source_from_img($image_file)
		{
			$scr_image = '';
			switch(exif_imagetype($image_file))
			{
				case IMAGETYPE_GIF:
				$scr_image = imagecreatefromgif($image_file);
				break;
				case IMAGETYPE_JPEG:
				$scr_image = imagecreatefromjpeg($image_file);
				break;
				case IMAGETYPE_PNG:
				$scr_image = imagecreatefrompng($image_file);
				break;
				case IMAGETYPE_BMP:
				$scr_image = imagecreatefromwbmp($image_file);
				break;
			}
			return $scr_image;
			imagedestroy($scr_image);
		}
		
		/* GT Upload Support Function */
		public function grayscalecopy($targetfile, $outputfile){
			$size = GetImageSize($targetfile);
			$width = $size[1];
			$height = $size[0];
			$canvas = imagecreatetruecolor($width, $height);
			$sourceimage = imagecreatefromjpeg($targetfile);
			imagefilter($sourceimage, IMG_FILTER_GRAYSCALE);
			imagecopy($canvas, $sourceimage, 0, 0, 0, 0, $width, $height);
			imagejpeg($canvas, $outputfile, 95);
			imagedestroy($sourceimage);
			imagedestroy($canvas);
			echo "Converted ".$targetfile." to grayscale as ".$outputfile." ".$width."x".$height."<br/>";
		}
		
		/* GT Upload Support Function */
		public function multiple_upload($nooffiles, $optimizedpath, $thumbpath, $origpath)
        {
			if(!is_dir($optimizedpath))
			{
				if (!mkdir($optimizedpath, 0, true)) {
					die('Failed to create folders for the path'. $optimizepath);
				}
			}
			
			if(!is_dir($thumbpath))
			{
				if (!mkdir($thumbpath, 0, true)) {
					die('Failed to create folders for the path'. $thumbpath);
				}
			}
			
			if(!is_dir($origpath))
			{
				if (!mkdir($origpath, 0, true)) {
					die('Failed to create folders for the path'. $origpath);
				}
			}
			
			$CI =& get_instance();
			$CI->load->library('upload');  
			$CI->load->library('session');
			
			for($i=0; $i<$nooffiles; $i++)
			{
			   $_FILES['userfile']['name']    = $_FILES['filename']['name'][$i];
			   $_FILES['userfile']['type']    = $_FILES['filename']['type'][$i];
			   $_FILES['userfile']['tmp_name'] = $_FILES['filename']['tmp_name'][$i];
			   $_FILES['userfile']['error']       = $_FILES['filename']['error'][$i];
			   $_FILES['userfile']['size']    = $_FILES['filename']['size'][$i];
				
				if($_FILES['userfile']['error'] == 4)
				{
					$img[$i] = '';	
				}
				else
				{
				   //get the users user type, id and users last upload, then append it to the image name...
				   $toconcat = $CI->session->userdata('user_type') .'_'.$CI->session->userdata('user_id') . '_' .$CI->getlastupload();
				   $config['file_name']    = $toconcat.strtolower($_FILES['userfile']['name']);
				   
				   //save a optimize and thumbnail copy to the corresponding folders
				   $this->save_image($_FILES['userfile']['tmp_name'], $optimizedpath. $config['file_name'], '1024', 70);
				   $this->save_image($_FILES['userfile']['tmp_name'], $thumbpath. $config['file_name'], '150', 80);
	
				   $config['upload_path']   = $origpath;
				   $config['allowed_types'] = 'jpg|jpeg|gif|png|psd';
				   $config['max_size']      = 999999;
				   $config['overwrite']     = FALSE;
				  $CI->upload->initialize($config);
				  
				  $img[$i] =  str_replace(" ","_",$config['file_name']);
		
				  if($CI->upload->do_upload())
				  {

						$CI->incrementlastupload(); 
				  }
				  else
				  {
						$error = array('error' => $CI->upload->display_errors());
						print_r($error);
				
				  }
				}
			}
			
			return $img;
		}
		
		/*GT Upload Support Function */
		public function deleteimage($path)
		{
			@unlink($path);
		} 
        public function random_pic($dir = 'assets/images')
        {
            $files = glob($dir . '/*.jpg*');
            $file = array_rand($files);
            return $files[$file];        
        }        
}
