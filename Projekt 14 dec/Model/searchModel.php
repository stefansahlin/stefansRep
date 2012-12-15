<?php

class SearchModel{
	public function __construct(DBConfig $config) { 
			  $this->m_mysqli = new mysqli($config->m_host, $config->m_user, $config->m_pass, $config->m_db); 
			  $this->m_mysqli->set_charset("utf8");
	}
	
	public function GetAllMessages($searchPhrase, $userId){
		$messagesArray = Array();	
		$searchPhrase = '%'.$searchPhrase.'%';		
		$stmt = $this->m_mysqli->prepare("SELECT `MessagesId`, `Content`, (SELECT Username FROM members WHERE members.UserId=messages.UserId) AS Sender, (SELECT Username FROM members WHERE members.UserId=messages.ReceiverId) AS Receiver FROM messages WHERE (messages.`UserId`=? OR messages.`ReceiverId`=?) AND messages.`Content` LIKE ? ");
		$stmt->bind_param("iis", $userId, $userId, $searchPhrase);  
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_array()){
			$messagesArray[] = $row;
		}		
	    $stmt->close(); 
		
		return $messagesArray;
	}
	
}