<?php
class action{
	//De här siffrorna kommer att slå till när jag hämtar sidan på olika sätt. 
	const GetAvSidan = 0; //Defaultinställningen.
 	const CREATE_NEW_USER = 1; //Få formuläret för att skapa medlem. (Bör vara Bli Medlem? knappen)
	const TryToLogin = 2; //Skapa formuläret (kan vara samma som ovan beroende på om det är post eller get) Bör vara skapa medlem.	
	const UPLOAD_FILE = 3; 
	const CREATE_MESSAGE = 4;
	const CHANGE_AUTHORITY = 5;
}
