<?php
require_once 'mylogin.php';

error_reporting(E_ALL);
$conn = new mysqli($hn, $un, $pw, $db);
ini_set('display_errors', 1);
$id="";
$pnameErr = $snameErr = $currencyErr = $ppshareErr = $qtshareErr = $emailErr = "";
$pname = $currency = $sname = $ppshare = $qtshare = $email = "";

$count = 0; //to avoid inserting invalid data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$id = $_POST["id"];
    if ($id == '') {
        echo "Record can not be updated!!";
    } else {

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


           

        /*         * ************************* FORM VALIDATION - end ***************************************** */

        /*         * ************************* DBQuery ***************************************** */
//Create connection to database


//Check if connection succeeded
if ($conn->connect_error) die($conn->connect_error);

        if ($count == 0) {

            $updatequery = "UPDATE stockform SET "
                    . "pname = '" . $pname . "', sname= '" . $sname . "', currency= '" . $currency . "', ppshare= '" . $ppshare . "' , qtshare= '" . $qtshare . "', email= '" . $email . "'"
                    
                    . "WHERE id= " . $id . ";";
   

            $result = $conn->query($updatequery);
            if (!$result) {
                echo "Update failed: $updatequery<br>" . $conn->error . "<br><br>";
            } else {
                echo "Data Update Success!<br>";
            }
            
        }
    }
    /*     * ************************ DBQuery - end ***************************************** */
} else {
    $id='';
    if (!empty($_GET) && $_GET['id']) {
        $selectQuery = "SELECT * FROM stockform WHERE id=" . $_GET['id'];
        $result_trades = $conn->query($selectQuery);
        $row = $result_trades->fetch_array(MYSQLI_ASSOC);

        if (empty($row)) {
            $error_notify = "Record Not Found!";
        } else {
            foreach ($row as $key => $value) {
                $$key = $value;
				
				
            }
            
        }
    } else {
        $error_notify = "Record Not Found!";
    }
}

     

?>
<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="utf-8">
<title>stocksystem.com</title>
<link rel="stylesheet" href="page2.css" />
<script type="text/javascript" language="javascript" src="page2js.js"></script>
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
<form name="stockform" action="update.php?id=<?php echo $id; ?>" method="post">
<fieldset>
<legend>TRANSACTION DETAILS</legend><br>
Name: <input type="text" value='<?php echo $pname; ?>' name="pname" class="name"><span class="error">* <?php echo $pnameErr;?></span><br><br>
Stock Name: <input type="text" value='<?php echo $sname; ?>' name="sname" class="sname"><span class="error">* <?php echo $snameErr;?></span><br><br>
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
Price: <input type="text" value='<?php echo $ppshare; ?>' name="ppshare" class="price"> per share<span class="error">* <?php echo $ppshareErr;?></span><br><br>
Quantity: <input type="text" value='<?php echo $qtshare; ?>' name="qtshare" min="1" class="quantity"><span class="error">* <?php echo $qtshareErr;?></span><br><br>
Email: <input type="text" value='<?php echo $email; ?>' name="email" class="mail"><span class="error">* <?php echo $emailErr;?></span><br><br>
Notification: <input type="checkbox" id="abc" name="subscription" class="notify">Email<input type="checkbox" id="def" name="subscription" class="notify">SMS<br><br>
<input type="hidden" name ="id" value="<?php echo $id; ?>" />
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