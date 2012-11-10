<?php // V.1.4
/*
 V1.4.0
 added base_width_convert_resize method for resizing the width of photo but preserving the ratio.

 V1.3.0
 added enlarge_photo method to enlarge small photo.

 V1.2.0
 add_convert_image and add_crop_image now accept image from string or from file name.

 V1.2.0
 remove checking of is_file from create_source_from_img that prevent saving file from external server.
 
 V1.2.0
 fix create_source_from_img() bug that prevent certain jpg file to recognize as invalid jpg image.
 (change imagecreatefromjpg to imagecreatefromstring)

 V1.1
 added progressive option to image
 image::add_convert_image($source_image_location, $new_image_location, $size_limit = 0, $quality = 75, $progressive = false)
 image::add_crop_image($source_image_location, $new_image_location, $image_height = 0, $image_width = 0, $quality = 75, $progressive = false)
*/
class image
{
	// Public
	public function base_width_convert_resize($source_image_location, $new_image_location, $width = 320, $quality = 75, $progressive = false)
	{
		if(!$image_source = $this->create_source_from_img($source_image_location)) return false;
		$src_width = imagesx($image_source);
		$src_height = imagesy($image_source);
		if($src_width < $width) $new_size = array('width' => $src_width, 'height' => $src_height );
		else $new_size = array('width' => $width, 'height' => ($src_height/$src_width)*$width );
		$temp_image = imagecreatetruecolor($new_size['width'], $new_size['height']);
		imagecopyresampled($temp_image, $image_source, 0, 0, 0, 0, $new_size['width'], $new_size['height'], $src_width, $src_height);
		imageinterlace($temp_image, $progressive);
		if(!imagejpeg($temp_image, $new_image_location, $quality)) return false;
		return $new_size;
	}
	public function add_convert_image($source_image_location, $new_image_location, $size_limit = 0, $quality = 75, $progressive = false, $resize_if_smaller_than = 500)
	{
		if(!$image_source = $this->create_source_from_img($source_image_location)) return false;
		$src_width = imagesx($image_source);
		$src_height = imagesy($image_source);
		$enlarge_size = $this->enlarge_photo($src_width, $src_height, $resize_if_smaller_than);
		$new_size = $this->size_converter($enlarge_size['width'], $enlarge_size['height'], $size_limit);
		$temp_image = imagecreatetruecolor($new_size['width'], $new_size['height']);
		imagecopyresampled($temp_image, $image_source, 0, 0, 0, 0, $new_size['width'], $new_size['height'], $src_width, $src_height);
		imageinterlace($temp_image, $progressive);
		if(!imagejpeg($temp_image, $new_image_location, $quality)) return false;
		return $new_size;
	}
	public function add_crop_image($source_image_location, $new_image_location, $image_height = 0, $image_width = 0, $quality = 75, $progressive = false)
	{
		if(!$image_source = $this->create_source_from_img($source_image_location)) return false;
		if(!$image_width || !$image_height)
		{
			$image_width  = imagesx($image_source);
			$image_height = imagesy($image_source);
			$width_new	= imagesx($image_source);
			$height_new	= imagesy($image_source);
			$src_x = 0;
			$src_y = 0;
		}
		else list($width_new, $height_new, $src_x, $src_y) = $this->image_size_zoom($image_width, $image_height, imagesx($image_source), imagesy($image_source));
		$image_thumb = imagecreatetruecolor($image_width, $image_height);
		imagecopyresampled($image_thumb, $image_source, 0, 0, $src_x, $src_y, $image_width, $image_height, $width_new, $height_new);
		imageinterlace($image_thumb, $progressive);
		if(!imagejpeg($image_thumb, $new_image_location)) return false;
		return array('width' => $image_width, 'height' => $image_height );
	}
	
	// Private
	protected function create_source_from_img($image_file)
	{
		return imagecreatefromstring(file_get_contents($image_file));
	}
	protected function enlarge_photo($src_width, $src_height, $resize_if_lower_than = 0)
	{
		if(!$resize_if_lower_than) return array('width' => $src_width, 'height' => $src_height);
		if($src_width > $src_height)
		{
			if($src_width < $resize_if_lower_than)
			{
				$new_width = $resize_if_lower_than;
				$new_height = ($src_height/$src_width)*$new_width;
				return array('width' => $new_width, 'height' => $new_height);
			}
			return array('width' => $src_width, 'height' => $src_height);
		}
		else 
		{
			if($src_height < $resize_if_lower_than)
			{
				$new_height = $resize_if_lower_than;
				$new_width = ($src_width/$src_height)*$new_height;
				return array('width' => $new_width, 'height' => $new_height);
			}
			return array('width' => $src_width, 'height' => $src_height);
		}
	}
	protected function size_converter($src_width, $src_height, $size_limit = 0)
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
	protected function image_size_zoom($zoom_width, $zoom_height, $image_width, $image_height)
	{
		$zoom_width_ratio = $zoom_width/$zoom_height;
		$zoom_height_ratio = $zoom_height/$zoom_width;
		$image_width_ratio = $image_width/$image_height;
		$image_height_ratio = $image_height/$image_width;
		
		if($zoom_width_ratio > $zoom_height_ratio)
		{
			if($zoom_width_ratio > $image_width_ratio)
			{
				$new_width = $image_width;
				$new_height = $zoom_height_ratio*$image_width;
				$new_x = 0;
				$new_y = ($image_height-$new_height)/(2);
			}
			else
			{
				$new_width = $zoom_width_ratio*$image_height;
				$new_height = $image_height;
				$new_x = ($image_width-$new_width)/(2);
				$new_y = 0;
			}
		}
		else
		{
			if($zoom_height_ratio > $image_height_ratio)
			{
				$new_width = $zoom_width_ratio*$image_height;
				$new_height = $image_height;
				$new_x = ($image_width-$new_width)/(2);
				$new_y = 0;
			}
			else
			{
				$new_width = $image_width;
				$new_height = $zoom_height_ratio*$image_width;
				$new_x = 0;
				$new_y = ($image_height-$new_height)/(2);
			}
		}
		$new_size = array($new_width, $new_height, $new_x, $new_y);
		return $new_size;
	}
}
?>
<?php /*
autoload.php "libraries= the class must be registered first"

$deal_gallery_main = $this->image->add_convert_image($_FILES["addSDC$i"]["tmp_name"] ,$path . "/" . $_FILES["addSDC$i"]["name"]);
examples:
*/ ?>