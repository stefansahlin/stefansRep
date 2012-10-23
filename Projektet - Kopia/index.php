<?php
//http://www.youtube.com/watch?v=iwp6Bf6uXh4
session_start();
require_once("createusercontroller.php");
require_once("logincontroller.php");
require_once("database.php");
require_once("DBconfig.php");
require_once("action.php");
require_once("navigationview.php");
require_once("Validation4.php");
require_once("masterpage.php");
require_once("writeMessageController.php");

$body="";
$title="";





class MasterController {
	
	//Ersätt echo med return-satser
	//Börja med inloggningsrutan som default och kör en if-sats som bygger på om användaren vill bli ny medlem.
	public static function doControll() {
	$xhtml="";
	//new mysqli = De fyra värdena. 
	$cuc = new createUserController(); //Kalla på DoLoginBox();
	$lc = new LoginController();
	$db = new DBConfig();
	$nw = new NavigationView(); 
	$links = "";
	$wmc = new WriteMessageController();
 	if(isset($_SESSION['loggedIn']))
 	{
 		$links = $nw->createMenu(); 
 		echo"inloggad";
	}
	
	$validator = new Validation();
	$mp = new MasterPage();	
	$cssFile = "project.css";

	
	//Sidan laddas.
	switch ($nw->getAction())
		{
		case action::CREATE_NEW_USER:
		$xhtml= $cuc->cucControll($db);
		return $xhtml; //Notera här att du inte returnerar page som du kanske ska göra
		case action::UPLOAD_FILE: echo"Fil ska kunna laddas upp"; //Koden ska gå till en controller som laddar upp och tar bort filer.
		return;
	  	case action::CREATE_MESSAGE: echo"Meddelande ska kunna skrivas";
		$xhtml.= $wmc->WriteMessageControll($db, $validator);
		return;  //Koden ska leda till en ruta där man kan skriva ner ett meddelande. Det ska sedan sparas i databasen under messages3.
	  	case action::CHANGE_AUTHORITY: echo"Användaren ska kunna ändra vem som ska kunna läsa dennes meddelanden"; //Koden returnerar en lista med alla medlemmar och en switch bredvid. När switchen är på ska användaren kunna läsa meddelandena. 
		return;
		default: 
	  	$xhtml .= $lc->DoControll($db, $validator);
		$title = "titel";
		$page = $mp->GetHTMLPage($title, $xhtml, $links);		
	  	return $page;
		break; 
		} 
    }	
}

$body .= MasterController::doControll();
echo $body;
?>

