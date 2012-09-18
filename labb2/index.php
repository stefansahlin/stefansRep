<?php
session_start();
//require_once("loginView.php");
//require_once("loginHandler.php");
require_once("loginController.php");
require_once("testAll.php");

$body="";
$title="";

//$test = new testAll(); //Hur ska detta kunna testas
//$test ->Test();

test();

$lc = new LoginController();

$body .= $lc->DoControll();
//$body .= $lc->GetInput();
 
 //Nedanstående ska antagligen flyttas över härifrån till loginView();
?>
<html>
  <head>
    <title>Hej Världen</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  </head>
  <body>
<?php
 

echo $body;

?>
</body>
</html>