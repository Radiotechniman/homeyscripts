<?php
$json = file_get_contents("trash.json") ; 
$searchdate = date("d-m-Y") ; 
$output = "json" ;
 
if(isset($_GET['date'])){
	$searchdate = $_GET['date'] ;
	}
if(isset($_GET['out'])){
	$output = $_GET['out'] ;
	}
	
$json_a = json_decode($json, true);

$rest = $json_a['REST'] ;  
$gft = $json_a['GFT'] ;  
$papier = $json_a['PAPIER'] ; 
$pmd = $json_a['PMD'] ; 
$textiel = $json_a['TEXTIEL'] ; 

if(array_search($searchdate,$rest) > -1){
	echo nice("REST") ;
	}
else if(array_search($searchdate,$gft) > -1){
	echo nice("GFT") ;
	}
else if(array_search($searchdate,$papier) > -1){
	echo nice("PAPIER");
	}
else if(array_search($searchdate,$pmd) > -1){
	nice("PMD");
	}
else if(array_search($searchdate,$textiel) > -1){
	nice("TEXTIEL") ;
	}
else{
	nice("NONE") ;
}				

function nice($input){
	global $output ; 
	if($output!="json"){
		return ''.$input.','.nice2($input).'' ;
		}
	else{
		return '{"kliko":["'.$input.'","'.nice2($input).'"]}' ;
		}
	
}


function nice2($input){
	switch($input){
		case "REST":
			return "grijze";
			break;
		case "GFT":
			return "groene";
			break;	
		case "PAPIER":
			return "papier";
			break;	
		case "PMD":
			return "PMD";
			break;	
		case "TEXTIEL":
			return "textiel";
			break;
		case "NONE":
			return "geen";
			break;					
	}
	
}

?>