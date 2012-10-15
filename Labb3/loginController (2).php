<?php
require_once("loginView.php");
require_once("loginHandler.php");

class LoginController{
	
		//Användaren loggar in
		public function DoControll($db, $validator){
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
						//inloggad, tryckt logout						
						$lh->DoLogout();
						$xhtml .= $lw->userLoggedOut(); 
						$lw->removeCookie();
					}
					else {
					//Fortfarande inloggad
						$xhtml.= $lw->userLoggedIn();
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
