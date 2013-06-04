<?php
header("Content-type: text/xml");
$total = 0;
$Result = "<?xml version='1.0' encoding='utf-8'?>\n<petitions>\n";

foreach($petitions as $petition){
	if($total<20){
	$Result .= " <petition>\n";	
	$Result .= "<id>".$petition['id']."</id>";	
	$Result .= "<title>".$petition['name']."</title>";
	$Result .= "<description>".$petition['description']."</description>";
	$Result .= "<signatures>".$petition['signatures']."</signatures>";
	$Result .= "<category>".$petition['cat_name']."</category>";

		 $Result .= " </petition>\n";
		}
	$total++;
}
$Result .= "</petitions>\n"; 
echo $Result;
?>