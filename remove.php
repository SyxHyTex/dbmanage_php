<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Database: Remove</title>
	<!-- File inclusions; CSS / PHP inclusive-->
    <?php include '../includes/db_connect.php'; ?>
	<link rel="stylesheet" type="text/css" href="../includes/generic.css" />
</head>

<body>
<?php

echo '<div id="container">
<h1>Data Management: Back End</h1>';
	
echo '<a href="add.php?action=form_create">Add a Record</a> | 
	  <em>Delete a Record</em> | 
	  <a href="modify.php?action=list_records">Modify a Record</a><br />';

#control logic is here, directs functionality by GET action variable
if(isset($_GET['action']))	{ $action=$_GET['action']; }

switch ($action)
{
case 'list_records':
list_records();
break;	

case 'confirm':
confirm();
break;

case 'delete':
delete();
break;
}


function list_records()
{
global $db, $result, $query;
	
#Select every value from the shark_loan_form table for later output.
$query = "SELECT customer_id,First_name,Last_name FROM shark_loan_form ORDER BY Last_name,First_name";
	
if($result = $db->query($query))
{
	$num_rows = $result->num_rows;
	#printf("Result has %d rows. \n", $num_rows);
	$num_fields = $result->num_fields;
	#printf("Result has %d fields. \n", $num_fields);
}
	
echo '<div id="form_container">';
	
#Form starts here!
echo '<br />
	<form style="position:relative; left:20%;" method="POST" action="remove.php?action=confirm">
	Delete which record? <br />
	<select name="customer">
   	<option value="0">NULL</option>' . "\n";
	
for($i=0; $i < $num_rows; $i++)
{
	$row = $result->fetch_assoc();
	#print drop down values, will search database via customer_id (key value) for wanted data
	echo '<option value="'. $row["customer_id"] . '">' . $row["First_name"] . ' ' . $row["Last_name"] . '</option>' . "\n";		
}
		
echo '</select><br />
<input required type="checkbox" name="check_affirm" /> Confirm deletion. (REQUIRED) <br />
<input type="submit" value="Submit"></form> </div>' . '<br />';	

}


function confirm()
{
	$target_delete = $_POST['customer'];
	$check_affirm = $_POST['check_affirm'];
	
	if($check_affirm)
	{
			delete($target_delete);
	}
	else
	{
		echo 'Deletion operation failed.';
		disconnect();
	}
}

#Deletes requested row from the table, then returns verification.
function delete($customer_id) 
{
global $db, $query;

$query= 'DELETE FROM shark_loan_form WHERE customer_id=' . $customer_id;
	
#typical connection line
if(!($result=$db->query($query)))
{
	echo 'Deletion failed. Disconnecting... <br />';
	disconnect();
}

echo 'The row was removed from the database. <br />';	

#Reprint form
echo 'Delete another entry? <br />';
echo 
'<form action=remove.php?action=list_records method=POST>
		<input type=submit value="Yes" />
</form>';

}


function disconnect()
{
#memory deallocation section
unset($query);
unset($row);
unset($result);
$db->close();
unset($db);	
}

	echo '</div>';

	#Navigation inclusion.
	include '../includes/nav_bar.php';
?>

</body>
</html>