<?php
error_reporting(E_ALL);

ini_set('display_errors', 1);

//----------------------------------------RETRIEVE RECORDS - DATABASE--------------------------------------------------
//Obtain login credentials
require_once 'mylogin.php';

//Create connection to database
$conn = new mysqli($hn, $un, $pw, $db);

//Check if connection succeeded
if ($conn->connect_error) die($conn->connect_error);

//Retrieve records
$query  = "SELECT * FROM stockform";
$result = $conn->query($query);

//Check if query succeeded
if (!$result) die ("Database access failed: " . $conn->error);

//Display retrieved records
$rows = $result->num_rows;
?>
<html>
<head lang="en">
<meta charset="utf-8">
<title>stocksystem.com</title>
<link rel="stylesheet" href="page3.css" />
</head>
<body>
<header>
<marquee><h1>STOCK TRANSACTION SYSTEM<h1></marquee>
<nav>
<p><a href="new2.php">FORM</a></p>
<p><a href="retrieve.php">RETRIEVE RECORD</a></p>
<p><a href="update.php">UPDATE RECORD</a></p>
<p><a href="delete.php">DELETE RECORD</a></p>
</nav>
</header>
<div class="left">
<ul>
<li><a href=#>STOCK MARKET ACTIVITY</a></li>
<li><a href=#>STOCK MARKET NEWS & ANALYSIS</a></li>
<li><a href=#>STOCK ACTIVITY</a></li>
<li><a href=#>EARNINGS</a></li>
<li><a href=#>ETFs</a></li>
<li><a href=#>MORE NEWS STORIES</a></li>
</ul>
</div>
<div class="right">
<table>
<caption>TRANSACTION RECORD</caption>
<tr>
<th>ID</th>
<th>Name</th>
<th>Stock Name</th>
<th>Currency</th>
<th>Price</th>
<th>Quantity</th>
<th>Email</th>
</tr>
<?php
for ($j = 0 ; $j < $rows ; ++$j) {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END
    <tr>
      <td>$row[0]</td>
      <td>$row[1]</td>
      <td>$row[2]</td>
	  <td>$row[3]</td>
	  <td>$row[4]</td>
	  <td>$row[5]</td>
	  <td>$row[6]</td>
	  
    </tr><br /><br />
_END;
}
?></table></body></html>
<?php
$result->close();

//Close connection
$conn->close();

?>