<?php

function getIPA($englishWord) {
	
	$badchars = array("'",",",".");
	$englishWord = str_replace($badchars, "", $englishWord);
	
	mysql_connect("localhost", "dbname", "password") or die(mysql_error()); 
	mysql_select_db("deseret") or die(mysql_error()); 

	$query = "SELECT * FROM wordlist WHERE word = '$englishWord';";
	$result = mysql_query($query) or die('Error, query failed');

	$row = mysql_fetch_array( $result );
	$data = explode("/", $row[1]);
	
	return $data;
	
}

function getDeseret($ipaWord) {
	
	$deseretWord = array();
	
	$match = "/^[b-df-hj-np-tv-xz]{2,3}$/";
	foreach ($ipaWord as $value) {
	
		$value = rtrim($value);
		$badchars = array("'",",");
		$value = str_replace($badchars, "", $value);
	
		$sql = 'SELECT * FROM `key` WHERE BINARY ipa = "'.$value.'"';
		$found = mysql_query($sql) or die ('error - 33 on value: ' . $value . '<br />');
	
		if (mysql_num_rows($found)>0) { //if we have a result from the db
			$chars = mysql_fetch_array ( $found );
			
			//echo "&#".$chars[1].";";
			array_push($deseretWord, "&#".$chars[1].";");
			
		} else if (preg_match ($match, $value)) { //no db result - consonant cluster
			$b = 0;
			while ($b<strlen($value)) {
				$singlechar = substr($value, $b, 1);		
				$sql = 'SELECT * FROM `key` WHERE BINARY ipa = "'.$singlechar.'"';
				$found = mysql_query($sql) or die ('error - 46');
				$chars = mysql_fetch_array ( $found );
				if ($chars[1] != "") {
					
					//echo "&#".$chars[1].";";
					array_push($deseretWord, "&#".$chars[1].";");
				}
				$b++;
			}	
		} else if (strlen($value) > 0) {
			
			//echo "(? - ".$value.")";
			array_push($deseretWord, "(? - ".$value.")");
			
		}
		
	}
	
	return $deseretWord;
	
}

function checkPlural($englishWord) {
	
	$lastThree = substr($englishWord, -3, 3);
	$lastTwo = substr($englishWord, -2, 2);
	$lastOne = substr($englishWord, -1, 1);
	
	//echo $lastThree;
		
	if ($lastThree == "ies") {
		$englishWord = substr($englishWord, 0, -3);
		$englishWord = $englishWord."y";
		$addIn = "z";
	} elseif ($lastTwo == "es") {
		$englishWord = substr($englishWord, 0, -2);
		$addIn = "E"; 
		$addIn2 = "s"; //lazy!
	} elseif ($lastOne == "s") {
		$englishWord = substr($englishWord, 0, -1);
		$addIn = "s";
	}
	//echo $lastThree."<br />";
	//echo $englishWord;
	//echo "<br />".$addIn;
	
	mysql_connect("localhost", "dbname", "password") or die(mysql_error()); 
		mysql_select_db("samgarfi_deseret") or die(mysql_error()); 
	$query = "SELECT * FROM wordlist WHERE word = '$englishWord';";
	
	$result = mysql_query($query) or die('Error, query failed');
	$row = mysql_fetch_array( $result );
		
	if (isset($row[1])) {
			
		$data = explode("/", $row[1]);
		
		array_push ($data, $addIn, $addIn2);
	
		return $data;
	}
	
	// return something

}

?>
