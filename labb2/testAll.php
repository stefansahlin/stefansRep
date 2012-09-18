<?php
//Testfilen
require_once("loginView.php");
require_once("loginHandler.php");
require_once("loginController.php");
//Skapa instanser av de här klasserna nu.

//$lwt = new loginView();
//Det här fungerar av någon anledning inte. Ta reda på varför.


	
	 function Test()
	{
		$lht = new LoginHandler();
		
		$lht->DoLogout();
		$BadOutcome = $lht->DoLogin("kalle", "leo");
		if ($BadOutcome == true){
			echo "Nu har du skickat in fel användarnamn och lösenord";
			throw new exception;
			return false; 
		}
		$GoodOutcome = $lht->DoLogin("kalle", "elak");
		if ($GoodOutcome == false){
			throw new exception;
			return false; 
		}
		
		$result = $lht->IsLoggedIn();
		if ($result == false){
			echo "Nu har det blivit fel här";
			return false;
		}

		
		$lht->DoLogout();
	    
	}
