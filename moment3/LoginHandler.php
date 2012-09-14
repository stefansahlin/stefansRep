<?php

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
		echo "Du är nu utloggad";
		return false;
	}
	
	//Testklassen
	public function Test()
	{
		$this->DoLogout();
		$BadOutcome = $this->DoLogin("kalle", "leo");
		if ($BadOutcome == true){
			echo "Nu har du skickat in fel användarnamn och lösenord";
			throw new exception;
			return false; 
		}
		$GoodOutcome = $this->DoLogin("kalle", "elak");
		if ($GoodOutcome == false){
			throw new exception;
			return false; 
		}
		
		$result = $this->IsLoggedIn();
		if ($result == false){
			echo "Nu har det blivit fel här";
			return false;
		}
		
		$this->DoLogout();
	    
	}
	

}