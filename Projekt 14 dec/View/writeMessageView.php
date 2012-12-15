<?php
class WriteMessageView{
	private $Content= "Content";
	private $SendButton= "SendButton";
	private $Receiver= "Receiver";
	private $UserListButton = "UserListButton";
	private $removeMessage = 'removeMessage';
	private $UserId = "UserId";
	private $username = "Username";
	private $sender = "Sender";
	private $MessagesId = 'MessagesId';
	
	const NoContent = "Inget meddelande fanns";
	const NoMembers = "Inga medlemmar hittades";
	const NoMessages = "Inga meddelanden hittades";
	const SentMessage = "Meddelandet har skickats";
	const BadString = "<p class='red'>Skriv i uppgifterna rätt</p>";
	

	public function WriteMessageForm(){
		return '<form action="index.php?'.NavigationView::action.'='.action::CREATE_MESSAGE.'" method="post">
		Receiver <input type="text" name="'.$this->Receiver.'" />
		Content <input type="text" name="'.$this->Content.'" />
	    <input type="submit" name="'.$this->SendButton.'" value="Skicka" />
	    </form>';
	}
	
	public function HasSentMessage(){
	  	if (isset( $_POST[$this->Content])) {   
	      return true;
	    }
		return false;
	}
	
	//Blir konstigt med encodingen här. 
	public function GetContent(){
		if (isset( $_POST[$this->Content])){
			utf8_encode($_POST[$this->Content]);
			echo $_POST[$this->Content];
			return $_POST[$this->Content];
		}
		return null;
	}
	
	public function GetReceiver(){
		if (isset( $_POST[$this->Receiver])){
			return $_POST[$this->Receiver];
		}
		return null;
	}
	
	 public function GetAllMembers($members, $enemies){
	  	
	  	if(is_Array($members)){
	  		$html = '';
	  		foreach($members as $member){
	  			if(in_array($member[$this->UserId], $enemies)){
					$html .= $this->MemberShow($member, false);
				}
				else{
					$html.=$this->MemberShow($member);
				}			
	  		}
			return $html;
	  	}
		return self::NoMembers;
	 }
	 
	 //Utgår ifrån att personen är vän från början. 
	public function MemberShow($member, $isFriend = true){
	  	return"<div class='Member'>  	
	  		<p>Användaren ".$member[$this->username]."<img class='redImage' src=".$this->FriendPicture($isFriend)."></p>	  		
	  		</div>";
	}  
	  
	 
	public function WantsUserList(){
		if (isset( $_POST[$this->UserListButton])){
			return true;
		}
		return false;
	}
	 
	 
	 public function UserListButton(){
		return '<form action="index.php?'.NavigationView::action.'='.action::CREATE_MESSAGE.'" method="post">
	    <input type="submit" name='.$this->UserListButton.' value="Alla användare" />
	    </form>';
	 }
	 
	 public function FriendPicture($isFriend){
	  	if($isFriend){
	  		return"./img/greenCheck.png";
	  	}
	  	return"./img/redX.png";
	  } 
	 
	 public function GetMessages($messages){
	  	
	  	if(is_Array($messages)){
	  		$html = '';
	  		foreach($messages as $message){
	  			$html.=$this->StandardMessage($message);			
	  		}
			return $html;
	  	}
		return self::NoMessages;
	 }
	  
	  public function StandardMessage($message){
	  	return
	  	"<div class='Message'>
	  		".$this->RemoveMessageLink($message[$this->MessagesId])."
	  		<br />
	  		<p>Användare ".$message[$this->sender]." till ".$message[$this->Receiver] ."med innehållet ". $message[$this->Content] ."</p>
	  	</div>
	  	"; 
	  }  
	  
	  public function GetMessageId(){
	  	if(isset($_GET[$this->removeMessage])){
	  		return $_GET[$this->removeMessage];
	  	}
		 return null;
	  }
	  
	   
	 public function RemoveMessageLink($messageId){
	 	return "<a class='right' href='?".NavigationView::action."=".action::REMOVE_MESSAGE."&removeMessage=$messageId'>Ta bort mig</a>";
	 }
}
