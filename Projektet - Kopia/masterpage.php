<?php

class MasterPage{
	
	public function __construct($charset = "utf-8") {
    $this->m_charset = $charset;
  	}
	private $m_charset;
	
	
	 
	public function GetHTMLPage($title,$body, $links) {
    
    $html = "
        <!DOCTYPE HTML SYSTEM>
        <html>
          <head>
            <title>$title</title>
            <meta http-equiv='content-type' content='text/html; charset=$this->m_charset'>
            <link rel='stylesheet' type='text/css' href='project.css'>          
          </head>
          <body>
            <div id='Header'><h1>Stefans Projekt</h1></div>
            <div id='Container'>
           		<div id='RightColumn'>$links</div>
	            <div id='Main'>Main 
	            <div id='LoginStuff'></div>
	            <div id='messagesArea'><p>Här ska alla meddelanden ligga</p>$body</div>
	            </div>
	            
            </div>
            <div id='Footer'>@Stefan Sahlin 2012 <form name='search_bar' method='get' >
				  <table width='400' border='1' cellpadding='5'>
				    <tr>
				      <td>
				        Search:<input type='text' name='searchInput' size='30' maxlength='30'>
				        <input type='submit' value='Sök'>
				      </td>
				    </tr> </div>
          </body>
        </html>";
        
    return $html;
  }
}
