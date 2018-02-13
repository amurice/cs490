<?php
	$ucid=$_POST['ucid'];
	$pass=$_POST['pwd'];
	//$crl = curl_init();
	$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest"));
$result = curl_exec ($ch);
curl_close ($ch); 
	
	
	//curl_setopt($crl, CURLOPT_URL, "MIDDLE END PHP");
	//curl_setopt($crl, CURLOPT_POST, 1);
	//curl_setopt($crl, CURLOPT_POSTFIELDS, "ucid=$ucid&pwd=$pass");
	//curl_setopt($crl, CURLOPT_FOLLOWLOCATION, 1);
    
	 if ($ucid !== false && $pass !== false)
     echo "UCID IS NOT EMPTY";
 else if ($ucid !==
     echo "UCID AND PASS IS EMPTY CHECK THEM";
	//$c = curl_exec($crl);
	
	curl_close($crl); 
?>
