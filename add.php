<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add to Database</title>
	<!-- File inclusions; CSS / PHP inclusive-->
	<?php include '../includes/db_connect.php'; ?>
	<link rel="stylesheet" type="text/css" href="../includes/generic.css" />
</head>

<body>

<?php
#Menu area
echo '<div id="container">
	<h1>Data Management: Back End</h1>';
	
echo '<em>Add a Record</em> | 
	  <a href="remove.php?action=list_records">Delete a Record</a> | 
	  <a href="modify.php?action=list_records">Modify a Record</a><br /><br />';

if(isset($_GET['action']))	{ $action=$_GET['action']; }

switch ($action)
{
case 'form_create':
form_create();
break;	

case 'confirm':
confirm();
break;

case 'insert':
insert();
break;
}

#Echoes Project 3 form, and sends the data to add.php?action=confirm
function form_create()
{
echo '<form id="calculator_form" action="add.php?action=confirm" method="POST">
    	<fieldset>
        	<legend>Personal Information:</legend>
    	First Name:<input name="f_name_in" maxlength="16" title="Letters only. Less than 16 characters." />
        Last Name: <input name="l_name_in" maxlength="16" title="Letters only. Less than 16 characters." />
        <br />
        
        Address 1: <input name="address_1_in" maxlength="40" title="Primary address information."/>
        <br />
        Address 2: <input name="address_2_in" maxlength="40" title="Apartment number or other secondary address info." placeholder="Not required." />
        <br />
        
		City: <input name="city_in" maxlength="25" />
        
        State: <select name="state_in">
        	<option value="AL" selected>AL</option>
            <option value="AK">AK</option>
            <option value="AZ">AZ</option>
            <option value="AR">AR</option>
            <option value="CA">CA</option>
            <option value="CO">CO</option>
            <option value="CT">CT</option>
            <option value="DE">DE</option>
            <option value="DC">DC</option>
            <option value="FL">FL</option>
            <option value="GA">GA</option>
            <option value="HI">HI</option>
            <option value="IL">IL</option>
            <option value="ID">ID</option>
            <option value="IN">IN</option>
            <option value="IA">IA</option>
            <option value="KS">KS</option>
            <option value="KY">KY</option>
            <option value="LA">LA</option>
            <option value="ME">ME</option>
            <option value="MD">MD</option>
            <option value="MA">MA</option>
            <option value="MI">MI</option>
            <option value="MN">MN</option>
        	<option value="MS">MS</option>
            <option value="MO">MO</option>
        	<option value="MT">MT</option>
            <option value="NE">NE</option>
        	<option value="NV">NV</option>
        	<option value="NH">NH</option>
            <option value="NJ">NJ</option>
            <option value="NM">NM</option>
            <option value="NY">NY</option>
            <option value="NC">NC</option>
        	<option value="ND">ND</option>
            <option value="OH">OH</option>
        	<option value="OK">OK</option>
        	<option value="OR">OR</option>
        	<option value="PA">PA</option>
        	<option value="RI">RI</option>
        	<option value="SC">SC</option>
            <option value="SD">SD</option>
            <option value="TN">TN</option>
        	<option value="TX">TX</option>
            <option value="UT">UT</option>
        	<option value="VT">VT</option>
            <option value="VA">VA</option>
        	<option value="WA">WA</option>
        	<option value="WV">WV</option>
        	<option value="WI">WI</option>
            <option value="WY">WY</option>
        </select>
        
        Zip Code: <input name="zip_code" size="5" maxlength="5" title="First 5 digits of your zip code." />
        <br />
        
        Telephone Number: 
        <input name="phone_1" size="3" maxlength="3" title="Area code goes here." /> -
        <input name="phone_2" size="3" maxlength="3" title="Next 3 digits go here." /> -        
        <input name="phone_3" size="4" maxlength="4" title="Last 4 digits go here." />
                <hr id="form_hr" />
                
        Social Security Number:
        <input name="social_1" size="3" maxlength="3" title="DONT PUT REAL SS NUMBER IN HERE" /> - 
        <input name="social_2" size="2" maxlength="2" title="DONT PUT REAL SS NUMBER IN HERE" /> - 
        <input name="social_3" size="4" maxlength="4" title="DONT PUT REAL SS NUMBER IN HERE" />
        <br />
        
        Amount to Borrow: <input name="loan_amount" size="10" maxlength="20" title="Input amount you wish to borrow." /> USD
        <br />
        
        Length of Loan <input name="loan_length" size="3" maxlength="3" title="Input amount you wish to borrow." /> (months)
        <br />
        
        Points:
        <select name="point_charge">
        	<option value="0.0">0.0%</option>
            <option value-"0.5">0.5%</option>
            <option value-"1.0">1.0%</option>
            <option value-"1.5">1.5%</option>
            <option value-"2.0">2.0%</option>
        </select>
        <br />
        <input type="submit" value="Add to Database" />
    	</fieldset>
    </form>';
}


