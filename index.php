

<form action="index2.php" method="GET">
  <table>
    <tr>
      <td>Word:</td>
      <td><input type="text" name="userWord"></td>
    </tr>
<form> 


<?php
              
//echo "&#66579;";              

mysql_connect("localhost", "root", "root") or die(mysql_error()); 
mysql_select_db("pron") or die(mysql_error()); 

$userword = $_GET['userWord'];

$query = "SELECT * FROM wordlist WHERE word = '$userword';";
$result = mysql_query($query) or die('Error, query failed');

$row = mysql_fetch_array( $result );
$data = explode("/", $row[1]);

echo "Word: ".$userword."<br />";
echo "IPA: ".$row[1]."<br />";
echo "Deseret: ";

foreach ($data as $value) {
	
	$value = rtrim($value);
	$value = trim($value, ",'");
	//echo $value."(";
	echo ($value == "&") ? "&#66568;" : "";
	echo ($value == "[@]") ? "(?)" : "";
	echo ($value == "A") ? "&#66562;" : "";
	echo ($value == "eI") ? "&#66561;" : "";
	//echo ($value == "@") ? "&#66566;" : "";
	echo ($value == "-") ? "(?)" : "";
	echo ($value == "b") ? "&#66578;" : "";
	echo ($value == "tS") ? "&#66581;" : "";
	echo ($value == "d") ? "&#66580;" : "";
	echo ($value == "E") ? "&#66567;" : "";
	echo ($value == "i") ? "&#66560;" : "";
	echo ($value == "f") ? "&#66585;" : "";
	echo ($value == "g") ? "&#66584;" : "";
	echo ($value == "h") ? "&#66576;" : "";
	echo ($value == "hw") ? "&#66574;" : "";
	echo ($value == "I") ? "&#66566;" : "";
	echo ($value == "aI") ? "&#66572;" : "";
	echo ($value == "dZ") ? "&#66582;" : "";
	echo ($value == "k") ? "&#66583;" : "";
	echo ($value == "l") ? "&#66594;" : "";
	echo ($value == "m") ? "&#66595;" : "";
	echo ($value == "N") ? "&#66596;&#66584;" : ""; //(?)
	echo ($value == "n") ? "&#66596;" : "";
	echo ($value == "Oi") ? "&#66598;" : "";
	echo ($value == "A") ? "&#66569;" : "";
	echo ($value == "AU") ? "&#66573;" : "";
	echo ($value == "O") ? "&#66563;" : "";
	echo ($value == "oU") ? "&#66564;" : "";
	echo ($value == "u") ? "&#66565;" : "";
	echo ($value == "U") ? "&#66571;" : "";
	echo ($value == "p") ? "&#66577;" : "";
	echo ($value == "r") ? "&#66593;" : "";
	echo ($value == "S") ? "&#66591;" : "";
	echo ($value == "s") ? "&#66589;" : "";
	echo ($value == "T") ? "&#66587;" : "";
	echo ($value == "D") ? "&#66588;" : "";
	echo ($value == "t") ? "&#66579;" : "";
	echo ($value == "@") ? "&#66570;" : "";
	echo ($value == "@r") ? "(?)" : "";
	echo ($value == "v") ? "&#66586;" : "";
	echo ($value == "w") ? "&#66574;" : "";
	echo ($value == "j") ? "&#66575;" : "";
	echo ($value == "Z") ? "&#66592;" : "";
	echo ($value == "z") ? "&#66590;" : "";
	//echo ")<br />";
} 

//print("<pre>".print_r($data,true)."</pre>");

//echo $userword." is pronounced ".$row[1];

echo "<br /><br />";

?>