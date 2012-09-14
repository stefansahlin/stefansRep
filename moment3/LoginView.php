<?php
class LoginView {
  
  
  public function DoLoginBox() {
  	
    
    return '<form method="get">
    <fieldset>
    User name: <input type="text" name="Username" /><br />
	Password: <input type="text" name="Password" /><br />
	
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
  	if (isset( $_GET["Username"])) {
      
      return $_GET["Username"];
    }
	else {
		return null;
	}
  }
  //Strängberoende
  public function GetPassword(){
  	//returnerar en sträng med det som användaren skrivit i lösenordsfältet eller NULL ifall användaren inte fyllt i något där.
  	if (isset( $_GET["Password"])) {
      
      return $_GET["Password"];
  }
	else {
		return null;
	}
  }
  
  public function TriedToLogIn(){
  	//returnerar true om användaren har klickat på Login-knappen eller false ifall han inte gjort det.
  	if (isset( $_GET["LoginButton"]) ) {//Syftar till om användaren har tryckt på knappen
      
      return true;
	}
	else {
		return false;
	}
  }
  //Strängberoende
  public function TriedToLogOut(){
  	//returnerar true om användaren har klickat på Login-knappen eller false ifall han inte gjort det.
  	if (isset( $_GET["LogoutButton"])) {//Syftar till om användaren har tryckt på knappen
      
      return true;
	}
	else {
		return false;
	}
  }
  

  
}
  
