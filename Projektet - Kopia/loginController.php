<?php
require_once("loginView.php");
require_once("loginHandler.php");

class LoginController{
	
		//Användaren loggar in
		public function DoControll($db, $validator){
			//private function CheckControll
			$lw = new LoginView();
			$lh = new LoginHandler($db);
			$xhtml = ""; 
			$xhtml .= $lw::Rubrik;
			$loginValidator = new Validation();
	
		  	if ($lh->IsLoggedIn()) {			
				if ($lw->RemoveUser()){
					$removeName = $_SESSION['username'];
					$lh->Remove($removeName); 	
					$lh->RemoveUserSession();	
					$lh->DoLogout();
					$xhtml .= $lw->userLoggedOut();
				}
				else{ 
	
					$xhtml .= $lw::Brk;								
					if ($lw->TriedToLogout()){
						//Inloggad, tryckt logout						
						$lh->DoLogout();
						$xhtml .= $lw->userLoggedOut(); 
						$lw->removeCookie();
					}
					else {
						//Fortfarande inloggad
						var_dump($lh->GetAllMembers());
			 			$username = $_SESSION['username'];
						var_dump($_SESSION['username']);
						$lh->GetID();
						var_dump($_SESSION['userId']);
						//$userNumber = $_SESSION['user_id'];
						$userMessages = $lh->GetMessages();		
						//var_dump($userMessages);				
						//$userMessages = $lw->GetMessages($userMessages); //Ska eventuellt sparas i en array. 
						//$lh->GetAllMembers(); //Den här funktionen fungerar inte. 
						
						$xhtml.= $lw->userLoggedIn();
						//echo $userMessages;
						$xhtml .= $lw->PersonalInformation($username);
						
					}
				}	
			}
						
		  	else{
			  	//Utloggad-tillstånd
			  	$loginBox = $lw->DoLoginBox();					
			  	 if ($lw->TriedToLogin()) {;			  	 	
				  	 	//Utloggad vill logga in 	
				  	 	$userInput = ($lw->GetUserName());	
				  	 	$passwordInput = $lw->GetPassword();
						$userInputBeforeValidation = $userInput;	
						$passwordInputBeforeValidation = $passwordInput;
						$userInput = $validator->FormatTextString($userInput); 
						$passwordInput = $validator->FormatTextString($passwordInput); 
						
						if ($userInputBeforeValidation != $userInput){
							$xhtml .= $lw::firstEvilScript; 
						}
						
						if ($passwordInputBeforeValidation != $passwordInput){
							$xhtml .= $lw::secondEvilScript; 
						}
						
						if($lh -> NewDoLogin($lw->GetUserName(), $lw->GetPassword())){
							$username = $_SESSION['username'];
							//Metod för att hämta $userId också. 
							//$messages = $lh->GetMessages($userId);
							$xhtml .= $lw->PersonalInformation($username);
							
							
							//Just lyckats med inloggning.
							$xhtml.= $lw->userLoggedIn();
							$lh->createUserSession($userInput, $passwordInput);
							if($lw->rememberMe()){
								$lw->createCookie($lw->$userInput, $passwordInput);
							}								
						}
						else {					
							$xhtml.= $lw::FailedLogin; 
							$xhtml.= $lw->DoLoginBox(); 
						}
		  			}						
					else {
					//Utloggad men har inte försökt logga in. 
						$xhtml .= $lw->userLoggedOut(); 		
					}
		  }		
	return $xhtml; 		
	}	
}
