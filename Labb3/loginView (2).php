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
	const firstEvilScript = "Du skickade in en otillåten sträng i användar";
	const secondEvilScript = "Du skickade in en otillåten sträng i första passwordformuläret";
	
	public function userLoggedOut(){
		$html = $this->DoLoginBox();
		$html.= self::Loggedout; 
		$html.= self::Brk;
		return $html;
	}
	
	public function userLoggedIn(){
		$html = $this->DoLogoutBox();
		$html.= self::Inloggad; 
		$html.= self::Brk;
		$html.= $this->RemoveButton();
		return $html;
	}
	
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
	
		
	public function rememberMe(){
		//Den här funktionen ska göra att användaren kan logga in igen direkt när den har stängt av webbläsaren.
		if (isset( $_GET[$this->Remember])) {      
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
	  
	  public function GetUserName(){
	  	if (isset( $_GET[$this->Username])) {
	      
	      return $_GET[$this->Username];
	    }
		else {
			return null;
		}
	  }
	  public function GetPassword(){
	  	if (isset( $_GET[$this->Password])) {
	      
	      return $_GET[$this->Password];
	 	}
		else {
			return null;
		}
	  }
	  
	  public function TriedToLogIn(){
	  	if (isset( $_GET[$this->LoginButton]) ) {
	      
	      return true;
		}
		else {
			return false;
		}
	  }
	  public function TriedToLogOut(){
	  	if (isset( $_GET[$this->LogoutButton])) {
	      
	      return true;
		}
		else {
			return false;
		}
	  }
	  
	  //Formulär med submitknapp ska finnas här. 
	  //Eventuellt ska meddelandena ligga här utöver i databasen
	  //På varje meddelande ska man känna igen avsändaren (bör synas genom sessionsIdt), index över ämne och eventuella mottagare, möjlighet att modifiera/deleta
	  //och kommentarer samt eventuellt även like-knapp. 
	  //En läsfunktion bör också finnas där. Man bör kunna välja mellan att se sina egna meddelanden och att se övrigas meddelanden som är tillgängliga för en.
	  //Fixa sökfunktion
	  //Varje användare ska ha en egen sida där ens egna meddelanden står
	  
}
  