<?php
class MemberHandler{
	private $m_mysqli;
	private $members = "members";
	
     public function __construct(DBConfig $db) { 
	 	$this->m_mysqli = new mysqli($db->m_host, $db->m_user, $db->m_pass, $db->m_db); 	 
	 	$this->m_mysqli->set_charset("utf8");      	        
     }
	  		  	  		  
	 public function NewInsert($name, $password) {	
		$members = $this->members;
        $sql = "INSERT INTO " . $members . "(Username, Password, tempPassword) VALUES(?, ?, 0)"; 
        $stmt = $this->m_mysqli->prepare($sql);
        
        if ($stmt === FALSE) {
                return false;
        }
        
        if ($stmt->bind_param("ss", $name, $password) === FALSE) {

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
		  		

	
	public function existingUsernameCheck($username){			
        $sql = "SELECT * FROM `members` WHERE Username = ?";            
        $stmt = $this->m_mysqli->prepare($sql); 
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows >0){
			return true;
		}
		return false;
	}
	
	public function countRows(){
		$stmt = $this->m_mysqli->prepare("SELECT * FROM members");
		$stmt->execute();
		$result = $stmt->num_rows;
		
		return $result;
	}
	
	public function test(DBConfig $db, $uname, $pword) {
				
               
                $numberOfPostBefore = $this->countRows();
               
                $this->NewInsert($uname, $pword);
				
               
                $numberOfPostAfter = $this->countRows();
               
                if ($numberOfPostBefore +1 != $numberOfPostAfter) {
                     
						
                        return false;
                }
               
			
              
               
            return true;
        }       
}
