<?php 
	if(isset($_POST['upload']) && $_FILES['file']['tmp_name'])
	{
		// Save the image if any
		echo 'success';
	}
	
	else
	{
		// error cancel saving file
		echo 'The file maybe over size or no file uploaded';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Files</title>
</head>

<body>
<form action="" enctype="multipart/form-data" method="post">
	<input type="file" name="file" />
    <input type="submit" name="upload" value="upload" />
    
    <!-- Max file size 4 mb -->
    <input type="hidden" name="MAX_FILE_SIZE" value="4194304" /> 

</form>
</body>
</html>