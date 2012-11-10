<?php
	function _like_textarea($str)
	{
		$str = preg_replace("/(\r\n|\n|\r)/", "", $str); return preg_replace("==i", "\n", $str);
	}
    /* START OF GT++ UPLOADING METHOD */
    function _upload_photo($name, $path, $old = 'default.jpg', $optimize = true, $thumbs = true , $orig = false, $thumbsize = 150, $custom_size = array('height'=>'100','width'=>'100'))
    {
        if(isset($old))
        {
            if($old != 'default.jpg')
            {
                unlink($path . 'optimize/' . $old);
                unlink($path . 'thumbnail/' . $old);                 
            }
        }

        /* ESTABLISH A FILENAME */
        $filename = time() . rand(10000,99999) .  ".jpg";
        $original_path = $path . $filename; 

        /* UPLOAD */
        if ($_FILES["$name"]["error"] > 0)
        {
            echo "Error: " . $_FILES["$name"]["error"] . "<br />";
        }
        else
        {
            move_uploaded_file($_FILES["$name"]["tmp_name"], $original_path);
        }                     


        if($optimize == true)
        {          
            $optimize_path = $path . 'optimize/'; 
            if (is_dir($optimize_path) == false)
            {
                mkdir($optimize_path);     
            }
            $optimize_path = $optimize_path . $filename;
            save_image($original_path, $optimize_path);           
        }
        if($thumbs == true)
        {
            $thumnail_path = $path . 'thumbnail/'; 
            if (is_dir($thumnail_path) == false)
            {
                mkdir($thumnail_path);     
            }            
            $thumnail_path = $thumnail_path . $filename;
            save_image($optimize_path, $thumnail_path, $thumbsize);  
        }
		 
		if(isset($custom_size))
		{
            $customize_path = $path . 'customize/'; 
            if (is_dir($customize_path) == false)
            {
                mkdir($customize_path);     
            }            
            $customize_path = $customize_path . $filename;
            save_image_custom($original_path , $customize_path, $custom_size['height'], $custom_size['width']); 		
		}
				    
        if($orig == false)
        {
            unlink($original_path);
        }

        return $filename;   
    }  
    function _upload_photoPNG($name, $path, $old = 'default.jpg', $optimize = true, $thumbs = true , $orig = false, $thumbsize = 150, $custom_size = array('height'=>'100','width'=>'100'))
    {
        if(isset($old))
        {
            if($old != 'default.png')
            {
                unlink($path . 'optimize/' . $old);
                unlink($path . 'thumbnail/' . $old);                 
            }
        }

        /* ESTABLISH A FILENAME */
        $filename = time() . rand(10000,99999) .  ".png";
        $original_path = $path . $filename; 

        /* UPLOAD */
        if ($_FILES["$name"]["error"] > 0)
        {
            echo "Error: " . $_FILES["$name"]["error"] . "<br />";
        }
        else
        {
            move_uploaded_file($_FILES["$name"]["tmp_name"], $original_path);
        }                     


        if($optimize == true)
        {          
            $optimize_path = $path . 'optimize/'; 
            if (is_dir($optimize_path) == false)
            {
                mkdir($optimize_path);     
            }
            $optimize_path = $optimize_path . $filename;
            save_image($original_path, $optimize_path);           
        }
        if($thumbs == true)
        {
            $thumnail_path = $path . 'thumbnail/'; 
            if (is_dir($thumnail_path) == false)
            {
                mkdir($thumnail_path);     
            }            
            $thumnail_path = $thumnail_path . $filename;
            save_image($optimize_path, $thumnail_path, $thumbsize);  
        }
         
        if(isset($custom_size))
        {
            $customize_path = $path . 'customize/'; 
            if (is_dir($customize_path) == false)
            {
                mkdir($customize_path);     
            }            
            $customize_path = $customize_path . $filename;
            save_image_custom($original_path , $customize_path, $custom_size['height'], $custom_size['width']);         
        }
                    
        if($orig == false)
        {
            unlink($original_path);
        }

        return $filename;   
    }  
 	function _copy_photo($web_path, $path, $optimize = true, $thumbs = true , $orig = false, $thumbsize = 150, $custom_size = array('height'=>'100','width'=>'100'))
    {
        /* ESTABLISH A FILENAME */
        $filename = time() . rand(10000,99999) .  ".jpg";
        $original_path = $path . $filename; 

        /* COPY */
		copy($web_path, $original_path);                  

        if($optimize == true)
        {          
            $optimize_path = $path . 'optimize/'; 
            if (is_dir($optimize_path) == false)
            {
                mkdir($optimize_path);     
            }
            $optimize_path = $optimize_path . $filename;
            save_image($original_path, $optimize_path);           
        }
        if($thumbs == true)
        {
            $thumnail_path = $path . 'thumbnail/'; 
            if (is_dir($thumnail_path) == false)
            {
                mkdir($thumnail_path);     
            }            
            $thumnail_path = $thumnail_path . $filename;
            save_image($optimize_path, $thumnail_path, $thumbsize);  
        }  
		
		if(isset($custom_size))
		{
            $customize_path = $path . 'customize/'; 
            if (is_dir($customize_path) == false)
            {
                mkdir($customize_path);     
            }            
            $customize_path = $customize_path . $filename;
            save_image_custom($original_path , $customize_path, $custom_size['height'], $custom_size['width']); 		
		}
				   
        if($orig == false)
        {
            unlink($original_path);
        }

        return $filename;   
    }  
    function save_image($image_to_save, $save_as, $size_limit = 0, $quality = 75)
    {
        $scr_image = create_source_from_img($image_to_save);
        list($src_width, $src_height) = getimagesize($image_to_save);
        $new_size = size_converter($src_width, $src_height, $size_limit);
        $temp_image = imagecreatetruecolor($new_size['width'], $new_size['height']);
        imagecopyresampled($temp_image, $scr_image, 0, 0, 0, 0, $new_size['width'], $new_size['height'], $src_width, $src_height);
        if(!imagejpeg($temp_image, $save_as, $quality));
    }
    function save_image_custom($image_to_save, $save_as, $new_height, $new_width)
    {
		$quality = 75;
		$size_limit = 0;
        $scr_image = create_source_from_img($image_to_save);
        list($src_width, $src_height) = getimagesize($image_to_save);
        $new_size = size_converter($new_height, $new_width, $size_limit);
        $temp_image = imagecreatetruecolor($new_size['width'], $new_size['height']);
        imagecopyresampled($temp_image, $scr_image, 0, 0, 0, 0, $new_size['width'], $new_size['height'], $src_width, $src_height);
        if(!imagejpeg($temp_image, $save_as, $quality));
    }	

    /* GT Upload Support Function */
    function size_converter($src_width, $src_height, $size_limit = 0)
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
    function create_source_from_img($image_file)
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

?>
