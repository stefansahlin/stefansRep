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
	            <div id='LoginStuff'>$body</div>
	            <div id='messagesArea'><p>Här ska alla meddelanden ligga</p></div>
	            </div>
	            
            </div>
            <div id='Footer'>@Stefan Sahlin 2012</div>
          </body>
        </html>";
        
    return $html;
  }
}
