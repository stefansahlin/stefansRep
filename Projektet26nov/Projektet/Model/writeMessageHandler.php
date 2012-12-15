<?php

class WriteMessageHandler{
	private $m_mysqli;
	private $messages3 = "messages3";
	private $username = "username";
	private $userId = "userId";
	
	public function __construct(DBConfig $config) { 
	      $this->m_mysqli = new mysqli($config->m_host, $config->m_user, $config->m_pass, $config->m_db); 
	      $this->m_mysqli->set_charset("utf8");
	}
	
	
	public function GetAllMembers(){
		$username = $this->username;
		$membersArray = Array();			
		$query = "SELECT Username, P_Id FROM Members2";		//Kör bind_param här. 
		$result = $this->m_mysqli->query($query);
		while ($row = $result->fetch_array()){
			$membersArray[] = $row;
		} 
		return $membersArray;
	}

	
	public function GetID($receiver)
	//receiver är alltså användarnamnet
	{
		 $query = $this->m_mysqli->prepare("SELECT `P_Id` FROM members2 WHERE `username` = ?");
		 $query->bind_param("s", $receiver);  
		 $query->bind_result($userId);
		 $query->execute();
		 $query->store_result();

		 if($query->fetch()){
			  return $userId;	
		 }
		 return null;	
	}
	
	
	//Kan eventuellt fixas en funktion som blockerar meddelanden som skickas till en fiende.  
	public function SaveWrittenMessage($sender, $receiver, $content){
		//Ta in enemies som en fjärde inparameter. Om den finns inuti enemies så ska inte meddelandet kunna skickas och felmeddelande göras. 
		$messages3 = $this->messages3;
        $sql = "INSERT INTO " . $messages3 . "(Sender, Receiver, Content) VALUES(?, ?, ?)"; 
        $stmt = $this->m_mysqli->prepare($sql);
       
        $stmt->bind_param("iis", $sender, $receiver, $content);
        $stmt->execute();
        $stmt->close();
				
	}

	public function BlockedEnemies($userId){
		$enemies =  Array();
		$stmt = $this->m_mysqli->prepare("SELECT `BlockedId` FROM access2 WHERE `UserId` = ?");
		
		$stmt->bind_param("i", $userId);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_array()){
			$enemies[] = $row['BlockedId']; 
		}	
		return $enemies;
	}
	
	public function RemoveMessage($messageId){
		//Kolla här att det är användaren som har skrivit det här meddelandet. 
		echo"removar";
		$stmt = $this->m_mysqli->prepare("DELETE FROM messages3 WHERE Messages_Id = ?");
		$stmt->bind_param("i", $messageId);
		$stmt->execute();
		$stmt->close();
	}
	
		//Har här gjort en ändring i arraynamnet. Stäm av mot tidigare versioner att namnet verkligen stämmer. 
	public function GetMessages(){
		//Den här versionen ska se till så att enemies-meddelanden inte följer med. 
		$userId = $_SESSION[$this->userId];
		$messagesArray = Array();			
		$stmt = $this->m_mysqli->prepare("SELECT `Messages_Id`, `Sender`, `Content`, `Receiver` FROM `messages3` WHERE `Sender` = ?");	
		$stmt->bind_param("i", $userId);   
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_array()){
			$messagesArray[] = $row;
		}
		
	    $stmt->close();
		return $messagesArray;
	}
	
}