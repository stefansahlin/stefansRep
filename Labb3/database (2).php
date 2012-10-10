<?php
class Database{
	
	      private $m_mysqli = NULL; 
	      const table_name = "minTabell"; 
	        
	  	//Uppkopplingen till databasen
	      public function Connect(DBConfig $config) {
		      echo "Kopplar upp mot databasen";
		      $this->m_mysqli = new mysqli("localhost", "root", "krokodil", "members"); //Det här ska flyttas och användas i settings/config istället och lösenordet ska då ändras.
		       	          
		      //Note charset should be set before any queries...
		      $this->m_mysqli->set_charset("utf8");
		      
		      // check connection
		      if ($this->m_mysqli->connect_errno) {
		          echoBr("Connect failed: $this->m_mysqli->connect_error");
		          return false;
		      }
		      return true;
	     }
		  
		//Den här funktionen används för att stoppa in information i databasen. Kontrollera först i handlern/controllern att du får göra det. 		
		//Ska ändras till 3 parametrar där id är den tredje    
        public function Insert($name) {
        	$password = "dkdk";
			$members = "members";
                $sql = "INSERT INTO " . $members . "(Username, Password) VALUES(?, ?)"; 
                $stmt = $this->m_mysqli->prepare($sql);
                
                if ($stmt === FALSE) {
                        return false;
                }
                
                if ($stmt->bind_param("ss", $name, $password) === FALSE) {

                        $stmt->close();
                        return false;
                }
                
            if ($stmt->execute()) {
                } else {
                        $stmt->close();
                        return false;
                }
                
            $stmt->close();
            return true;
        }
		
		public function NewInsert($name, $uid) {
        	$password = "dkdk";
			$members = "newmembers";
                $sql = "INSERT INTO " . $newmembers . "(Username, Password) VALUES(?, ?)"; 
                $stmt = $this->m_mysqli->prepare($sql);
                
                if ($stmt === FALSE) {
                        return false;
                }
                
                if ($stmt->bind_param("ss", $name, $password, $uid) === FALSE) {

                        $stmt->close();
                        return false;
                }
                
            if ($stmt->execute()) {
                } else {
                        $stmt->close();
                        return false;
                }
                
            $stmt->close();
            return true;
        }
	
	
		public function Remove($name) {
			$members = "members";
                $sql = "DELETE FROM ". $members . " WHERE username = ?"; 
                
                $stmt = $this->m_mysqli->prepare($sql); 
                
                if ($stmt === FALSE) {
                        return false;
                }
				
                if ($stmt->bind_param("s", $name) === FALSE) {
                        $stmt->close();
                        return false;
                }
                
            if (!$stmt->execute()) {
               
                       // echoBr("execute " . $stmt->error);
                        $stmt->close();
                        return false;
                }
                
            $stmt->close();
            return true;
        }
		
		public function NewRemove($uid) {
			$newmembers = "newmembers";
                $sql = "DELETE FROM ". $newmembers . " WHERE uid = ?"; 
                
                $stmt = $this->m_mysqli->prepare($sql); 
                
                if ($stmt === FALSE) {
                        return false;
                }
				
                if ($stmt->bind_param("i", $uid) === FALSE) {
                        $stmt->close();
                        return false;
                }
                
            if (!$stmt->execute()) {
               
                       // echoBr("execute " . $stmt->error);
                        $stmt->close();
                        return false;
                }
                
            $stmt->close();
            return true;
        }
}


