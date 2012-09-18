<?php
//Kommer skapa funkionalitet för cookies
//Hämtar data från användaren
//Skillnad mot tidigare är att nu skapas Xhtml här istället för i indexfilen. 
//Alla get från formulär ska skapas här. 
class LoginView {
	
	private $Username= "Username";
	private $Password= "Password";
	private $LoginButton= "LoginButton";
	private $LogoutButton= "LogoutButton";
	private $Remember= "Remember";
	
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
	
	public function PressedButtonMessage(){
		//Här kan du returnera om användaren har försökt logga in.
		return "Du har tryckt på Inloggningsknappen";
	}
	/*
	public function LoggedInMessage(){
		//Här returnerar du om användaren är inloggad.
		return "Du är nu inloggad";
	}
	 * *
	 */
	
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
	    User name: <input type="text" name="Username" value="'.$this->GetUserCookie().'" /><br />
		Password: <input type="text" name="Password" value="'.$this->GetPwCookie().'" /><br />
		
	   <input type="checkbox" name="Remember" value="Remember" /> Remember me
	   <input type="submit" name="LoginButton" value="Log in" />
	   </fieldset>
	   </form>';
  	}
  
  public function DoLogoutBox() {
    return '<form name="input"  method="get">
    <input type="submit" name="LogoutButton" value="LogOutButton" />
    </form>';
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
  