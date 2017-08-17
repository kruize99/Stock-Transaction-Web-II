<?php
error_reporting(E_ALL);

ini_set('display_errors', 1);

//--------------------------------------DELETE RECORD - DATABASE-----------------------------------------------
//Obtain login credentials
require_once 'mylogin.php';

//Create connection to database
$conn = new mysqli($hn, $un, $pw, $db);

//Check if connection succeeded
if ($conn->connect_error) die($conn->connect_error);

//Verify if user already chose record to be deleted from the database table
if (isset($_POST['delete']) && isset($_POST['id'])) {

	//Delete record from table
	$id = get_post($conn, 'id');

    $query  = "DELETE FROM stockform WHERE id='$id'";

    $result = $conn->query($query);

    //If query fails, display error message
    if (!$result) {
    	echo "DELETE failed: $query <br />" . $conn->error . "<br /><br />";
    } else {
    	//If query succeeded, display success message
    	echo "Record deleted successfully!";
    }
}
//----------------------------------------RETRIEVE RECORDS - DATABASE--------------------------------------------------
//Retrieve records
$query  = "SELECT * FROM stockform";
$result = $conn->query($query);

//Check if query succeeded
if (!$result) die ("Database access failed: " . $conn->error);

//Display retrieved records
$rows = $result->num_rows;
for ($j = 0 ; $j < $rows ; ++$j) {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END
  	<pre>
	  id $row[0]
      pname $row[1]
      sname $row[2]
	  currency $row[3]
	  ppshare $row[4]
	  qtshare $row[5]
	  email $row[6]
	  
  	</pre>
  	<form action="delete.php" method="post">
  	<input type="hidden" name="delete" value="yes">
  	<input type="hidden" name="id" value="$row[0]">
  	<input type="submit" value="DELETE RECORD"></form><br /><br />
_END;
}

$result->close();

//Close connection
$conn->close();

//Function to format string
function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}

?>