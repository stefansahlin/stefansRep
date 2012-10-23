<?php
class WriteMessageView{
	private $Content= "Content";
	private $SendButton= "Password";
	
	public function WriteMessageForm(){
		//Eventuellt ska meddelandet se annorlunda ut med fler faktorer senare.
		return '<form action="index.php?'.NavigationView::action.'='.action::CREATE_MESSAGE.'" method="post">
		<input type="text" name="Receiver" />
		<input type="textarea" name="Content" />
	    <input type="submit" name="SendButton" value="Skicka" />
	    </form>';
	}
	
	public function HasSentMessage(){
	  	if (isset( $_POST[$this->Content])) {
	      
	      return $_POST[$this->Content];
	    }
		else {
			return null;
		}
	}
	
	
	public function GetAllUsers($allUsers){
	  	//Den här funktionen ska användas när man ska ändra behörighet. Den bör därför hämtas i samband med att man är inne i den Controllern och ligga i en handler
	  	//Gör på samma motsvarande sätt som när du hämtade alla meddelanden från en och samma användare.
	  	if(is_Array($allUsers)){
	  		$html = '';
	  		foreach($allUsers as $user){
	  			$html.= "<p>$message<p>";
			
	  		}
			return $html;
	  	}
		return 'Inga meddelanden hittades';
	 }
	  
}
