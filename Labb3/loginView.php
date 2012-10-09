<?php
//Byt här ut cookie-funktionen mot en funktion som tar reda på om användaren är inloggad eller inte
//ändra så att texten kommer in via vyn istället för vila controllern. 
class LoginView {
	
	private $Username= "Username";
	private $Password= "Password";
	private $LoginButton= "LoginButton";
	private $LogoutButton= "LogoutButton";
	private $Remember= "Remember";
	private $RemoveButton = "RemoveButton";
	
	//Konstanterna
	const Brk = "<br/>";
	const Loggedout = "Du har just loggat ut";
	const Utloggad = "Du är utloggad";
	const Inloggad = "Du är inloggad";
	const FailedLogin= "Du misslyckades med inloggningen";
	const Rubrik = "<h2>Login Controller</h2> ";
	
	public function removeCookie(){
		setcookie($this->Username, "", time()-3600);
		setcookie($this->Password, "", time()-3600);
	}
	
	public function createCookie($Username, $Password){
		setcookie($this->Username, $Username, time()+3600);
		setcookie($this->Password, $Password, time()+3600);
	}
	
	public function getUserCookie(){	
		if (isset($_COOKIE[$this->Username]))
		{return $_COOKIE[$this->Username];}
		else {return null;}
			
	}
	
	public function getPwCookie(){
		if (isset($_COOKIE[$this->Password]))
		{return $_COOKIE[$this->Password];}
		else {return null;}
			
	}
	
	//Gör samma sak för sessionsvariabel.
		
	public function rememberMe(){
		//Den här funktionen ska göra att användaren kan logga in igen direkt när den har stängt av webbläsaren.
		if (isset( $_GET[$this->Remember])) {
			//Skapa din cookie här.	
			 //echo "Du har kryssat i rutan";	      
		      return $_GET[$this->Remember];
		    }
			else {
				return null;
			}				
		}
			
	public function DoLoginBox() {
		
	    return '<form method="get">
	    <fieldset>
	    User name: <input type="text" name="'.$this->Username.'" value="'.$this->GetUserCookie().'" /><br />
		Password: <input type="text" name="'.$this->Password.'" value="'.$this->GetPwCookie().'" /><br />
		
	   <input type="checkbox" name="Remember" value="Remember" /> Remember me
	   <input type="submit" name="LoginButton" value="Log in" />
	   </fieldset>
	   </form>
	   <a href="/php/labb3/?action=1">Bli medlem</a>;
	   ';
  	}
  
	 public function DoLogoutBox() {
	   return '<form name="input"  method="get">
	   <input type="submit" name="LogoutButton" value="LogOutButton" />
	   </form>';
	 }
  
	  public function RemoveButton() {
	    return '<form name="input"  method="get">
	    <input type="submit" name="RemoveButton" value="Ta bort medlem" />
	    </form>';
	  }
	  
	  public function RemoveUser(){
	  	// returnerar en sträng med det som användaren skrivit i användarnamnsfältet eller NULL ifall användaren inte fyllt i något där.
	  	if (isset( $_GET[$this->RemoveButton])) {
	      
	      return $_GET[$this->RemoveButton];
	    }
		else {
			return null;
		}
	  }
	  
	  //Fixa strängberoende
	  public function GetUserName(){
	  	// returnerar en sträng med det som användaren skrivit i användarnamnsfältet eller NULL ifall användaren inte fyllt i något där.
	  	if (isset( $_GET[$this->Username])) {
	      
	      return $_GET[$this->Username];
	    }
		else {
			return null;
		}
	  }
  //Strängberoende
  public function GetPassword(){
  	//returnerar en sträng med det som användaren skrivit i lösenordsfältet eller NULL ifall användaren inte fyllt i något där.
  	if (isset( $_GET[$this->Password])) {
      
      return $_GET[$this->Password];
 	}
	else {
		return null;
	}
  }
  
  public function TriedToLogIn(){//Blir problem här för den returnerar true oavsett om användaren har tryckt på knappen eller inte?
  	//returnerar true om användaren har klickat på Login-knappen eller false ifall han inte gjort det.
  	if (isset( $_GET[$this->LoginButton]) ) {//Syftar till om användaren har tryckt på knappen
      
      return true;
	}
	else {
		return false;
	}
  }
  //Strängberoende
  public function TriedToLogOut(){
  	//returnerar true om användaren har klickat på Login-knappen eller false ifall han inte gjort det.
  	if (isset( $_GET[$this->LogoutButton])) {//Syftar till om användaren har tryckt på knappen
      
      return true;
	}
	else {
		return false;
	}
  }
  
}
  