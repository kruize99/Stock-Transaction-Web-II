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
// define variables and set to empty values
$nameErr = $snameErr = $currencyErr = $ppshareErr = $qtshareErr = $emailErr = "";
 $name = $sname = $ppshare = $qtshare = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $fname = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  if (empty($_POST["sname"])) {
    $snameErr = "Stock Name is required";
  } else {
    $sname = test_input($_POST["sname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[A-Z]{4}*$/",$sname)) {
      $snameErr = "Only uppercase letters and white space allowed"; 
    }
  }
   if (empty($_POST["currency"])) {
    $currencyErr = "Please select a currency";
  }
   if (empty($_POST["ppshare"])) {
    $ppshareErr = "Price per share is required";
  } else {
    $ppshare = test_input($_POST["ppshare"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!is_numeric($ppshare)) {
      $ppshareErr = "Enter a valid price of shares (decimals allowed)"; 
    }
  }
  if (empty($_POST["qtshare"])) {
    $qtshareErr = "Number of shares is required";
  } else {
    $qtshare = test_input($_POST["qtshare"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/^[0-9]*$/", $qtshare)) {
      $qtshareErr = "Enter a valid number of shares"; 
    }
  }
   if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format, please enter in xxxxx@xxxx.xxx format"; 
    }
  }
 }
 ?> 
<header>
<marquee><h1>STOCK TRANSACTION SYSTEM<h1></marquee>
<nav>
<p><a href="page1.html">HOME</a></p>
<p><a href="page2.html">TRANSACTION</a></p>
<p><a href=#>QUOTES</a></p>
<p><a href="page3.html">OUR BUSINESS</a></p>
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
<form name="Form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<fieldset>
<legend>TRANSACTION DETAILS</legend><br>
Name <input type="text" name="name" class="name"><span class="error">* <?php echo $nameErr;?></span><br><br>
Stock Name: <input type="text" name="sname" class="sname"><span class="error">* <?php echo $snameErr;?></span><br><br>
Stock Exchange:<input type="radio" name="stockexchange" class="exchange" checked>NASDAQ-100<input type="radio" name="stockexchange"class="exchange">NIFTY 50<br><br>
Currency:
<select name="currency" class="currency">
    <option value="USdollars" selected>USD</option>
    <option value="Pound">GBP</option>
	<option value="Euro">EUR</option>
    <option value="Rupees">INR</option>
    <option value="Yen">JPY</option>
</select>
<span class="error">* <?php echo $currencyErr;?></span>
<br><br>
Price: <input type="number" name="ppshare" min=0 class="price"> per share<span class="error">* <?php echo $ppshareErr;?></span><br><br>
Quantity: <input type="number" name="qtshare" min=1 class="quantity"><span class="error">* <?php echo $qtshareErr;?></span><br><br>
Comments: <textarea name="message" rows="1" cols="60" class="comments"></textarea><br><br>
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