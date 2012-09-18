<?php
require_once("loginView.php");
require_once("loginHandler.php");
//Här kallar jag på en ny LoginView, skapar en instans
//Hanterar inloggning och utloggning, så förmodligen så ska kopplingen till loginview ligga i den här klassen. 
//Ser till att rätt ändringar sker i modell. 
//Använder rätt vyer för att skapa utdata, DoOutput

class LoginController{
	
	
	public function DoControll(){
		$lw = new LoginView();
		$lh = new LoginHandler();
		$xhtml = ""; 
		$xhtml .= "<h2>Login Controller</h2> ";
		//TODO ändra echo till xhtml.=

	  if ($lh->IsLoggedIn()) {
	  			
				//$result = $lw->LoggedInMessage();
				
				//echo $result;
				//echo "<br/>";
				//$xhtml .= $result;
				$xhtml .= "<br/>";
				
				
				if ($lw->TriedToLogout()){
				//Den här ska alltid lyckas.
				$lh->DoLogout();
				$xhtml.= $lw->DoLoginBox();
				$xhtml.= "Du har just loggat ut";
				$xhtml .= "<br/>";
				}
				else {
					//echo $lw->DoLogoutBox();
				
					$xhtml.= $lw->DoLogoutBox();
					//$xhtml.= "inloggad"; //Den här visas vid fel tillfälle
					//Här ska meddelandet ges att användaren än så länge är inloggad och för att logga ut, klicka på den där knappen. 
				}
			}
		
		
	  else{
	  	//Utloggad-tillstånd
	  	$loginBox = $lw->DoLoginBox();
				
	  	 if ($lw->TriedToLogin()) {
	  			 			
			if($lh -> DoLogin($lw->GetUserName(), $lw->GetPassword())){
				//Just lyckats med inloggning.
				$xhtml .= "Du är nu inloggad"; //Hur få den här att inte slå till när användaren precis har loggat ut. 
				$xhtml .= $lw->DoLogoutBox();
				if($lw->rememberMe()){
					$lw->createCookie($lw->GetUserName(), $lw->GetPassword());
				}				
			}
			else {
				//Försökt logga in men mysslyckats.
				//Här kan vi eventuellt lägga till if-satser som pekar på vad som har gått fel. 
				$xhtml.= "Du misslyckades med inloggningen"; //Kan möjligtvis bytas mot att skriva om det är användarnamnet, lösenordet eller blanksteg som är problemet. 
				$xhtml.= $lw->DoLoginBox(); //Kör bara med $loginBox()
			}

	  	}
				
		
		
			else {
	
				$xhtml .= "utloggad";
				$xhtml .= $loginBox;			
			}
	  }
	  
		
		return $xhtml; 		
	}
	
}
//Du kan eventuellt byta fraserna $xhtml till variablar som hämtar från vyn
