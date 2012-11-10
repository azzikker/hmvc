<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Deals_Gallery extends MX_Controller {
    public function __construct() {
        parent::__construct();
        $this->checkuser(); 
        session_start(); 
        $this->load->model('Deals_View_Model');
        $this->load->model('Deals_Model');   
        $this->load->model('Deals_Gallery_Model');
        $this->load->model('Deals_Video_Model');
        $this->load->model('Audit_Trail_Model');
        $this->load->helper("gt++");
        $this->load->helper("gt");
    }
    //authenticator
    public function checkuser() {      
        if ( $this->session->userdata('login_state') <> TRUE ) {
             redirect(base_url().'user/login');
        }
    }
    //display
    function edit_gallery_single_deal() {
        $table0 = "deal_video";
        $table1 = "deal_view";
        $table3 = "deal_gallery";  
        $data["page"] = "Deals Gallery";
        $deal_where['deal_hash'] = $this->uri->segment(5);
        $data["sql0"] = $this->Deals_Video_Model->displaySelected($table0, $deal_where);
        $data["sql1"] = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $data["sql3"] = $this->Deals_Gallery_Model->displaySelected($table3, $deal_where);
        $this->load->view("layouts/admin_layout_header");
        $this->load->view("deals/deals_gallery/edit_single_gallery_view", $data);
        $this->load->view("layouts/admin_layout_footer");
    }
    function edit_gallery_group_deal() {
        $table0 = "deal_video";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $data["page"] = "Deals Gallery";
        $deal_where['deal_hash'] = $this->uri->segment(5);
        $gallery_where['gallery_main'] = 2;
        $deal_hash = $this->uri->segment(5);
        $data["sql0"] = $this->Deals_Video_Model->displaySelected($table0, $deal_where);
        $data["sql1"] = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $data["sql2"] = $this->Deals_Model->displayGrouped($table1, $table2, $deal_hash);
        $data["sql3"] = $this->Deals_Gallery_Model->displaySelectedGallery($table3, $gallery_where);
        $this->load->view("layouts/admin_layout_header"); 
        $this->load->view("deals/deals_gallery/edit_group_gallery_view", $data);
        $this->load->view("layouts/admin_layout_footer"); 
    }
    function edit_gallery_sub_deal() {
        $table0 = "deal_video";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $data["page"] = "Deals Gallery";
        $deal_subhash['deal_subhash'] = $this->uri->segment(5);
        $sql2 = $this->Deals_Model->displaySelected($table2, $deal_subhash);
        foreach( $sql2 as $row2 ) { $deal_where['deal_hash'] = $row2->deal_hash; }
        $data["sql0"] = $this->Deals_Video_Model->displaySelected($table0, $deal_subhash);
        $data["sql1"] = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        $data["sql2"] = $this->Deals_Model->displaySelected($table2, $deal_subhash);
        $data["sql3"] = $this->Deals_Gallery_Model->displaySelected($table3, $deal_subhash);
        $this->load->view("layouts/admin_layout_header"); 
        $this->load->view("deals/deals_gallery/edit_sub_gallery_view", $data);
        $this->load->view("layouts/admin_layout_footer"); 
    }
    //process
    function update_gallery_single_deal() {
        $table0 = "deal_video";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        //tables general where start
        $deal_where['deal_hash'] = $this->uri->segment(5);
        //tables general where end 
        $customsize = array('height'=>'260','width'=>'105');
        $path = "assets/general/images/deals_gallery/";
        $sql1 = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        foreach($sql1 as $row1) { $deal_image = $row1->deal_image; }
        //deal_gallery
        $sql2 = $this->Deals_Model->displaySelected($table2, $deal_where);
        foreach($sql2 as $row2) { $subhash = $row2->deal_subhash; }
        $photo_count = xss_cleaner($_POST['nPHOTO']);
        for($i=1;$i<=$photo_count;$i++) {  
            $gallery_list['deal_hash'] = $deal_where['deal_hash'];
            $gallery_list['deal_subhash'] = $subhash;    
            //insert new deal photo 
            if($_FILES["addSDC$i"]["name"] != '') {
                $image_size_filter = image_size_filter($_FILES["addSDC$i"]["tmp_name"], 750, 263, 690, 242);
                $image_type_filter = image_type_filter($_FILES["addSDC$i"]["name"]);
                
                if($image_type_filter == "unidentified") {
                    redirect(base_url() . 'admin/admin_deals_gallery/edit_gallery_single_deal/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '?error2=1');
                }
                else {
                    if($image_size_filter == "large" || $image_size_filter == "small") {
                        redirect(base_url() . 'admin/admin_deals_gallery/edit_gallery_single_deal/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '?error1=1');
                    }
                    $deal_gallery_main = _upload_photo("addSDC$i",$path,'default.jpg','true','true','','150',$customsize);
                    $gallery_list['gallery_filename'] = $deal_gallery_main;
                    
                    $this->Deals_Gallery_Model->save_gallery($table3, $gallery_list);
                }                                      
            }
        }
        if(isset($_POST['Update'])) {
            $selected = $this->db->escape_str($_POST['editGM']);
            $view_list['deal_image'] = $selected;
            $gallery_where1['deal_subhash'] = $subhash;
            $gallery_where2['gallery_filename'] = $selected;
        }
        $gallery_list1['gallery_main'] = 0;
        $gallery_list2['gallery_main'] = 1;
        //deal_video
        $video_where['deal_subhash'] = $subhash;
        $video_list['video_embed'] = $_POST['editDV'];
        $this->Deals_Video_Model->update_video($table0, $video_where, $video_list);
        $this->Deals_View_Model->update_view($table1, $deal_where, $view_list);
        $this->Deals_Gallery_Model->update_gallery($table3, $gallery_where1, $gallery_list1);
        $this->Deals_Gallery_Model->update_gallery($table3, $gallery_where2, $gallery_list2);
        $sql = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        foreach($sql as $row) { $deal_view_title = $row->deal_view_title; }
        //audit_trail start
        $insert = audit_trail("Update", "Deals Maintenance", "Deal Gallery", $deal_view_title, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals_gallery/edit_gallery_single_deal/" . $this->uri->segment(4) . "/" . $this->uri->segment(5)); 
    }
    function update_gallery_group_deal() {
        $table1 = "deal_view";
        //tables general where start
        $deal_where['deal_hash'] = $this->uri->segment(5);
        //tables general where end
        $customsize1 = array('height'=>'260','width'=>'105');
        $customsize2 = array('height'=>'300','width'=>'200');
        $path1 = "assets/general/images/deals_gallery/";
        $path2 = "assets/general/images/background/";
        $sql1 = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        foreach($sql1 as $row1) { $filename1 = $row1->deal_image; $filename2= $row1->deal_background; }
        $view_list['deal_video'] = $_POST["editMDV"];
        if($_FILES["editMMC"]["name"] != '') {
            $image_size_filter = image_size_filter($_FILES["editMMC"]["tmp_name"], 750, 263, 690, 242);
            $image_type_filter = image_type_filter($_FILES["editMMC"]["name"]);
            
            if($image_type_filter == "unidentified") {
                redirect(base_url() . 'admin/admin_deals_gallery/edit_gallery_group_deal/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '?error2=1');
            }
            else {
                if($image_size_filter == "large" || $image_size_filter == "small") {
                    redirect(base_url() . 'admin/admin_deals_gallery/edit_gallery_group_deal/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '?error1=1');
                }
                //delete old deal photo
                unlink($path1 . "customize/$filename1");
                unlink($path1 . "optimize/$filename1");
                unlink($path1 . "thumbnail/$filename1");
                unlink($path1 . "$filename1");
                //insert new deal photo                                                  
                $deal_image = _upload_photo("editMMC",$path1,'default.jpg','true','true','','150',$customsize1);
                $view_list['deal_image'] = $deal_image;
            }
        }
        if($_FILES["editMBI"]["name"] != '') {
            
            $image_size_filter = image_size_filter($_FILES["editMBI"]["tmp_name"], 1300, "null", 1200, "null");
            $image_type_filter = image_type_filter($_FILES["editMBI"]["name"]);
            
            if($image_type_filter == "unidentified") {
                redirect(base_url() . 'admin/admin_deals_gallery/edit_gallery_group_deal/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '?error4=1');
            }
            else {
                if($image_size_filter == "large" || $image_size_filter == "small") {
                    redirect(base_url() . 'admin/admin_deals_gallery/edit_gallery_group_deal/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '?error3=1');
                }
                //delete old deal photo
                unlink($path2 . "customize/$filename2");
                unlink($path2 . "optimize/$filename2");
                unlink($path2 . "thumbnail/$filename2");
                unlink($path2 . "$filename2");
                //insert new deal photo                                                  
                $deal_background = _upload_photo("editMBI",$path2,'default.jpg','true','true','','150',$customsize2);
                $view_list['deal_background'] = $deal_background;
            }
        }
        $view_list['deal_Bcolor'] = $_POST["editMBC"];
        $view_list['deal_Bposition'] = $this->db->escape_str($_POST["editMIP"]);
        $view_list['deal_Brepeat'] = $this->db->escape_str($_POST["editMIR"]);
        $view_list['deal_Battach'] = $this->db->escape_str($_POST["editMIA"]);
        $this->Deals_View_Model->update_view($table1, $deal_where, $view_list);
        $sql = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        foreach($sql as $row) { $deal_view_title = $row->deal_view_title; }
        //audit_trail start
        $insert = audit_trail("Update", "Deals Maintenance", "Deal Gallery", $deal_view_title, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals_gallery/edit_gallery_group_deal/" . $this->uri->segment(4) . "/" . $deal_where['deal_hash']);
    }
    function update_gallery_sub_deal() {
        $table0 = "deal_video";
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        //tables general where start
        $deal_subhash['deal_subhash'] = $this->uri->segment(5);
        //tables general where end
        $customsize = array('height'=>'260','width'=>'105');
        $path = "assets/general/images/deals_gallery/";
        //deal_gallery
        $sql2 = $this->Deals_Model->displaySelected($table2, $deal_subhash);
        foreach($sql2 as $row2) { $deal_hash = $row2->deal_hash; }
        $photo_count = $this->db->escape_str($_POST['nPHOTO']);
        for($i=1;$i<=$photo_count;$i++) {
            $gallery_list['deal_hash'] = $deal_hash;
            $gallery_list['deal_subhash'] = $deal_subhash['deal_subhash'];    
            //insert new deal photo  
            if($_FILES["addSDC$i"]["name"] != '') {
                $image_size_filter = image_size_filter($_FILES["addSDC$i"]["tmp_name"], 750, 263, 690, 242);
                $image_type_filter = image_type_filter($_FILES["addSDC$i"]["name"]);
                
                if($image_type_filter == "unidentified") {
                    redirect(base_url() . 'admin/admin_deals_gallery/edit_gallery_sub_deal/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '?error2=1');
                }
                else {
                    if($image_size_filter == "large" || $image_size_filter == "small") {
                        redirect(base_url() . 'admin/admin_deals_gallery/edit_gallery_sub_deal/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '?error1=1');
                    }
                    $deal_gallery_main = _upload_photo("addSDC$i",$path,'default.jpg','true','true','','150',$customsize);
                    $gallery_list['gallery_filename'] = $deal_gallery_main;
                    
                    $this->Deals_Gallery_Model->save_gallery($table3, $gallery_list);
                }                                               
            }
        }
        if(isset($_POST['Update'])) {
            $selected = $_POST['editGM'];
            $view_list['deal_image'] = $selected;
            $gallery_where1['deal_subhash'] = $deal_subhash['deal_subhash'];
            $gallery_where2['gallery_filename'] = $selected;
        }
        $gallery_list1['gallery_main'] = 0;
        $gallery_list2['gallery_main'] = 2;
        //deal_video
        $video_where['deal_subhash'] = $deal_subhash['deal_subhash'];
        $video_list['video_embed'] = $_POST['editDV'];
        $this->Deals_Video_Model->update_video($table0, $video_where, $video_list);
        $this->Deals_Gallery_Model->update_gallery($table3, $gallery_where1, $gallery_list1);
        $this->Deals_Gallery_Model->update_gallery($table3, $gallery_where2, $gallery_list2);
        $sql = $this->Deals_Model->displaySelectedSubFull($table1, $table2, $deal_subhash['deal_subhash']);
        foreach($sql as $row) { $deal_view_title = $row->deal_view_title; $deal_title = $row->deal_title; }
        //audit_trail start
        $insert = audit_trail("Update", "Deals Maintenance", "Sub Deal Gallery", "<span id=\"green\">" . $deal_view_title . "</span><br>" . $deal_title, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals_gallery/edit_gallery_sub_deal/" . $this->uri->segment(4) . "/" . $this->uri->segment(5));
    }
    function delete_gallery_single_deal() {
        $table1 = "deal_view";
        $table3 = "deal_gallery";
        $deal_where['deal_hash'] = $this->uri->segment(6);
        $path = "assets/general/images/deals_gallery/";
        $sql1 = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        foreach($sql1 as $row1) { $deal_type = $row1->deal_view_type; $deal_image = $row1->deal_image; }
        //start of selection_id decryption
        $g_count = $this->uri->segment(4);
        $g_hash = $this->uri->segment(5);
        $g_length = strlen($g_hash); 
        $g_character = $g_count; 
        $g_start = $g_length - $g_character;
        $g_code = substr($g_hash , $g_start ,$g_character);
        $gallery_where['gallery_id'] = (($g_code)-8)/8;
        //end of selection_id decryption
        $sql3 = $this->Deals_Gallery_Model->displaySelected($table3, $gallery_where);
        foreach($sql3 as $row3) { $filename2 = $row3->gallery_filename; }
        if($filename2 != $deal_image) {
            //deal_gallery
            unlink($path . "customize/$filename2");
            unlink($path . "optimize/$filename2");
            unlink($path . "thumbnail/$filename2");
            unlink($path . "$filename2");
            $this->Deals_Gallery_Model->delete_gallery($table3, $gallery_where);
        } 
        $sql = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        foreach($sql as $row) { $deal_view_title = $row->deal_view_title; }
        //audit_trail start
        $insert = audit_trail("Update", "Deals Maintenance", "Deal Gallery", $deal_view_title, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals_gallery/edit_gallery_single_deal/" . $deal_type . "/" . $deal_where['deal_hash']);
    }
    function delete_gallery_sub_deal() {
        $table1 = "deal_view";
        $table2 = "deals";
        $table3 = "deal_gallery";
        $deal_where['deal_subhash'] = $this->uri->segment(6);
        $path = "assets/general/images/deals_gallery/";
        $sql2 = $this->Deals_Model->displaySelected($table2, $deal_where);
        foreach($sql2 as $row2) { $deal_hash['deal_hash'] = $row2->deal_hash; }
        $sql1 = $this->Deals_View_Model->displaySelected($table1, $deal_hash);
        foreach($sql1 as $row1) { $deal_type = $row1->deal_view_type; }
        //start of selection_id decryption
        $g_count = $this->uri->segment(4);
        $g_hash = $this->uri->segment(5);
        $g_length = strlen($g_hash); 
        $g_character = $g_count; 
        $g_start = $g_length - $g_character;
        $g_code = substr($g_hash , $g_start ,$g_character);
        $gallery_where['gallery_id'] = (($g_code)-8)/8;
        //end of selection_id decryption
        $sql3 = $this->Deals_Gallery_Model->displaySelected($table3, $gallery_where);
        foreach($sql3 as $row3) { $filename2 = $row3->gallery_filename; }
        //deal_gallery
        unlink($path . "customize/$filename2");
        unlink($path . "optimize/$filename2");
        unlink($path . "thumbnail/$filename2");
        unlink($path . "$filename2");
        $this->Deals_Gallery_Model->delete_gallery($table3, $gallery_where);
        $sql = $this->Deals_Model->displaySelectedSubFull($table1, $table2, $deal_where['deal_subhash']);
        foreach($sql as $row) { $deal_view_title = $row->deal_view_title; $deal_title = $row->deal_title; }
        //audit_trail start
        $insert = audit_trail("Update", "Deals Maintenance", "Sub Deal Gallery", "<span id=\"green\">" . $deal_view_title . "</span><br>" . $deal_title, $this->session->userdata('user_id'));
        $this->Audit_Trail_Model->save_audit("audit_trail", $insert);
        //audit_trail end
        redirect(base_url() . "admin/admin_deals_gallery/edit_gallery_sub_deal/" . $deal_type . "/" . $deal_where['deal_subhash']);
    }
    function remove_background() {
        $table1 = "deal_view";
        $deal_type = $this->uri->segment(4);
        $deal_where['deal_hash'] = $this->uri->segment(5);
        $path = "assets/general/images/background/";
        $view_list["deal_background"] = "";
        $sql1 = $this->Deals_View_Model->displaySelected($table1, $deal_where);
        foreach($sql1 as $row1) { $filename = $row1->deal_background; }
        unlink($path . "customize/$filename");
        unlink($path . "optimize/$filename");
        unlink($path . "thumbnail/$filename");
        unlink($path . "$filename");
        $this->Deals_View_Model->update_view($table1, $deal_where, $view_list);
        redirect(base_url() . "admin/admin_deals_gallery/edit_gallery_group_deal/" . $deal_type . "/" . $deal_where['deal_hash']);
    }
    
    ///////////////////////////////////
    ////////added functions////////////
    ///////////////////////////////////
    
    function upload_temp_image()
    {
        //set config for upload library
        $config['upload_path'] = FCPATH.'/assets/general/images/deals_gallery/temp/';
        $config['allowed_types'] = 'jpg';//jpeg only
        $config['max_size'] = 9999;//IDK final file max size
        $config['file_name'] = sha1(time().mt_rand());//random filename
        
        //load libraries
        $this->load->library('upload', $config);
        $this->load->library('image_lib');
        
        //validate uload
        if(!$this->upload->do_upload())
        {
            //return an error if file is not valid jpeg as json object
            echo json_encode(array('error' => $this->upload->display_errors('', '')));
        }
        else
        {
            //upload success
            
            //set variables from uploaded data
            $img_properties = $this->upload->data();
            $img_web_path = base_url().'assets/general/images/deals_gallery/temp/'.$img_properties['file_name'];
            
            //config to resize uploaded image
			$config2['image_library'] = 'gd2';
			$config2['source_image'] = $img_properties['full_path'];
			$config2['maintain_ratio'] = true;
			$config2['width'] = 1000;
			$config2['height'] = 800;
			$config2['new_image'] = FCPATH.'/assets/general/images/deals_gallery/temp/';
            
            //initialize config
			$this->image_lib->initialize($config2);
            
			//resize uploaded image 
			$this->image_lib->resize();
            
            //return a success message including web path as json object
			echo json_encode(array('path' => $img_web_path, 'file_name' => $img_properties['file_name'], 'error' => ""));
        }
    }
    
    function submit_crop()
	{
	   //cropping coords
        $current_path = $this->input->post('current_path', true);
        $file_name = $this->input->post('file_name', true);
        $x = $this->input->post('x', true);
        $y = $this->input->post('y', true);
        $tw = $this->input->post('tw', true);
        $th = $this->input->post('th', true);
        $w = $this->input->post('w', true);
        $h = $this->input->post('h', true);
        
        $split_path = preg_split('/[\/]+/', $current_path);
        $path_hash = end($split_path);
        
        //check image count
        $pic_count = $this->Deals_Gallery_Model->count_saved_image_of_hash($path_hash);
        if($pic_count == 5 or $pic_count > 5)
        {
            echo json_encode(array('error' => 'image limit reached'));
            exit();
        }
                
		$jpeg_quality = 100;
	    $src = FCPATH.'\assets\general\images\deals_gallery\temp\\'.$file_name;
	    $img_r = imagecreatefromjpeg($src);
	    $dst_r = imagecreatetruecolor($tw, $th);
        
        //$cropped_filename = $file_name;
        $cropped_filename = sha1(time().mt_rand()).'.jpg';
	 	$cropped_filename_path = FCPATH.'\assets\general\images\deals_gallery\cropped\\'.$cropped_filename;
        $web_path = base_url().'assets/general/images/deals_gallery/cropped/'.$cropped_filename;

	    imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $tw, $th, $w, $h);
	    imagejpeg($dst_r, $cropped_filename_path, $jpeg_quality);

        //create thumb, optimize and customize(IDK library i created my own function)
        $this->image_save('thumbnail', $cropped_filename_path);
        $this->image_save('customize', $cropped_filename_path);
        $this->image_save('optimize', $cropped_filename_path);
        
        //save to file_name to database
        $this->Deals_Gallery_Model->save_croppped_image_file_name($cropped_filename, $path_hash);
        
        //output json
        echo json_encode(array( 'error' => '', 'path' => $web_path, 'file_name' => $cropped_filename, 'path_hash' => $path_hash));
	}
    
    function image_save($type, $img_src)
    {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
		$config['source_image'] = $img_src;
		$config['maintain_ratio'] = true;
        
        switch ($type)
        {
            case 'thumbnail':
                $config['width'] = 150;
                $config['height'] = 52;
                $config['new_image'] = FCPATH.'/assets/general/images/deals_gallery/thumbnail/';
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                break;
            case 'customize':
                $config['width'] = 260;
                $config['height'] = 105;
                $config['new_image'] =  FCPATH.'/assets/general/images/deals_gallery/customize/';
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                break;
            case 'optimize':
                $config['width'] = 750;
                $config['height'] = 263;
                $config['new_image'] =  FCPATH.'/assets/general/images/deals_gallery/optimize/';
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                break;
            default:
                die('error saving image!');
        }
    }
}            
?>         
