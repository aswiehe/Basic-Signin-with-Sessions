<?php

// Connecting to the MySQL database
$DB_USER = "wiehea1";
$DB_PASSWORD = "ka7udrUB";

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_fall18_wiehea1', $DB_USER, $DB_PASSWORD);

function my_autoloader($class) {
  include('class'.$class.'.php');
}

// Start the session
session_start();

$current_url = basename($_SERVER['REQUEST_URI']);

// if customerID is not set in the session and current URL not login.php redirect to login page
if (!isset($_SESSION["customerID"]) && $current_url != 'login.php') {
    header("Location: login.php");
}

// Else if session key customerID is set get $customer from the database
elseif (isset($_SESSION["customerID"])) {
	$sql = file_get_contents('sql/getCustomer.sql');
	$params = array(
		'customerid' => $_SESSION["customerID"]
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$customers = $statement->fetchAll(PDO::FETCH_ASSOC);

	$customer = $customers[0];
  $customer = new Customer($customerID, $database);
}
