<?php
$func="" ; 
$num="0,9" ;

if(isset($_GET['o'])){
	$out=$_GET['o'] ;
	}	
else{
	$out="json";
	}
if(isset($_GET['f'])){		
	$func=$_GET['f'] ; 
}
if(isset($_GET['p'])){
	$num=$_GET['p'] ; 
}


switch($func){
	case "random":
		random($num);
	break;
	case "substring":
		substring($num);
	break;	
	case "explode":
		explode_($num);
	break;

	
	case "":
		echo "Error no function requested" ; 
	break;
		
}

function explode_($num){
	global $out ; 
	$tmp = "" ; 
	$num = explode(",", $num) ;
	$delimiter = $num[0] ;
	$string = $num[1] ;
	$result = explode($delimiter,$string);
		
 if($out=="txt"){
 	echo $result ; 	
 	}
 else{
 	echo '{"explode": [' ; 
 	
 	for($i=0;$i<count($result);$i++){
		$tmp .= '"'.$result[$i].'",' ;
	}
	
	$tmp = rtrim($tmp,",");
	
			
 	echo $tmp.']}' ;  
 	
 	
 	}	
}

function substring($num){
	global $out ; 
	$num = explode(",", $num) ;
	$result = substr($num[0],$num[1],$num[2]);
		
 if($out=="txt"){
 	echo $result ; 	
 	}
 else{
 	
 	echo '{"substring":"'.$result.'"}' ;  	
 	}	
}


function random($num){
	global $out ; 
	$num = explode(",", $num) ;
	$result = rand($num[0],$num[1]);
		
 if($out=="txt"){
 	echo $result ; 	
 	}
 else{
 	echo '{"random":"'.$result.'"}' ;  	
 	}	
 	
}




?>
