<!DOCTYPE html>  
<html lang="en">  
<head>  
<meta charset="utf-8" />  
<title>Deseret Alphabet Translator</title>  
  
<link rel="stylesheet" href="style.css" type="text/css" />  

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-17722321-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>  
  
<body id="index" class="home">  

<h1>Deseret Alphabet Translator (BETA)</h1>
<h2>𐐔𐐇𐐝𐐍𐐡𐐇𐐓 𐐈𐐢𐐙𐐆𐐒𐐇𐐓 𐐓𐐡𐐈𐐤𐐝𐐢𐐁𐐓𐐆𐐡 (𐐒𐐁𐐓𐐆)</h2>

<p>Type a word or phrase below.</p>

<div class="input">
	<form action="index.php" method="GET">
  		<table>
    		<tr>
      			<td>Enter Text:</td>
      			<td><input type="text" name="input" size="50"></td>
      			<td><input type="submit" value="Submit" /></td>
    		</tr>
    	</table>
	</form> 
</div>

<div class="result">

<?php

include 'funcs.php';

//Set up variables
$userInput = $_GET['input'];
$englishSentence = explode(" ", $userInput);
$ipaSentence = array();
$deseretSentence = array();

//Die if the string is too long
if (strlen($userInput) > 140) {
	die("Take it easy! I can only take so much at once!");
}

//Loop through each word
foreach ($englishSentence as $userWord) {

	//Get the IPA translation and add to sentence array
	$ipaWord = getIPA($userWord);
	if (empty($ipaWord[1])) {
		
		$ipaWord = checkPlural($userWord);
		if (empty($ipaWord[1])) {		
			array_push($ipaSentence, array("?",$userWord));
		} else {
			array_push($ipaSentence, $ipaWord);
		}
	} else {
		array_push($ipaSentence, $ipaWord);
	}

	//Get the Deseret translation - add to sentence array
	if (empty($ipaWord[1])) {
		array_push($deseretSentence, array($userWord));
	} else {
		$deseretWord = getDeseret($ipaWord);
		array_push($deseretSentence, $deseretWord);
	}
	

}

//echo out results

if ($userInput) {

echo "<br />Input: ".$userInput." (";

echo "<em>";
foreach ($ipaSentence as $ipaWord) {
	foreach ($ipaWord as $ipaCharacter) {
		if ($ipaCharacter) {
			echo $ipaCharacter."/";
		}
	}	
	echo " ";
}

echo ")</em><br />Deseret: <h2>";

foreach ($deseretSentence as $deseretWord) {
	
	foreach ($deseretWord as $deseretCharacter) {
		echo $deseretCharacter;
	}
	echo " ";
	
}

echo "</h2>";
}

?>
</div>
<br />
<!-- Place this tag where you want the +1 button to render -->
<g:plusone></g:plusone>

<!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=290864004259921";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like" data-href="http://deseret.in" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false"></div>

<div id="foot">
	<p>If a word's pronunciation cannot be found, the system will attempt to translate it by letter instead of sound. It will do so poorly.</p>
	<p>Words that cannot be translated will appear in the standard english alphabet.</p>
	<p><a href="http://google.com/profiles/samgarfield">CONTACT ME</a></p>
	<p>This project is available on <a href="https://github.com/sam1am/deseret.in">github</a> and is licensed under <a href="http://www.gnu.org/licenses/gpl-3.0.html">GPL3</a>.
</div>

</body>
</html>