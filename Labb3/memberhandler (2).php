<?php
//Här ligger reglerna som har att göra med att användaren skapar sitt konto. 
class MemberHandler{
	private $m_mysqli;
	
	      public function __construct() { //Skicka in dbConfig config här
		      $this->m_mysqli = new mysqli("localhost", "root", "krokodil", "members"); 
			  // $this->m_mysqli = new mysqli($config->m_host, $config->m_user, $config->m_pass, $config->mdb); 	 
			  $this->m_mysqli->set_charset("utf8");      	        
		      //return true;
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
		  		  
		 public function NewInsert($name, $password) {
				$members2 = "members2";
	            $sql = "INSERT INTO " . $members2 . "(Username, Password) VALUES(?, ?)"; 
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
		  		
		public function samePasswordCheck($firstPassword, $secondPassword){
			if ($firstPassword != $secondPassword){
				return false;
			}
			else{
				return true;
			}
		}
	
	public function ValidPasswordCheck($password){
		if (strlen($password) < 6){
			return false;
		}
		else{
			return true;
		}
	}
	
	//Här behöver funktionen åtkomst till databasen. Se om du kan skicka med databasen som variabel. 
	
	public function existingUsernameCheck($username){
			
			$members2 = "members2";
            $sql = "SELECT * FROM ". $members2 ." WHERE Username = ?";            
            $stmt = $this->m_mysqli->prepare($sql); 
			$stmt->bind_param("s", $username);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows >0){
				//finns redan
				return true;
			}
			return false;
	}
		
	//Funkar som den ska
	public function validUsername($username){
		if (strlen($username) < 1){
			return false;
		}
		else {
			return true;
		}
	}	
	
}
