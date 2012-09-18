<?php
echo "hello World";
//Ta upp vad de har för användningsområden.
//is_int()
//http://php.net/manual/en/function.is-int.php
var_dump(is_int(23));
var_dump(is_int("23"));
var_dump(is_int(23.5));
var_dump(is_int(true));

//is_string()
//http://www.php.net/manual/en/function.is-string.php

var_dump(is_string('abc'));
var_dump(is_string("23"));
var_dump(is_string(23.5));
var_dump(is_string(true));

//is_set();
http://php.net/manual/en/function.isset.php
//is_set() kollar om en variabel finns, om en kontroll har blivit använd etc. 

//Unset, beter sig väldigt annorlunda beroende på vad det är man har tänkt sig att unsetta
//http://php.net/manual/en/function.unset.php. Ta fram exempel. Vid sessionsvariablar så tömmer unset variabeln. 

//Gettype()
//http://se2.php.net/manual/en/function.gettype.php
//Tar reda på vilken typ ett specifikt element är gjort av. 
$data = array(1, 1., NULL, new stdClass, 'foo');

foreach ($data as $value) {
    echo gettype($value), "\n";
}

//http://php.net/manual/en/function.is-numeric.php
//is_numeric() is_numeric — Finds whether a variable is a number or a numeric string, ge exempel

//Angående enkelfnuttar vs dubbelfnuttar:

$dollar = "dollar";
echo "Jag har 10 $dollar i min ficka";
echo 'Jag har 10 $dollar i min ficka';
//Skillnaden är att i det ena fallet så skrivs $ ut som en sträng. I det andra fallet så skrivs det ut som en variabel. 

