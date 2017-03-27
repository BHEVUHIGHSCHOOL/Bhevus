<?php require ('connection/conect.php');?>
<?php
session_start();
$doc_name = "Report".$_SESSION["ID_number"];
$doc_name2 = "ID/Certeficate".$_SESSION["ID_number"];
$pic = $con -> query ("select * from images where imagename = '$doc_name'");
$pic2 = $con -> query ("select * from images where imagename = '$doc_name2'");
while ($res = $pic ->fetch_array(MYSQLI_BOTH))
{
	$docs = $res[1];
}
while ($res2 = $pic2 ->fetch_array(MYSQLI_BOTH))
{
	$docs2 = $res2[1];
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<table style="width:100%; height:100% auto;">
	<tr>
    	<td><iframe style="width:100%; height:800px;" frameborder="0" src = "document/<?php echo $docs++; ?>"></td>
    </tr>
</table>
<table style="width:100%; height:100% auto;">
	<tr>
    	<td><iframe style="width:100%; height:800px;" frameborder="0" src = "document/<?php echo $docs2++; ?>"></td>
    </tr>
</table>
</body>
</html>