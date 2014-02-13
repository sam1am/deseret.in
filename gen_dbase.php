<?php

ini_set("display_errors","2");
ini_set('auto_detect_line_endings', true);
ini_set('memory_limit', '128M');
ERROR_REPORTING(E_ALL);

$myFile = "dbase/mobypron.unc";
$fh = fopen($myFile, 'r');
$a = 0;

/* Connect to the database */
die("YOU ALREADY DID THIS!");
mysql_connect("localhost", "root", "root") or die(mysql_error()); 
mysql_select_db("pron") or die(mysql_error()); 

if ($fh) {
	//while (!feof($fh) {
	while ($a<177266) {
		$theLine = fgets($fh, 256);
		$data[$a] = explode(" ", $theLine);
		$word = mysql_real_escape_string($data[$a][0]);
		$pronunciation = mysql_real_escape_string($data[$a][1]);
		$query = "INSERT INTO wordlist VALUES ('$word', '$pronunciation')";
		mysql_query($query) or die('Error, insert query failed');
		echo $data[$a][0]." *** ".$data[$a][1]."<br />";
		$a++;		
	}

	fclose($fh);
}

/*print("<pre>".print_r($data,true)."</pre>");*/

?>