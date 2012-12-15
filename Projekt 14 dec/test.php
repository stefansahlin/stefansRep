<?php
require_once('Model/memberhandler.php');
require_once('DBconfig.php');
require_once('Model/loginHandler.php');
$db = new DBConfig();

$mh = new MemberHandler($db);
$lh = new LoginHandler($db);

echo "<h1>SUPER AWESOME TEST<h1>";
echo "<h2>member handler test<h2>";
$uname = "randomName";
$upass = "randomPass";

if ($mh->test($db, $uname, $upass) == false) {
	echo "Test failed";
} else {
	echo "Test Succeded";
}

echo "<h2>Loginhandler test<h2>";
$uname = "randomName";
$upass = "randomPass";

if ($lh->DoLogin($db, $uname, $upass) == false) {
	echo "Test failed";
} else {
	echo "Test succeded";
}

?>       