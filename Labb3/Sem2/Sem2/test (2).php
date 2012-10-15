<?php

require_once("validation.php");

$validation = new Validation();


echo "<h1>Test av EMAIL</h1></br>";
	
	$email = "sebastian.hgsfasaf@fsafa.se";
	echo "<h3>Test av valid EMAIL</h3></br>";
	if($validation->checkEmail($email)) {
		
		echo "Testet FUNKAR";
	}
	
	else {
		
		echo "Testet FUNKAR INTE";
	}

echo "<h3>Test av felaktig EMAIL</h3></br>";

	$emailWRONG = "fsafsaf.se";
	if(!$validation->checkEmail($emailWRONG)) {
		
		echo "Testet FUNKAR";
	}
	
	else {
		
		echo "Testet FUNKAR INTE";
	}


echo "<h1>Test av Username</h1></br>";
	
	$username = "adolf";
	echo "<h3>Without TAGS</h3>";
	if($validation->checkUsername($username)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet FUNKAR INTE";
	}
	
	$username = "ado";
	echo "<h3>TO SHORT</h3>";
	if(!$validation->checkUsername($username)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet FUNKAR INTE";
	}
	
	$username = "adofsafsafasfasfasfasjfashfbsavfsavdghsavhdasvdvasgdgasdghas";
	echo "<h3>TO LONG</h3>";
	if(!$validation->checkUsername($username)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet FUNKAR INTE";
	}
	
	
	$username = "<a>THAS</a>";
	echo "<h3>WITH TAG OMG</h3>";
	if(!$validation->checkUsername($username)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet FUNKAR INTE";
	}
	


echo "<h1>Test av Password</h1></br>";
	$password = "skitbra";
	$password2 = "skitbra";
	
	if($validation->checkPassword($password, $password2)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet FUNKAR INTE";
		
	}


	$password = "skitbra";
	$password2 = "skitbraaaa";
	echo "<h3>OLIKA PASSWORD ZOMG</h3>";
	if(!$validation->checkPassword($password, $password2)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet FUNKAR INTE";
		
	}
	
	$password = "skit";
	$password2 = "skit";
	echo "<h3>TO SHORT PASSWORD</h3>";
	if(!$validation->checkPassword($password, $password2)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet FUNKAR INTE";
		
	}
	
	
	$password = "<p>skitbra</p>";
	$password2 = "<p>skitbra</p>";
	echo "<h3>PASSWORD MED TAG ZOMG</h3>";
	if(!$validation->checkPassword($password, $password2)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet FUNKAR INTE";
		
	}



echo "<h1>Test av Personnummer</h1>";
	
	
	$personnummer = "19900123-3890";
	echo "<h3>Format: 19900123-3890 </h3>";
	if($validation->checkPersonNummer($personnummer)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet Funkar INTE";
	}
	
	
	$personnummer = "9001233890";
	echo"<h3>Format 9001233890</h3>";
	if($validation->checkPersonNummer($personnummer)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet Funkar INTE";
	}
	
	$personnummer = "900123-3890";
	echo"<h3>Format 900123-3890</h3>";
	if($validation->checkPersonNummer($personnummer)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet Funkar INTE";
	}
	
	$personnummer = "19900123-3890";
	echo"<h3>Format 19900123-3890</h3>";
	if($validation->checkPersonNummer($personnummer)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet Funkar INTE";
	}
	
	$personnummer = "199001233890";
	echo"<h3>Format 199001233890</h3>";
	if($validation->checkPersonNummer($personnummer)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet Funkar INTE";
	}
	
	$personnummer = "900123-38901";
	echo"<h3>Format 900123-38901</h3>";
	if($validation->checkPersonNummer($personnummer)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet Funkar INTE";
	}


echo "<h1>Test av DATUM</h1>";
	
	
	$date = "1990-01-23";
	echo "<h3>DATUM i formatet 1990-01-23</h3>";
	if($validation->checkDate($date)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet Funkar INTE";
	}
	
	
	$date = "90-01-23";
	echo "<h3>DATUM i formatet 90-01-23</h3>";
	if($validation->checkDate($date)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet Funkar INTE";
	}
	
	$date = "900123";
	echo "<h3>DATUM i formatet 900123</h3>";
	if($validation->checkDate($date)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet Funkar INTE";
	}
	
	$date = "1990-01-23-3890";
	echo "<h3>DATUM i FEL format 1990-01-23-3890</h3>";
	if($validation->checkDate($date)) {
		
		echo "Testet Funkar";
	}
	
	else {
		
		echo "Testet Funkar INTE";
	}

		
	?>
