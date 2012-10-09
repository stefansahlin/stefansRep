<?php
require_once("createuserview.php");
require_once("memberhandler.php");
require_once("Validation3.php");
//require_once("validator.php");
class createUserController{
	
	
	public function cucControll($db){
			
		$v = new Validation(); 
		$cuw = new createUserView();
		$name = "mittNamn";
		
		$user = $cuw->Username;
		$firstPassword = $cuw->Password1;
		$secondPassword = $cuw->Password2;
			
			
		if ($_SERVER['REQUEST_METHOD'] == 'GET'){ //Kollar om det är post eller get. 
			 
				
			//Den här slår till om användaren har tryckt på bli medlem-knappen.
			echo $cuw->NewMemberBox();
			
				
			echo "Formulär för att skapa medlem bör dyka upp";
			$user = $cuw->Username;
			$firstPassword = $cuw->Password1;
			$secondPassword = $cuw->Password2;
			//Skicka sedan de här tre variablarna till valideringsklassen för att se att de passerar kraven. 
			//Sedan skickar du variablarna till createUserModel för att se att de passerar dessa krav. 
			//Om de gör detta så skickar du de två variablarna till createNewMember där du skapar en ny användare med dessa som egenskaper.
			//Eventuellt måste $db skickas med in till loginHandler-klassen. 
			$cuw->createNewMember($user, $firstPassword);
			
		  }
			//Slår till när användaren skickar formuläret
		 else {
					echo "Du hamnade i else-satsen";
					//var_dump($cuw->CreateNewMember());
					$user = $cuw->GetNewUsername();
					$fPassword = $cuw->GetFirstPassword();
					$sPassword = $cuw->GetSecondPassword();
					$secondCheck = $v->checkEmail($user);
	
					$mh = new MemberHandler($db);				
					$validator = new Validation();		
					$stringTest = $validator->FormatTextString($user); //Funktionen för att se att ingen ful kod har skrivits in. 
					$name = "hejfkffkk";
					//$mh->Remove($name);
					$mh->existingUsernameCheck($user);
				
					If($mh->existingUsernameCheck($user) ==true){
						echo "namnet finns redan";
					}
				    $mh->NewInsert($user, $fPassword); //När kontrollerna är körda
					$validUsernameTest = $mh->ValidUsername($user);			
					if ($validUsernameTest == false){
						echo "För kort användarnamn";
						return false;
			 		}
										
					$validPasswordTest = $mh->validPasswordCheck($fPassword);
					if ($validPasswordTest == false){
						echo "Too short password";
						return false;
					}
					 					 
					$samePasswordTest = $mh->samePasswordCheck($fPassword, $sPassword);
					if ($samePasswordTest == false){
						echo "Two different passwords";
						return false;
					}

				//return $cuw->NewMemberBox();
		 }
	}	
}
