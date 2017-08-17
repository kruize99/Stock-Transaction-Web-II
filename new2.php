<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="utf-8">
<title>stocksystem.com</title>
<link rel="stylesheet" href="page2.css" />
<script type="text/javascript" language="javascript" src="page2js.js"></script>
</head>
<body>
<?php
error_reporting(E_ALL);

ini_set('display_errors', 1);
//Function to format string
function get_post($conn, $var) {
	return $conn->real_escape_string($_POST[$var]);
}
// define variables and set to empty values
$pnameErr = $snameErr = $currencyErr = $ppshareErr = $qtshareErr = $emailErr = "";
$pname = $sname = $ppshare = $qtshare = $email = "";
$logic = 0; //to avoid blank insert
$count = 0; //to avoid inserting invalid data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $logic = 1; 
  if (empty($_POST["pname"])) {
    $pnameErr = "Name is required";
	$count++;
  } else {
	$pname = test_input($_POST["pname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$pname)) {
      $pnameErr = "Only letters and white space allowed"; 
    $count++;
	}
  }
  if (empty($_POST["sname"])) {
    $snameErr = "Stock Name is required";
	$count++;
  } else {
	$sname = test_input($_POST["sname"]);
    // check if name only contains letters and whitespace
  if (!preg_match("/^[A-Z ]*$/",$sname)) {
      $snameErr = "Only uppercase letters and white space allowed"; 
    $count++;
	}
  }
  if (empty($_POST["currency"])) {
    $currencyErr = "Please select a currency";
  $count++;
  } else {
	  $currency = test_input($_POST["currency"]);
  }
  if (empty($_POST["ppshare"])) {
    $ppshareErr = "Price per share is required";
	$count++;
  } else {
    $ppshare = test_input($_POST["ppshare"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/^[0-9]*$/", $ppshare)) {
      $ppshareErr = "Enter a valid price of shares"; 
    $count++;
	}
  }
  if (empty($_POST["qtshare"])) {
    $qtshareErr = "Number of shares is required";
	$count++;
  } else {
    $qtshare = test_input($_POST["qtshare"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/^[0-9]*$/", $qtshare)) {
      $qtshareErr = "Enter a valid number of shares"; 
    $count++;
	}
  }
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
	$count++;
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format, please enter in xxxxx@xxxx.xxx format"; 
    $count++;
	}
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
require_once 'mylogin.php';

//Create connection to database
$conn = new mysqli($hn, $un, $pw, $db);

//Check if connection succeeded
if ($conn->connect_error) die($conn->connect_error);

//Verify if user already entered data to be added to the database table
if ($count == 0 && $logic == 1 ) 
{
	$pname = get_post($conn, 'pname');
    $sname = get_post($conn, 'sname');
	$currency = get_post($conn, 'currency');
	$ppshare = get_post($conn, 'ppshare');
	$qtshare = get_post($conn, 'qtshare');
	$email = get_post($conn, 'email');
	//Add record to table
	$query = "INSERT INTO stockform (pname, sname, currency, ppshare, qtshare, email) VALUES " . 
	"('$pname', '$sname', '$currency', '$ppshare', '$qtshare', '$email')";
    $result = $conn->query($query);

    //If query fails, display error message
    if (!$result){
    	echo "INSERT failed: $query <br />" . $conn->error . "<br /><br />";
    } else {
    	//If query succeeded, display success message
    	echo "Record added successfully!<br /><br />";
    }
} else {
	echo "Error";
}
//Close connection
$conn->close();

?> 
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
<form name="stockform" action="new2.php" method="post">
<fieldset>
<legend>TRANSACTION DETAILS</legend><br>
Name: <input type="text" name="pname" class="name"><span class="error">* <?php echo $pnameErr;?></span><br><br>
Stock Name: <input type="text" name="sname" class="sname"><span class="error">* <?php echo $snameErr;?></span><br><br>
Currency:
<select name="currency" class="currency">
    <option value="USdollars">USD</option>
    <option value="Pound">GBP</option>
	<option value="Euro">EUR</option>
    <option value="Rupees">INR</option>
    <option value="Yen">JPY</option>
</select>
<span class="error">* <?php echo $currencyErr;?></span>
<br><br>
Price: <input type="text" name="ppshare" class="price"> per share<span class="error">* <?php echo $ppshareErr;?></span><br><br>
Quantity: <input type="text" name="qtshare" min=1 class="quantity"><span class="error">* <?php echo $qtshareErr;?></span><br><br>
Email: <input type="text" name="email" class="mail"><span class="error">* <?php echo $emailErr;?></span><br><br>
Notification: <input type="checkbox" id="abc" name="subscription" class="notify">Email<input type="checkbox" id="def" name="subscription" class="notify">SMS<br><br>
<input type="image" src="submit.png" alt="Submit" title="Submit" width="75" height="20"> &nbsp;
<input type="reset"><br>
</fieldset>
</form>

</div>
<footer>
<div class="share">
<p>Share:
 <img src="email.png" alt="Email this to someone" title="Email" />
 <img src="rss.png" alt="Syndicated content" title="RSS Feed" />
 <img src="twitter.png" alt="Share this on Twitter" title="Twitter" />
</p>
</div>
<nav class="extras">
<p><a href=#>Comapny News</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</p>
<p><a href=#>Annual Report</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</p>
<p><a href=#>Contact</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</p>
<p><a href=#>Careers</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</p>
<p><a href=#>Advertise on Stocksystem.com</a></p>
</nav>
<p>Copyright &copy; 2017 STOCK TRANSACTION SYSTEM</p>
</footer>
</body>
</html>