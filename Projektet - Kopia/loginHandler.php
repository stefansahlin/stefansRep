<?php 
class LoginHandler{
	
	private $username = "";
	private $password = "";

	private $sessionLoggedIn = "loggedIn";
	private $sessionUsername = "anvNamn";	
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
	public function createUserSession($username){
		$_SESSION['username'] = $username; 
		echo $_SESSION['username']; 
	}
	
	public function RemoveUserSession(){
		if(isset($_SESSION['username']))
    	unset($_SESSION['username']); 
	}
	
	public function IsLoggedIn()
	{
		return isset($_SESSION[$this->sessionLoggedIn]);		
	}
	
	public function SaveUsername()
	{
		return isset($_SESSION[$this->sessionUsername]);		
	}
	
	public function SavePassword()
	{
		return isset($_SESSION[$this->sessionPassword]);		
	}
	
	
	
	public function Remove($name) { //Ändra den här så att den även tar med password och hämtar från en sessionsvariabel. 
		$members2 = "members2";
        $sql = "DELETE FROM ". $members2 . " WHERE username = ?";      
        $stmt = $this->m_mysqli->prepare($sql); 
        
        if ($stmt === FALSE) {
                return false;
        }
		
        if ($stmt->bind_param("s", $name) === FALSE) {
                $stmt->close();
                return false;
  		}
        
        if (!$stmt->execute()) {
                    $stmt->close();
                    return false;
         }
        
        $stmt->close();
        return true;
     } 	
	
	public function NewDoLogin($name, $password)
	{
		$stmt = $this->m_mysqli->prepare("SELECT * FROM `members2` WHERE `Username` = ? AND `Password` = ?");
		$stmt->bind_param("ss", $name, $password); 
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows > 0){
		$_SESSION[$this->sessionLoggedIn]=true;
		 	return  true;
		 }
		else {
			return false;
		}
						
	}
	public function DoLogout()
	{
		unset($_SESSION[$this->sessionLoggedIn]);
	}
	
	public function GetID()
	{
		$username = $_SESSION['username']; 
		var_dump($username);	
		 $query = $this->m_mysqli->prepare("SELECT `P_Id` FROM members2 WHERE `username` = ?");
		 $query->bind_param("s", $username);  
		 $query->bind_result($userId);
		 $query->execute();
		 $query->store_result();
		 //var_dump($query);
		 While($query->fetch()){

		  $this->userId = $userId;
		  $_SESSION['userId']= $userId;	
		  
		  }
	
	}
	
	public function GetMessages(){
		//Gör om den här
		$userId = $_SESSION['userId'];
		$membersArray = Array();			
		$stmt = $this->m_mysqli->prepare("SELECT `Sender`, `Content`, `Receiver` FROM `messages3` WHERE `Sender` = ?");	
		$stmt->bind_param("i", $userId);   //Verkar bli något fel här
		$stmt->bind_result($sender, $content, $receiver); 
	    $stmt->execute();		
	    while ($stmt->fetch()) {
	        	 $membersArray[] = array(
				 'sender' => $sender, 
				 'content' =>$content, 
				 'receiver' => $receiver			 
				 );
				 
		} 

	    $stmt->close();
		var_dump($membersArray);
		return $membersArray;
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
}

