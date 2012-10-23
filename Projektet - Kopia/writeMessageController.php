<?php
require_once("WriteMessageHandler.php");
require_once("WriteMessageView.php");

class WriteMessageController{
	public function WriteMessageControll($db, $validator){
		$wmw = new WriteMessageView();
		$wmh = new WriteMessageHandler($db);
		
		if($wmw->HasSentMessage() == true){
			echo "Användaren har skickat ett meddelande";
		}
		
		$messageForm = $wmw->WriteMessageForm();
		echo $messageForm;
		
	}
}