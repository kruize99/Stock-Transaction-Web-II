
<?php
require_once 'mylogin.php';
echo "hh:$db";
echo "login params: hostname = " . $hn . "; username = " . $un . "; password = ******* " . "; db name = " .$db;

$conn = new mysqli($hn, $un, $pw);


 if ($conn->connect_error) {
     echo "<br/>";
     die("Die - Connection failed: " . $conn->connect_error);

 }

$sql = "CREATE DATABASE " . $db ;
echo "<br/>";
echo "Create db sql: " . $sql;
if ($conn->query($sql) === TRUE) {
     echo "<br/>";
     echo "Database created successfully";
}   else {
     echo "<br/>";
     //die("Die - Create DB failed: " . $conn->error);
}

$conn->close();
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) {
   echo "<br/>";
   die("Connection with db failed: " . $conn->connect_error);
}  else {
     echo "<br/>";
     echo "Connection with db: $db succeeded";
}

$sql = "CREATE TABLE stockform(".
 "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, " .
 "pname VARCHAR(30) NOT NULL, " .
 "sname VARCHAR(10) NOT NULL, " .
 "currency VARCHAR(30) NOT NULL, " .
 "ppshare INT NOT NULL, " .
 "qtshare INT NOT NULL, " .
 "email VARCHAR(30) NOT NULL)" ;
 
echo "<br/>";
echo "sql for create table: " . $sql;

if ($conn->query($sql) === TRUE) {
    echo "<br/>";
    echo "Table created successfully";

} else {
    echo "<br/>";
    echo "Error creating table: " . $conn->error;

}
echo "<br/>";
echo "Connected successfully";

 ?>