#Spits the entered input out and tells user to confirm.
#Sends data to add.php?action=insert
function confirm()
{	
	global $VALID_INPUT, $IS_VALIDATED;

	#bool switches to be used in later control logic
	$PRINT_ERROR=false;
	$IS_VALIDATED=false;
	
	$VALID_INPUT .= '<span style="font-size:24px;">You are about to add to the database:</span> <br />';
	
	#First Name
	$first_name=validate_input($_POST["f_name_in"]);
	if($IS_VALIDATED) {	$VALID_INPUT .= 'First Name: ' . $first_name . '<br />'; }
	
	#Last Name
	$last_name=validate_input($_POST["l_name_in"]);
	if($IS_VALIDATED) { $VALID_INPUT .= 'Last Name: ' . $last_name . '<br />'; }
	
	#Address
	$address_1=validate_input($_POST["address_1_in"]);
	if($IS_VALIDATED) { $VALID_INPUT .= 'Address: ' . $address_1 . '<br />'; }
	
	#Address 2
	$address_2=$_POST["address_2_in"];
	$VALID_INPUT .= 'Address 2: ' . $address_2 . '<br />';
	
	#City
	$city=validate_input($_POST["city_in"]);
	if($IS_VALIDATED) { $VALID_INPUT .= 'City: ' . $city . '<br />'; }
	
	#State
	$state=$_POST["state_in"];
	$VALID_INPUT .= 'State: ' . $state . '<br />';
	
	
	#Zip Code
	$zip_code=validate_input($_POST["zip_code"]);
	if($IS_VALIDATED) { $VALID_INPUT .= 'Zip: ' . $zip_code . '<br />';	}
	
	#Phone
	$phone_1=$_POST["phone_1"];
	$phone_2=$_POST["phone_2"];
	$phone_3=$_POST["phone_3"];
	phone_check();
	if($IS_VALIDATED) { $VALID_INPUT .= 'Telephone Number: ' . $phone_1 . '-' . $phone_2 . '-' . $phone_3 . '<br />'; }

	#Social
	$social_1=$_POST["social_1"];
	$social_2=$_POST["social_2"];
	$social_3=$_POST["social_3"];
	ss_check();
	if($IS_VALIDATED)
	{ $VALID_INPUT .= 'Social Security Number: ' . $social_1 . '-' . $social_2 . '-' . $social_3 . '<br />'; }

	#Loan Amount
	$loan_amount=$_POST["loan_amount"];
	$loan_length=validate_input($_POST["loan_length"]);
	if($IS_VALIDATED)
	{ $VALID_INPUT .= 'Loan Length: ' . $loan_length . '<br />'; }

	$point_charge=$_POST["point_charge"];
	$VALID_INPUT .= 'Point Charge: ' . $point_charge. '<br />';

	$APR = determine_apr($APR);
	$VALID_INPUT .= 'APR: ' . $APR . '<br />';

	echo ($VALID_INPUT .= ' <br />Is this ok?');

	#Hidden form values allow values to pass to next method call despite no formal globalizing.
	#Must use $_POST[NAME HERE] to retrieve values
	echo '<form action="add.php?action=insert" method="POST">
		<input type="hidden" name="f_name" value="' . $first_name . '" />
		<input type="hidden" name="l_name" value="' . $last_name . '" />
		<input type="hidden" name="address_1" value="' . $address_1 . '" />
		<input type="hidden" name="address_2" value="' . $address_2 . '" />
		<input type="hidden" name="city" value="' . $city . '" />
		<input type="hidden" name="state" value="' . $state . '" />
		<input type="hidden" name="zip_code" value="' . $zip_code . '" />
		<input type="hidden" name="phone_1" value="' . $phone_1 . '" />
		<input type="hidden" name="phone_2" value="' . $phone_2 . '" />
		<input type="hidden" name="phone_3" value="' . $phone_3 . '" />
		<input type="hidden" name="social_1" value="' . $social_1 . '" />
		<input type="hidden" name="social_2" value="' . $social_2 . '" />
		<input type="hidden" name="social_3" value="' . $social_3 . '" />
		<input type="hidden" name="loan_amount" value="' . $loan_amount . '" />
		<input type="hidden" name="loan_length" value="' . $loan_length . '" />
		<input type="hidden" name="point_charge" value="' . $point_charge . '" />
		<input type="submit" value="Yes" />
	</form>	<a href="add.php?action=form_create">Back</a>';
}


