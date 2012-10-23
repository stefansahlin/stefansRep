<?php
require_once("action.php");


class NavigationView {
	const action = "action";
	//Har egentligen ingen egen output. 
	public function getAction(){
		//Den här funktionen avgör om användaren har gjort någonting med sidan. Om så borde den hämta vad från den andra klassen (action)
		if (isset($_GET[NavigationView::action])){
			return $_GET[NavigationView::action];//Den här hämtar direkt från URLen.
		}
		else {
			return action:: GetAvSidan;
		}
	}   
	
	public function createMenu(){
		return
		'<a href="index.php?'.NavigationView::action.'='.action::UPLOAD_FILE.'">Ladda upp fil</a>
		<a href="index.php?'.NavigationView::action.'='.action::CREATE_MESSAGE.'">Skapa meddelanden</a>
		<a href="index.php?'.NavigationView::action.'='.action::CHANGE_AUTHORITY.'">Ändra behörighet</a>';			
	}   
}

