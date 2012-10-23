<?php

class WriteMessageHandler{
	
	public function __construct(DBConfig $config) { 
		      $this->m_mysqli = new mysqli("localhost", "root", "krokodil", "members"); //Det här ska flyttas och användas i settings/config istället och lösenordet ska då ändras.
		      // $this->m_mysqli = new mysqli($config->m_host, $config->m_user, $config->m_pass, $config->mdb); 
		      $this->m_mysqli->set_charset("utf8");
		      if ($this->m_mysqli->connect_errno) {
		          echoBr("Connect failed: $this->m_mysqli->connect_error");
		          return false;
		      }
		      return true;
	}
	
	
	
	public function GetAllMembers(){
		$username = 'username';
		$membersArray = Array();			
		$query = "SELECT Username FROM Members2";
		$result = $this->m_mysqli->query($query);
		while ($row = $result->fetch_array()){
			$membersArray[] = $row;
		} 
		return $membersArray;
	}
	
	public function GetAllMessanges(){
		//Gör om den här
		$username = 'username';
		$membersArray = Array();			
		$stmt = $this->m_mysqli->prepare("SELECT `Messages` FROM `members2`");	
		$stmt->bind_param("s", $username);   //Verkar bli något fel här. 
	    $stmt->execute();		
	    while ($stmt->fetch()) {
	        	 $membersArray[] = $username;
				 
	    }
	    $stmt->close();
		var_dump($membersArray);
		return $membersArray;
	}
	
	public function SaveWrittenMessage($sender, $receiver, $content){
				$messages3 = "messages3";
	            $sql = "INSERT INTO " . $messages3 . "(Sender, Content, Receiver) VALUES(?, ?, ?)"; 
	            $stmt = $this->m_mysqli->prepare($sql);
	            
	            if ($stmt === FALSE) {
	                    return false;
	            }
	            
	            if ($stmt->bind_param("isi", $sender, $content, $receiver) === FALSE) {
	
	                    $stmt->close();
	                    return false;
	            }
	            
		        if ($stmt->execute()) {
		        } 
	            else {
	                    $stmt->close();
	                    return false;
	            }
		            
		        $stmt->close();
		        return true;
	 }
}