function determine_apr($APR) 
{
	global $point_charge;
	
	switch ($point_charge)
	{
		case 0.0:
			$APR = .0675; break;
		case 0.5:
			$APR = .0662; break;
		case 1.0:
			$APR = .065; break;
		case 1.5:
			$APR = .0638; break;
		case 2.0:
			$APR = .0625; break;
	}
	return $APR;
}

# Will trim edge characters and unnecessary middle spaces from whatever variable is put into it.
#	PARAMETER $var: The string in question to be trimmed.
# Will set validation bool IS_VALIDATED to false, then have it remain false unless all criteria are met.
function validate_input($var) 
{
	global $error_msg;
	global $IS_VALIDATED;
	
	$IS_VALIDATED=false;
	
	# Check for null input, print generic error and exit validation if it is.
	if($var=='') 
	{	#ERROR CASE
		$error_msg = $error_msg.'<span id="error">One or more fields were left blank.</span> <br />';
		return $var;
	}
	else 
	{ 
	$var=(trim($var)); 
	}	#Removes whitespace around string.
	
	#Removes all but single spaces within string if any white space character exists in input.
	while ( (preg_match('  ',$var)) || (preg_match("\t",$var)) || (preg_match("\n",$var)) ) 
	{
		#echo 'Actually trimming!';
		$var=str_replace('  ',' ',$var);
		$var=str_replace("\t",'',$var);
		$var=str_replace("\n",'',$var);
	}
	
	#Sets string to all lower case, then makes its first character uppercase.
	$var=strtolower($var);
	$var=ucfirst($var);

	$IS_VALIDATED=true;
	return $var;
}

#Takes the values confirmed through validation and sends them into the database. 
function insert()
{
global $db, $result, $query;
	
#Gather values for further processing.
$first_name=$_POST['f_name']; $last_name=$_POST['l_name']; $address_1=$_POST['address_1']; $address_2=$_POST['address_2']; $city=$_POST['city']; $state=$_POST['state']; $zip_code=$_POST['zip_code']; $phone_1=$_POST['phone_1']; $phone_2=$_POST['phone_2']; $phone_3=$_POST['phone_3']; $social_1=$_POST['social_1']; $social_2=$_POST['social_2']; $social_3=$_POST['social_3']; $loan_amount=$_POST['loan_amount']; $loan_length=$_POST['loan_length']; $point_charge=$_POST['point_charge'];

#echo "$first_name ,  $last_name , $address_1 , $address_2, $city, $state, $zip_code, $phone_1, $phone_2, $phone_3, $social_1, $social_2, $social_3, $loan_amount, $loan_length, $point_charge";
	
#Set the insertion query, regardless of whether values are blank or not.
$query="INSERT INTO shark_loan_form (First_name,Last_name,Address_1,Address_2,City,State,Zip_code,Phone_1,Phone_2,Phone_3,Social_1,Social_2,Social_3,Loan_amount,Loan_length,Point_charge) VALUES ('".$first_name."','".$last_name."','".$address_1."','".$address_2."','".$city."','".$state."','".$zip_code."','".$phone_1."','".$phone_2."','".$phone_3."','".$social_1."','".$social_2."','".$social_3."','".$loan_amount."','".$loan_length."','".$point_charge."')";

#Query failure handler / verification script
if (!($result=$db->query($query)))
{
	#TODO: Put failure HTML on page and finish execution
	echo '<span style="color:#C00;">Query unsuccessful: entry not added to database.</span><br />';
	echo 'Result has value of:' . $result;	#For testing purposes
	
	disconnect();
}
	$field_array = array(  
					  0 =>'customer_id', 1 =>'First_name',
					  2 =>'Last_name', 3 =>'Address_1',
					  4 =>'Address_2', 5 =>'City',
					  6 =>'State', 7 =>'Zip_code',
					  8 =>'Phone_1', 9 =>'Phone_2',
					  10 =>'Phone_3', 11 =>'Social_1', 12 =>'Social_2',
					  13 =>'Social_3', 14 =>'Loan_length',
					  15 =>'Loan_amount', 16 =>'Point_charge',
					  );

	#Section where output occurs.	
	$query = "SELECT * 
			  FROM shark_loan_form 
			  WHERE Last_name='" . $last_name . 
		   "' AND First_name='" . $first_name . 
		   "' AND social_3='" . $social_3 . "' ;";
		
	#Print the information about all returned tuples
	foreach($db->query($query) as $row)
	{
		echo '<span class="result">Results:</span>' . '<br />';
		for($j=0; $j < 17; $j++)
		{
			echo '<span class="data">'. "$field_array[$j]: ";
			print($row[$field_array[$j]]);
			echo '</span>' . "<br />";
		}
		echo '<br />was entered into the table successfully.';
	}
	
	echo '<br /><br />
<a href="add.php?action=form_create">Add another record</a>';
	disconnect();
} 

