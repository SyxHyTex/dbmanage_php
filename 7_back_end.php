<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project 7 - Back End</title>

    <!-- File inclusions; CSS / PHP inclusive-->
	<link rel="stylesheet" type="text/css" href="../includes/generic.css" />
</head>

<body>
<?php
#Menu Section
echo '<div id="container">
	<h1>Data Management: Back End</h1>';
	
echo '<a href="add.php?action=form_create">Add a Record</a> | 
	  <a href="remove.php?action=list_records">Delete a Record</a> | 
	  <a href="modify.php?action=list_records">Modify a Record</a><br />';
	

	

	echo '</div><br />';

	#Navigation inclusion.
	include '../includes/nav_bar.php';
?>
</body>
</html>