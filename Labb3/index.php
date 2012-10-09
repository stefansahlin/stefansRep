<?php
//http://www.youtube.com/watch?v=iwp6Bf6uXh4
session_start();
require_once("createusercontroller.php");
require_once("logincontroller.php");
require_once("database.php");
require_once("DBconfig.php");
require_once("action.php");
require_once("navigationview.php");


$body="";
$title="";





class MasterController {
	//Ersätt echo med return-satser
	//Börja med inloggningsrutan som default och kör en if-sats som bygger på om användaren vill bli ny medlem.
	public static function doControll() {
		
		//new mysqli = De fyra värdena. 
		$cuc = new createUserController(); //Kalla på DoLoginBox();
		$lc = new LoginController();
		$db = new DBConfig();
		$nw = new NavigationView(); 
		//Skapa mysqli här. Skicka in det till både cucControllern och mysqli-Controllern. 

 		
		//Sidan laddas.
		switch ($nw->getAction())
			{
			//Användaren har valt att skapa medlem. Ta reda på om han är vid formuläret eller om han är vid skapat medlem.
			case action::CREATE_NEW_USER:
			 $cuc->cucControll($db);
			  break;
			default: 
			//Den här fungerar som vanligt. Om användaren är inloggad så hamnar hen i inloggningsläge. Annars i utloggningsläge.
		  	$lc->DoControll($db);
			break; 
			}
		 
        }
	
}

$body .= MasterController::doControll();
?>

<html>
  <head>
    <title>Labb3</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  </head>
  <body>
<?php
//Uppkopplingen verkar fungera
echo $body;
?>
</body>
</html>