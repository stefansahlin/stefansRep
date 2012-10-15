<?php


class Validation {
	
	
	public function checkEmail($unCheckedEmail) {
		
		if(filter_var($unCheckedEmail, FILTER_VALIDATE_EMAIL)) {
			
			return true;
		}	
		return false;
	}
	
	
	public function checkUsername($unCheckedUsername) {
		//Vi kollar om användarnamnet är större än 4 och mindre eller lika med 20.
		if(strlen($unCheckedUsername) > 4 && strlen($unCheckedUsername) <= 20) {
		
			//Vi kollar om några taggar har tagits bort, om så är fallet, returnera false.
			if($this->stripTags($unCheckedUsername)) {
			
				return true;	
			}	
			
		}	
		return false;
	}
	
		
	public function checkPassword($uncheckedPassword1, $uncheckedPassword2) {
		//Vi jämför om båda lösenorden är likadana.
		if($uncheckedPassword1 == $uncheckedPassword2) {
			//Kollar längden på lösenordet
			if(strlen($uncheckedPassword1) > 5) {
				//Kollar så att inga taggar etc finns.
				if($this->stripTags($uncheckedPassword1)) {			
					return true;
				}
			}
				
		}
		return false;
	}
	
	
	public function checkPersonNummer($uncheckedPersonNummer) {
		
		//Formatet 19900123-3890 , 9001233890, 900123-3890, 19900123-3890, 199001233890
		$regEx = '~^(((20)((0[0-9])|(1[0-2])))|(([1][^0-8])?\d{2}))((0[1-9])|1[0-2])((0[1-9])|(2[0-9])|(3[01]))[-]?\d{4}$~';
		$correctRegEx ="^[0-9]{1,10}$^";
		if(preg_match($regEx, $uncheckedPersonNummer)) {
				
			$correctFormat = $this->createCorrectPersonNummer($uncheckedPersonNummer);
			if(preg_match($correctRegEx,$correctFormat)) {
				
				//TODO luhn check.
				
				return true;
				
			}
		}
		
		return false;
	}
	
	public function stripTags($unStrippedString) {
		
		$strippedString = strip_tags($unStrippedString);
		//Om inga taggar har tagits bort så är strängarna likadana.
		if($strippedString == $unStrippedString) {
			
			return true;
		}
		
		
		return false;
	}
	
	public function checkDate($uncheckedDate) {
		
		//1990-01-23
		$regEx = "/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/";
		if(preg_match($regEx, $uncheckedDate)) {
			
			return true;
		}
		//90-01-23
		$regEx = "/^[0-9]{2}-[0-9]{2}-[0-9]{2}$/";
		if(preg_match($regEx, $uncheckedDate)) {
			
			return true;
		}
		//900123
		$regEx = "^[0-9]{1,6}$^";
		if(preg_match($regEx, $uncheckedDate)) {
			
			return true;
		}
		
		return false;
	}
	
	
	public function luhn_check($number) {
		settype($number, 'string');
		$sumTable = array(
		array(0,1,2,3,4,5,6,7,8,9),
    	array(0,2,4,6,8,1,3,5,7,9));
  
    	$sum = 0;
    	$flip = 0;
  
    	for ($i = strlen($number) - 1; $i >= 0; $i--) {
	    	$sum += $sumTable[$flip++ & 0x1][$number[$i]];
	    }
	    
	    return $sum % 10 === 0;
	}
	
	//Gör om personnummret till 9001233890
	public function createCorrectPersonNummer($incorrectFormat) {
		$correctFormat="";
		
		//Gör ingenting
		if(strlen($incorrectFormat) == 10) {
			
			$correctFormat = $incorrectFormat;
		}
		//Tabort 2 första siffrorna
		if(strlen($incorrectFormat) == 12) {
			
			$correctFormat = substr($incorrectFormat, 0, 2);
		}
		//Tabort 2 första siffrorna och bindestrecket
		if(strlen($incorrectFormat) == 13) {
			
			$correctFormat = substr($incorrectFormat, 10, 1);
			$correctFormat = substr($incorrectFormat, 0, 2);
		}
		//Tabort bindestrecket
		if(strlen($incorrectFormat) == 11) {
			
			$correctFormat = substr($incorrectFormat, 6, 1);
			$correctFormat = $incorrectFormat;
		}
		
		
		return $correctFormat;
	}
}