#deallocates server connection and query variables from memory
function disconnect()
{
global $query, $db, $result;
#memory deallocation section
unset($query);
unset($row);
unset($result);
$db->close();
unset($db);
}

#Checks zip code for all numbers and 5 character precision.
function zip_check() 
{
	global $zip_code;
	global $error_msg;
	
	if(strlen($zip_code) != 5 || !(is_numeric($zip_code)) ) 
	{ 
		$error_msg .= '<span id="error">Zip code is not 5 digits.</span> <br />'; 
		#$error_trig[13] = ' style="background-color:#FCC;" ';
	}
}

# Checks to see if each section of SS number is of proper length and all numeric.
function ss_check() 
{
	$IS_VALIDATED = true;	#LOCAL VERSION
	global $error_msg;
	global $social_1, $social_2, $social_3;
		
	if( (strlen($social_1)!=3) or (!is_numeric($social_1)) ) 
	{ 
		$error_msg .= '<span id="error">First 3 digits of social security number not 3 digits.</span> <br />'; 
		$IS_VALIDATED = false;
		#$error_trig[8] = ' style="background-color:#FCC;" ';
	}
	if( strlen($social_2)!=2 or (!is_numeric($social_2)) ) 
	{ 
		$error_msg .= '<span id="error">Mddle 2 digits of social security number not 2 digits.</span> <br />'; 
		$IS_VALIDATED = false;
		#$error_trig[9] = ' style="background-color:#FCC;" ';
	}	
	if( strlen($social_3)!=4 or (!is_numeric($social_3)) )
	{
		$error_msg .= '<span id="error">Last 4 digits of social security number not 4 digits.</span> <br />'; 
		$IS_VALIDATED = false;
		#$error_trig[10] = ' style="background-color:#FCC;" ';	
	}	
	return $IS_VALIDATED;
}


#Checks for appropriate length and whether all characters are numbers.
function phone_check() 
{
		global $error_msg;
		global $phone_1, $phone_2, $phone_3;
		
		$IS_VALIDATED = true;
		
	if( (strlen($phone_1)!=3) || !(is_numeric($phone_1)) )	
	{ 
		$error_msg .= '<span id="error">Phone number area code invalid.</span> <br />'; 
		#$error_trig[5] = ' style="background-color:#FCC;" ';
		$IS_VALIDATED=false;
	}
	if( (strlen($phone_2)!=3) || !(is_numeric($phone_2)) )	
	{ 
		$error_msg .= '<span id="error">Middle three digits of phone number invalid.</span> <br />';
		#$error_trig[6] = ' style="background-color:#FCC;" ';
		$IS_VALIDATED=false;
	}
	if( (strlen($phone_3)!=4) || !(is_numeric($phone_3)) )	
	{ 
		$error_msg .= '<span id="error">Last four digits of phone number invalid.</span> <br />'; 
		#$error_trig[7] = ' style="background-color:#FCC;" '; 
		$IS_VALIDATED=false;
	}
	return $IS_VALIDATED;
}

#Checks to see if the loan amount and error strings are properly formatted.
function loan_check() 
{
		global $loan_amount;
		global $error_msg;
		
	if( !(is_numeric($loan_amount)) || ($loan_amount < 0.0) )
	{
		$error_msg .= '<span id="error">Loan amount invalid: non-numeric.</span> <br />';
	}
}

echo '</div>';
	#Navigation inclusion.
	include '../includes/nav_bar.php';
?>

</body>
</html>