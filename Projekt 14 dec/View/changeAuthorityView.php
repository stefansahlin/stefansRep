<?php
class ChangeAuthorityView{
	//Strängberoenden borttagna
	private $switchButton = "SwitchButton";
	private $username = "Username";
	private $UserId = 'UserId';
	private $membernumber = "membernumber";
	
	 public function GetAllMembers($members, $enemies){
	  	
	  	if(is_Array($members)){
	  		$html = '';
	  		foreach($members as $member){
	  			if(in_array($member[$this->UserId], $enemies)){
					$html .= $this->MemberShow($member, false);
				}
				else{
					$html.=$this->MemberShow($member);
				}			
	  		}
			return $html;
	  	}
		$html = "Inga medlemmar hittades";
		return $html;
	 }
	 
	  public function MemberShow($member, $isFriend = true){
	  	return"<div class='Member'>  	
	  		<p>Användaren ".$member[$this->username]."<a href='?".NavigationView::action."=".action::CHANGE_AUTHORITY  ."&membernumber=".$member[$this->UserId]."'><img class='redImage' src=".$this->FriendPicture($isFriend).">Skifta</a></p>	  		
	  		</div>
	  	";		
	  }  
	  
		  
	  public function FriendPicture($isFriend){
	  	if($isFriend){
	  		return "./img/greenCheck.png";
	  	}
	  	return "./img/redX.png";
	  } 
	  
	  public function WantToBlock(){
			if (isset($_GET[$this->membernumber])){
	 			return true;
	 		}
			return false;
	  }
	  
	  public function BlockingId(){
		return $_GET[$this->membernumber];
	  }
}