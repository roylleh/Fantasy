<?php
error_reporting(0);
session_start();
unset( $_SESSION['username'] );
session_destroy();
echo "<script>";
	echo "window.location.href='/'";
	echo "</script>";
?>