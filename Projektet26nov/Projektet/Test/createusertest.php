<?php
require_once("memberhandler.php");


//private $m_mysqli;


$this->m_mysqli = new mysqli("localhost", "root", "krokodil", "member"); 	 
$this->m_mysqli->set_charset("utf8");      	        

$mh = new memberhandler();
$result = $mh->NewInsert("somedude", "");
var_dump($result);


/*
//Selectrad som tittar p� antalet rader innan ins�ttning. Med echo
echo"F�r f� tecken i l�senordet";
$mh->NewInsert("someone", "");
//Selectrad som tittar p� antalet rader innan ins�ttning. Med echo
echo"b�r vara lika m�nga rader som ovan";

echo"<h1>F�r f� tecken i anv�ndarnamnet</h1>";
$mh->NewInsert("one", "onepass");
//Selectrad som tittar p� antalet rader innan ins�ttning. Med echo
echo"b�r vara lika m�nga rader som ovan";

echo"<h1>Tv� olika l�senord</h1>";
$mh->NewInsert("onepiss", "onepass");
//Selectrad som tittar p� antalet rader innan ins�ttning. Med echo
echo"b�r vara lika m�nga rader som ovan";

echo"<h1>Testar elak kod 1</h1>";
	$lh->NewDoLogin("<script>", "...");
	//Echo. B�r kasta undantag
	
	echo"<h1>Testar elak kod 2</h1>";
	$lh->NewDoLogin("onmouseevent...", "...");
	//Echo. B�r kasta undantag

echo"Testar att s�tta in en medlem"
$mh->NewInsert("someone", "someonetest");

//Selectrad som tittar p� antalet rader efter ins�ttning. Med echo.
echo"Ska vara en rad mer en innan."

echo"<h1>Testar att s�tta in en likadan medlem</h1>";
$mh->NewInsert("someone", "someonetest");

//Selectrad som tittar p� antalet rader efter ins�ttning. Med echo.
echo"Ska vara lika m�nga rader som innan."


echo"<h1>Testar att ta bort medlem</h1>";
$members2 = "someone";
            $sql = "DELETE FROM ". $members2 . " WHERE username = ?"; 
            
            $stmt = $this->m_mysqli->prepare($sql); 
            
            if ($stmt === FALSE) {
                    return false;
            }
			
            if ($stmt->bind_param("s", $name) === FALSE) {
                    $stmt->close();
                    return false;
      		}
            
            if (!$stmt->execute()) {
                        $stmt->close();
                        return false;
             }
            
            $stmt->close();
//Selectrad som tittar p� antalet rader efter ins�ttning. Med echo.
echo"Ska vara en rad f�rre �n innan."
 * 
 */



