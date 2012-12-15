<?php

class WriteMessageHandler{
	private $m_mysqli;
	private $messages = "messages";
	private $username = "username";
	private $userId = "userId";
	private $blockedId = "BlockedId";
	
	public function __construct(DBConfig $config) { 
	      $this->m_mysqli = new mysqli($config->m_host, $config->m_user, $config->m_pass, $config->m_db); 
	      $this->m_mysqli->set_charset("utf8");
	}
	
	
	public function GetAllMembers(){
		$username = $this->username;
		$membersArray = Array();			
		$query = "SELECT Username, UserId FROM members";	
		$result = $this->m_mysqli->query($query);
		while ($row = $result->fetch_array()){
			$membersArray[] = $row;
		} 
		return $membersArray;
	}

	
	public function GetID($receiver)
	{
		 $query = $this->m_mysqli->prepare("SELECT `UserId` FROM members WHERE `Username` = ?");
		 $query->bind_param("s", $receiver);  
		 $query->bind_result($userId);
		 $query->execute();
		 $query->store_result();

		 if($query->fetch()){
			  return $userId;	
		 }
		 
		 return null;	
	}
	
	
	public function SaveWrittenMessage($sender, $receiver, $content){
		$messages = $this->messages;
        $sql = "INSERT INTO " . $messages . "(UserId, ReceiverId, Content) VALUES(?, ?, ?)"; 
        $stmt = $this->m_mysqli->prepare($sql);
       
        $stmt->bind_param("iis", $sender, $receiver, $content);
        echo $content;
        $stmt->execute();
        $stmt->close();
				
	}

	public function BlockedEnemies($userId){
		$enemies =  Array();
		$stmt = $this->m_mysqli->prepare("SELECT `BlockedId` FROM access WHERE `UserId` = ?");
		
		$stmt->bind_param("i", $userId);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_array()){
			$enemies[] = $row[$this->blockedId]; 
		}	
		return $enemies;
	}
	
	public function RemoveMessage($messageId){
		echo"removar";
		var_dump($messageId);
		$stmt = $this->m_mysqli->prepare("DELETE FROM messages WHERE MessagesId = ?");
		$stmt->bind_param("i", $messageId);
		$stmt->execute();
		$stmt->close();
	}
	
	public function GetMessages($userId, $blockedArray = array()){
		$messagesArray = Array();			
		$stmt = $this->m_mysqli->prepare("SELECT `MessagesId`, `UserId`,`Content`, (SELECT Username FROM members WHERE members.UserId=messages.UserId) AS Sender, (SELECT Username FROM members WHERE members.UserId=messages.ReceiverId) AS Receiver FROM `messages` WHERE `UserId` OR ReceiverId = ?");	
		$stmt->bind_param("i", $userId);   
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_array()){
			if(!in_array($row['UserId'], $blockedArray)){
				$messagesArray[] = $row;	
			}
		}
		
	    $stmt->close();
		return $messagesArray;
	}
	
}