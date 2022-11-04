<?php

function protect_page()
{
	if (logged_in() === false) {
		header('Location: protected.php');
		exit();
	}
}

function runQuery($query)
{
	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)) {
		$resultset[] = $row;
	}
	if (!empty($resultset))
		return $resultset;
}

function numRows($query)
{
	$result  = mysql_query($query);
	$rowcount = mysql_num_rows($result);
	return $rowcount;
}
