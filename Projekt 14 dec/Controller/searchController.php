<?php
require_once("./View/searchView.php");
require_once("./Model/searchModel.php");

class SearchController{
 	
	 	public function DoControll(DBConfig $db, Validation $validator, $userId){
			 		
	 		$body = "";
			$sm = new SearchModel($db);
	 		$sw = new SearchView();	
			$body .= $sw::Rubrik;
			
			if ($sw->HasMadeSearch()){
				$searchPhrase = $validator->FormatTextString($sw->GetSearchPhrase());
				$messages = $sm->GetAllMessages($searchPhrase, $userId);
				$body .= $sw->ShowMessages($messages);
				$body .= $sw->SearchForm();				
				return $body;
			}			
			$body = $sw->SearchForm();	
			return $body;		
	}
}

