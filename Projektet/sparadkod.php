<?php
//Funktionen som utf�r inloggningen, med ett par h�rdkodade switchexempel
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
		
		//Klassen CreateUserController
		<?php
require_once("createuserview.php");
require_once("memberhandler.php");
class createUserController{
	
	
	public function cucControll($db){
		$output= "";
			
		$v = new Validation(); 
		$cuw = new createUserView();
		$name = "mittNamn";
		
		$user = $cuw->Username;
		$firstPassword = $cuw->Password1;
		$secondPassword = $cuw->Password2;
			
			
		if ($_SERVER['REQUEST_METHOD'] == 'GET'){ //Om bli medleml�nken har klickats

			echo $cuw->NewMemberBox();
			$output.= $cuw->NewMemberBox();
			//De h�r variablarna �r eventuellt �verfl�diga
			$user = $cuw->Username;
			$firstPassword = $cuw->Password1;
			$secondPassword = $cuw->Password2;
			$cuw->createNewMember($user, $firstPassword);
			
		  }
			//Sl�r till n�r anv�ndaren skickar formul�ret med post.
		 else {
			$user = $cuw->GetNewUsername();
			$fPassword = $cuw->GetFirstPassword();
			$sPassword = $cuw->GetSecondPassword();
			
			var_dump($user);
			var_dump($fPassword);
			var_dump($fPassword);

			$mh = new MemberHandler($db);				
			$validator = new Validation();		
			$user = $validator->FormatTextString($user); //Funktionen f�r att se att ingen ful kod har skrivits in. Samma sak p� alla f�lten. Ska egentligen returnera n�got annat.
			$fPassword = $validator->FormatTextString($fPassword); 
			$sPassword = $validator->FormatTextString($sPassword); 
			echo"Efter str�ngbytet";
			
			var_dump($user);
			var_dump($fPassword);
			var_dump($fPassword);
		
			
			
			
						
			$validUsernameTest = $mh->ValidUsername($user);			
			if ($validUsernameTest == false){
				echo "F�r kort anv�ndarnamn";
				//return $shortErrorMessage
				echo $cuw->NewMemberBox();
				return false;
	 		}
						
			$ValidPasswordTest = $mh->ValidPasswordCheck($fPassword);
			if ($ValidPasswordTest == false){
				echo "F�r kort l�senord";
				echo $cuw->NewMemberBox();
				return false;
			}
						 
			$samePasswordTest = $mh->samePasswordCheck($fPassword, $sPassword);
			if ($samePasswordTest == false){
				echo "Two different passwords";
				echo $cuw->NewMemberBox();
				return false;
			}
			
			
			$mh->existingUsernameCheck($user);
			if($mh->existingUsernameCheck($user) ==true){
				$output .= "namnet finns redan";
				echo "namnet finns redan";
				echo $cuw->NewMemberBox();
				return false;
			}
			
			$mh->NewInsert($user, $fPassword);
			echo "Du har nu registrerad din anv�ndare. G� till hemsidan f�r att logga in.";
			//Skicka ut l�nken till index.html.
			
					
		     //N�r kontrollerna �r k�rda
						
			//return $cuw->NewMemberBox();
 		}
	}	
}
