<?php
	session_start();
	session_destroy();

	echo"<script type=\"text/javascript\">alert('Sesion cerrada'); window.location='index.php';</script>";
?>