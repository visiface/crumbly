<?php
// don't close the tag: may cause errors - this is PHP only, anyway


$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "crumbly";

global $conn;
$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if(!$conn) {
  die("Connection Failed: " . mysqli_connect_error());
}