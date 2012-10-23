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
	$links = $nw->createMenu();
	$validator = new Validation();
	$mp = new MasterPage();	
	$cssFile = "project.css";

	
	//Sidan laddas.
	switch ($nw->getAction())
		{
		case action::CREATE_NEW_USER:
		$xhtml= $cuc->cucControll($db);
		return $xhtml;
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

