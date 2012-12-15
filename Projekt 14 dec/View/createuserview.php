<?php

class createUserView{
	const errorMessage = "Det blev fel på registreringen"; 
	const usernameErrorMessage = "Användarnamnet måste vara mellan 6 och 20 tecken och inga taggar får användas";
	const passwordErrorMessage = "Lösenordet måste vara mellan 6 och 20 tecken och de måste matcha";
	const alreadyExistingUser = "Användaren finns redan";
	const nowRegistered = "Användaren är nu registrerad";
	const indexLink = "<a href='index.php'>Tillbaka till index</a> ";
	const firstEvilScript = "Du skickade in en otillåten sträng i användar";
	const secondEvilScript = "Du skickade in en otillåten sträng i första passwordformuläret";
	const thirdEvilScript = "Du skickade in en otillåten sträng i andra passwordformuläret";
	const brk = "<br />";
	
	public $BecomeMember= "BecomeMember";
	public  $CreateMember= "CreateMember";
	public  $Username= "createUsername";
	public  $Password1= "createPassword1";
	public  $Password2= "createPassword2";
	
	public function successfulRegistration(){
		return self::nowRegistered . self::brk . self::indexLink;
	}
	
	public function NewMemberBox() {
		$Username="";		
	  	return '<form action="index.php?'.NavigationView::action.'='.action::CREATE_NEW_USER.'" method="post">
	    <fieldset>
	    Username: <input type="text" name="'.$this->Username.'" value="'.$this->GetNewUsername().'" /><br />
		Password: <input type="password" name="'.$this->Password1.'" value="" /><br />
		Repeat Password: <input type="password" name="'.$this->Password2.'" value="" /><br />
		
	   	<input type="submit" name="'.$this->CreateMember.'" value="Skapa medlem" />
	   	</fieldset>
	   	</form>';
  	}
	
	public function CreateNewMember(){
	  	if (isset( $_POST[$this->CreateMember])) {    
	      return true;
		}
		else {
			return false;
		}
  	}
	
	//Är detta verkliggen rätt
	public function GetNewUsername(){
	  	if (isset( $_POST[$this->Username])) {	      
	      return $_POST[$this->Username];
	    }
		else {
			return null;
		}
	}
	public function IsSubmit(){
		return (isset($_POST[$this->CreateMember])) ? true : false;
	}
	public function GetFirstPassword(){
	  	if (isset($_POST[$this->Password1])) {
	      
	      return $_POST[$this->Password1];
	    }
		else {
			return null;
		}
  	}
	
	public function GetSecondPassword(){
	  	if (isset( $_POST[$this->Password2])) {
	      
	      return $_POST[$this->Password2];
	    }
		else {
			return null;
		}
	 }	
}


