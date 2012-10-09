<?php

class createUserView{
	const echoBR = "<br/>"; //Den här kan flyttas över till en mer allmän view.
	const errorMessage = "Det blev fel på inloggningen"; //Här får du gärna vara mer precis baserat på vad som är fel. 
	public $BecomeMember= "BecomeMember";
	public  $CreateMember= "CreateMember";
	public  $Username= "Username";
	public  $Password1= "Password1";
	public  $Password2= "Password2";
	//Du har blandat ihop de två knapparna
	
	public function NewMemberBox() {
		$Username="";		
	  	return '<form action="index.php?'.NavigationView::action.'='.action::CREATE_NEW_USER.'" method="post">
	    <fieldset>
	    Username: <input type="text" name="Username" value="" /><br />
		Password: <input type="text" name="Password1" value="" /><br />
		Repeat Password: <input type="text" name="Password2" value="" /><br />
		
	   	<input type="submit" name="CreateMember" value="Skapa medlem" />
	   	</fieldset>
	   	</form>';
  	}
	
	public function CreateNewMember(){
	  	//returnerar true om användaren har klickat på bli medlem-knappen eller false ifall han inte gjort det.
	  	if (isset( $_POST[$this->CreateMember])) {//Syftar till om användaren har tryckt på knappen     
	      return true;
		}
		else {
			return false;
		}
  	}
	
	public function GetNewUsername(){
	  	// returnerar en sträng med det som användaren skrivit i användarnamnsfältet eller NULL ifall användaren inte fyllt i något där.
	  	if (isset( $_POST[$this->Username])) {
	      
	      return $_POST[$this->Username];
	    }
		else {
			return null;
		}
	}
	
	public function GetFirstPassword(){
	  	// returnerar en sträng med det som användaren skrivit i användarnamnsfältet eller NULL ifall användaren inte fyllt i något där.
	  	if (isset( $_POST[$this->Password1])) {
	      
	      return $_POST[$this->Password1];
	    }
		else {
			return null;
		}
  	}
	
	public function GetSecondPassword(){
  	// returnerar en sträng med det som användaren skrivit i användarnamnsfältet eller NULL ifall användaren inte fyllt i något där.
	  	if (isset( $_POST[$this->Password2])) {
	      
	      return $_POST[$this->Password2];
	    }
		else {
			return null;
		}
	 }	
}


