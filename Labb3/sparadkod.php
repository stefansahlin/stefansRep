<?php
//Funktionen som utför inloggningen, med ett par hårdkodade switchexempel
	public function DoLogin($name, $password)
	{
		switch ($name)
		{
		case "kalle":
			if ($password == "elak"){
				$_SESSION[$this->sessionLoggedIn]=true;
				$_SESSION[$this->sessionUsername]=true;

				return true;
				 
			}
		  break;
		case "olle":
			if ($password == "leo"){
				$_SESSION[$this->sessionLoggedIn]=true;

				return true;
			}
		  break;
		}
			
	    return false; 
		
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