<?php 
//Den här klassen sköter regler som har att göra med:
//Är personen inloggad?
//Vem får logga in
//Affärslogiska regler som återanvänds på flera ställen i applikationen. Vilka är de affärslogiska reglerna.
class LoginHandler{
	

	private $sessionLoggedIn = "loggedIn";
	
	//Boolfunktion som tar reda på om användaren är inloggad
	public function IsLoggedIn()
	{
		return isset($_SESSION[$this->sessionLoggedIn]);		
	}
	
	//Funktionen som utför inloggningen, med ett par hårdkodade switchexempel
	public function DoLogin($name, $password)
	{
		switch ($name)
		{
		case "kalle":
			if ($password == "elak"){
				$_SESSION[$this->sessionLoggedIn]=true;

				return true;
				 
			}
		  break;
		case "olle":
			if ($password == "leo"){
				$_SESSION[$this->sessionLoggedIn]=true;

				return true;
			}
		  break;
		}
			
	    return false; 
		
	}
	
	//Funktion som ansvarar för utloggning
	public function DoLogout()
	{
		unset($_SESSION[$this->sessionLoggedIn]);
	}
	
	
	
}
