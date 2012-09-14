<?php
session_start();
require_once("LoginView.php");
require_once("LoginHandler.php");

$body="";
$title="";

$lw = new LoginView();
$body .= $lw->DoLoginBox();
$body .= $lw->DoLogoutBox();
$lh = new LoginHandler();
//$lh -> DoLogout();
//$lh ->Test();


if ($lw->TriedToLogin() ) 
{
	$lh->DoLogin($lw->GetUserName(), $lw->GetPassword());
      $body .= "Användaren har klickat på Login med användarnamn ";
      $body .= $lw->GetUserName() . " och lösenord " . $lw->GetPassword();
	  if ($lh->IsloggedIn() == true){
	  	echo "Inloggningen lyckades";
	  }
	  else{
	  	echo "Du är inte inloggad";
	  }
}

else if ($lw->TriedToLogOut() ) 
{
      $body .= "Användaren har bestämt sig för att logga ut "; 
	  echo "<br />";
      $lh->DoLogout();
}


else 
{
      $body .= "Användaren har inte klickat på Loginknappen "; 
	  echo "<br />"; //Grymt, varför funkar inte echo BR?
}



 
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
