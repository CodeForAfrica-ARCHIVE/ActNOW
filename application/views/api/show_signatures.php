<?php
header("Content-type: text/xml");
$total = 0;

$Result = "<?xml version='1.0' encoding='utf-8'?>\n<signatures>\n";

foreach($signatures as $signature){
	if($signature['name']!=''){
	$person = $signature['name'];
}else if($signature['email']!=''){
	$person = $signature['email'];	
}else{
	$person = $signature['number'];
}
	if($total<20){
	$Result .= " <signature>\n";	
	$Result .= "<id>".$signature['id']."</id>";	
	$Result .= "<title>".$person."</title>";
	$Result .= "<description>".$signature['message']."</description>";
	$Result .= "<timestamp>".$signature['timestamp']."</timestamp>";
	$Result .= "<thumb_url>".base_url()."assets/uploads/user.png</thumb_url>";
	$Result .= " </signature>\n";
		}
	$total++;
}
$Result .= "</signatures>\n"; 
echo $Result;
?>