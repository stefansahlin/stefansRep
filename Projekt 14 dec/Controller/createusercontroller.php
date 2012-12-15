<?php
require_once("./View/createuserview.php");
require_once("./Model/memberhandler.php");
require_once("./Validation4.php");
class createUserController{
	
	public function cucControll(DBConfig $db){
		$output= "";
			
		$cuw = new createUserView();
		$user = $cuw->Username;
		$firstPassword = $cuw->Password1;
		$secondPassword = $cuw->Password2;
			
		//Sidan hämtas men inte från formuläret	
		if ($_SERVER['REQUEST_METHOD'] == 'GET'){ 
			$output.= $cuw->NewMemberBox();
		  }
		
		 else {
		 	if($cuw->IsSubmit()){
				$user = $cuw->GetNewUsername();
				$fPassword = $cuw->GetFirstPassword();
				$sPassword = $cuw->GetSecondPassword();
				
				$mh = new MemberHandler($db);				
				$validator = new Validation();
						
				if(!$validator->CheckUsername($user)){
					$output .=$cuw->NewMemberBox().$cuw::usernameErrorMessage;
				}
				elseif(!$validator->CheckPassword($fPassword, $sPassword)){
					$output .=$cuw->NewMemberBox().$cuw::passwordErrorMessage;
				}
				elseif($mh->existingUsernameCheck($user)){
					$output .=$cuw->NewMemberBox().$cuw::alreadyExistingUser;
				}
				else{
					if($mh->NewInsert($user, $fPassword)){
						$output .= $cuw->successfulRegistration();
					}
					else{
						$output .= $cuw->NewMemberBox().$cuw::errorMessage;
					}					
				}
			}
			else{
				$output.= $cuw->NewMemberBox();
			}
 		}
	return $output;
	}
}	

