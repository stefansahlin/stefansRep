<?php 
//Den här klassen sköter regler som har att göra med:
//Är personen inloggad?
//Vem får logga in
//Affärslogiska regler som återanvänds på flera ställen i applikationen. Vilka är de affärslogiska reglerna.
class LoginHandler{
	
	private $username = "";
	private $password = "";

	private $sessionLoggedIn = "loggedIn";
	private $sessionUsername = "anvNamn";
	
	public function __construct(DBConfig $config) {
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
	public function createUserSession($username){//Rätt uppgifter kommer in. Bör räcka med endast username eftersom användarnamnen är unika.
		$_SESSION['username'] = $username; //Fungerar
		echo $_SESSION['username']; 
	}
	
	public function RemoveUserSession(){//Rätt uppgifter kommer in. Bör räcka med endast username eftersom användarnamnen är unika.
		if(isset($_SESSION['username']))
    	unset($_SESSION['username']); 
	}
	
	
	
	//Boolfunktion som tar reda på om användaren är inloggad
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
	               
	                       // echoBr("execute " . $stmt->error);
	                        $stmt->close();
	                        return false;
	             }
                
	            $stmt->close();
	            return true;
         } 	
	
	//Funktionen som utför inloggningen, med ett par hårdkodade switchexempel
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
	
	//Funktion som ansvarar för utloggning
	public function DoLogout()
	{
		unset($_SESSION[$this->sessionLoggedIn]);
		//gör motsvarande unset på username och password också.
	}
	
	
	
}
