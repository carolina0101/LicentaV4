<?php

session_start();

if(isset($_SESSION['petbook_userid']));
{
	$_SESSION['petbook_userid'] = NULL;
	unset($_SESSION['petbook_userid']);
}

header("Location: login.php");
die;
