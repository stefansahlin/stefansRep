<?php
require_once("loginView.php");
require_once("loginHandler.php");
//Här kallar jag på en ny LoginView, skapar en instans
//Hanterar inloggning och utloggning, så förmodligen så ska kopplingen till loginview ligga i den här klassen. 
//Ser till att rätt ändringar sker i modell. 
//Använder rätt vyer för att skapa utdata, DoOutput

class LoginController{
	
		//Användaren loggar in
		public function DoControll($db){
			$lw = new LoginView();
			$lh = new LoginHandler($db);
			$xhtml = ""; 
			$xhtml .= $lw::Rubrik;
			
			echo"tester";
			var_dump($lh->IsLoggedIn());
			var_dump($lw->RemoveUser());
	
		  	if ($lh->IsLoggedIn()) {
		  	//Lägg in kod för vad som händer om användaren trycker på "ta bort medlem-knappen"
			//Vid inloggad
			
				if ($lw->RemoveUser()){
					echo"Du har försökt ta bort användaren";
					$removeName = $_SESSION['username'];
					$lh->Remove($removeName); //Verkar fungera		
					$lh->RemoveUserSession();	
					//Redirecta till en annan sida. 	
				}
		

				$xhtml .= $lw::Brk;
								
				if ($lw->TriedToLogout()){
					//inloggad, tryckt logout
					$lh->DoLogout();
					$xhtml.= $lw->DoLoginBox();
					$xhtml.= $lw::Loggedout; //view :: loggedInMessage()
					$xhtml .= $lw::Brk;
					//var_dump($_SESSION['username']);
					$lw->removeCookie();
					//$lh->removeUserSession();
				}
				else {
				//Fortfarande inloggad
					$xhtml.= $lw::Inloggad;
					$xhtml.= $lw->DoLogoutBox();
					echo $lw->RemoveButton();
				}
			}	
						
		  	else{
			  	//Utloggad-tillstånd
			  	$loginBox = $lw->DoLoginBox();
					
			  	 if ($lw->TriedToLogin()) {
			  	 	//Utloggad vill logga i 			
					if($lh -> NewDoLogin($lw->GetUserName(), $lw->GetPassword())){
						//Just lyckats med inloggning.
						$xhtml .= $lw::Inloggad; 
						$xhtml .= $lw->DoLogoutBox();
						echo $lw->RemoveButton();
						$lh->createUserSession($lw->GetUsername(), $lw->GetPassword());
						if($lw->rememberMe()){
							$lw->createCookie($lw->GetUserName(), $lw->GetPassword());
						}								
					}
					else {
					
						$xhtml.= $lw::FailedLogin; 
						$xhtml.= $lw->DoLoginBox(); 
					}
	
		  		}
						
		else {
		//Utloggad men har inte försökt logga in. 
			$xhtml .= $lw::Utloggad;
			$xhtml .= $loginBox;			
		}
	  }
	  
		
		echo $xhtml; 		
	}
	
}

//Returnera hela dokumentet när du lyckas. 
//Få allting när jag returnerar DoLoginBox, istället för att hålla på att returnera $xhtml