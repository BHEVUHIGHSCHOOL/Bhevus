<?php require('connection/conect.php');?>
<?php
if(isset($_POST['submit']))
{
	$doc_name = $_POST['doc_name'];
	$myfile = $_FILES['myfile']['name'];
	$tmp_name = $_FILES['myfile']['tmp_name'];
	
	if($myfile && $doc_name)
	{
		$location = "documents/$myfile";
		$quer = $con -> query("INSERT INTO images (imagename,imagepath) Values('$doc_name','$location')");
	}
	else
	{
		die("Failed to upload");
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Upload documnts</title>
</head>

<body>
	<form action="upload.php" method="post" enctype="multipart/form-data">
    	<label>Document name</label>
        <input type="text" name="doc_name">
        <input type="file" name="myfile">
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>