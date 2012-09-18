<?php

//I versaler
for ($i = 0; $i < 26; $i++) {
 echo " " . chr($i + 65);
}

echo "<br/>";
//Och  i gemener

$letters = array();
for ($i = 0; $i < 26; $i++) {
 $letters[] = chr($i + 97);
}
echo implode(' ', $letters);