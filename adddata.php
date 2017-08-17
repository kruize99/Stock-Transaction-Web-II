<?php
error_reporting(E_ALL);

ini_set('display_errors', 1);

//---------------------------------------------ADD RECORD - DATABASE QUERIES------------------------------------------
//Obtain login credentials
require_once 'mylogin.php';

//Create connection to database
$conn = new mysqli($hn, $un, $pw, $db);

//Check if connection succeeded
if ($conn->connect_error) die($conn->connect_error);

//Verify if user already entered data to be added to the database table
if (isset($_POST['pname']) && isset($_POST['sname']) && isset($_POST['currency']) && isset($_POST['ppshare']) && isset($_POST['qtshare'])  && isset($_POST['email']))
{
	
	//Add record to table
	$pname = get_post($conn, 'name');
    $sname = get_post($conn, 'sname');
	$currency = get_post($conn, 'currency');
	$ppshare = get_post($conn, 'ppshare');
	$qtshare = get_post($conn, 'qtshare');	
	$email = get_post($conn, 'email');
	
	
    $query = "INSERT INTO form (name, sname, currency, ppshare, qtshare, email) VALUES " . "('$pname', '$sname', '$currency', '$ppshare', '$qtshare', '$email')";
    $result = $conn->query($query);

    //If query fails, display error message
    if (!$result){
    	echo "INSERT failed: $query <br />" . $conn->error . "<br /><br />";
    } else {
    	//If query succeeded, display success message
    	echo "Record added successfully!<br /><br />";
    }
}

//Close connection
$conn->close();

//Function to format string
function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}
