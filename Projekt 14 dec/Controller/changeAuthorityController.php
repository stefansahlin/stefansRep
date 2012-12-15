<?php
require_once("./View/changeAuthorityView.php");
require_once("./Model/changeAuthorityModel.php");
class ChangeAuthorityController{
	
	private $userId = "userId";
	private $membernumber = "membernumber";
	
	public function ChangeAuthorityControll(DBConfig $db, Validation $validator, $userId){	 		
	 		$body = "";
			$cam = new ChangeAuthorityModel($db, $userId);
	 		$caw = new ChangeAuthorityView();						
			
			if ($caw->WantToBlock() == true){			
				$blockingId = $caw->BlockingId();
				$cam->Block($blockingId);
			}
			
			$enemies = 	$cam->BlockedEnemies($userId);			
			$members = $cam->GetAllMembers();	
			$body .= $caw->GetAllMembers($members, $enemies); 			
			
			return $body;
	}
}