<?php
require_once("./Model/WriteMessageHandler.php");
require_once("./View/WriteMessageView.php");

class WriteMessageController{
	
	private $loggedIn = "loggedIn";
	private $userId = "userId";
	private $username = "username";
	
	public function WriteMessageControll(DBConfig $db, $validator){
		
		//Funktionen kan bara köras om användaren är inloggad
		if (isset($_SESSION[$this->loggedIn]))
 		{
	 		$body = "";			
			$wmw = new WriteMessageView();
			$wmh = new WriteMessageHandler($db);
			$body .= $wmw->UserListButton();
			$userId = ($_SESSION[$this->userId]);
			
			$userMessages = $wmh->GetMessages();					
			$body  .= $wmw->GetMessages($userMessages); 		
		
			if ($wmw->WantsUserList()){
				$members = ($wmh->GetAllMembers());	
				$enemies = 	$wmh->BlockedEnemies($userId);	
				$body .= $wmw->GetAllMembers($members, $enemies) . $wmw->WriteMessageForm();
				return $body;
			}
			
			if(($messageId = $wmw->GetMessageId())!= null){
				$wmh->RemoveMessage($wmw->GetMessageId());
				return $body;
			}
			
		
			//Användaren har skickat ett meddelande. Glöm inte kontrollfunktioner. 
			if($wmw->HasSentMessage()){
				$content = $wmw->GetContent();
				$receiver = $wmw->GetReceiver();
				$sender = $_SESSION[$this->username];		
				$receiverId = $wmh->GetID($receiver);
				$senderId = $wmh->GetID($sender);		
				$wmh->SaveWrittenMessage($senderId, $receiverId, $content);
				//Hitta ett sätt att presentera det meddelande som har skickats eller åtminstone bekräfta att meddelandet har sparats.
			}		
			
			$body .= $wmw->WriteMessageForm();
			
			return $body;
		}		
	}
}