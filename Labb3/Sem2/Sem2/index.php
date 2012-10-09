<?php
require_once('Validation.php');
$v = new Validation();

if($v->test() == false){
 echo 'test misslyckades';
}
else{
 echo 'Test lyckades!';
}
?>
