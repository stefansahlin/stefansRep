<?php
class scriptValidation{
public function ValidateHTMLString($text){
			$string = htmlentities($text);
			$string = str_replace(array("&lt;p&gt;", "&lt;b&gt;", "&lt;/p&gt;", "&lt;/b&gt;"), array("<p>", "<b>", "</p>", "</b>"), $string);

			return $string;
		}
		//Funktion som inte tillåter HTML eller javascript.
		public function ValidateString($text){
			$text = htmlentities($text);
			return $text;
		}
		
		function FormatTextString($string, $allowed = false){
		 $string = preg_replace('@<script[^>]*>.+</script[^>]*>@i', "", $string); 
		 
		 if($allowed){
		  $string = strip_tags($string, "<p><b>");
		 }
		 else{
		  $string = strip_tags($string);
		 }
		 return $string;
		}
}
		

?>