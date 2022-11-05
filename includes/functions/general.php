<?php

/**
 * If the user is not logged in, redirect them to the protected page
 */
function protect_page()
{
	if (logged_in() === false) {
		header('Location: protected.php');
		exit();
	}
}

/**
 * If the folder doesn't exist, create it. If the file doesn't exist, create it.
 * Error logging function.
 */
function logError()
{
	// Report all errors
	// error_reporting(E_ALL);

	// Turn off error reporting
	// error_reporting(0);

	// Report runtime errors
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	$date = date("Y-m-d");
	$fileName = $date . ".log";
	$year = date("Y");
	$month = date("F");

	/* It's setting the error log to the file path. */
	$folderPath = "./logs/errors/" . $year . "/" . $month;
	$filePath = "./logs/errors/" . $year . "/" . $month . "/" . $fileName;

	/* If the folder doesn't exist, create it. If the file doesn't exist, create it. */
	if (!file_exists($folderPath)) {
		mkdir($folderPath, 0777, true);
	}

	/* It's setting the error log to the file path. */
	ini_set("error_log", $filePath);
}
