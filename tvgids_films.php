<?php
error_reporting(E_ERROR | E_PARSE);

//only show movies that start between : 
$start = 1950 ; 
$stop = 2050 ; 

//read initial page
$page = file_get_contents ( "http://tvgids.mobi/genre-film-vandaag.html") ; 
//set the initial start and end points
$from_needle = strpos($page,'<div id="programma-1">'); 
$to_needle = strpos($page,'</table><div class="menu_n"',$from_needle)  ; 

//echo $from_needle." ".$to_needle."<br>" ; 
//calculate the total lenght of the needed data
$leng = ($to_needle + strlen($to_needle) ) - $from_needle ;

//echo $length."<br>" ;
//strip the rest 
$new_page = substr($page, $from_needle, $leng + 3 ) ; 
//create nee page 
$new_page = "<table>".$new_page ; 
//echo $new_page ; 

$num = substr_count($new_page,'<div class="programma" style="clear:both; padding-bottom:2px;">' ) ;
$alt = substr_count($new_page,'alt=' ) ;

//echo $alt . " channels<br>" ; 

$t_zender = $t_film = $t_tijd = $t_sub =  0 ;

$data = array () ; 

for($i=1;$i<=$num;$i++){
//	echo $i ." " ; //.$t_zender . " | " ; 
	
	$sub1 = strpos($new_page, '<a style="border:none; background:none;"', $t_sub)  ; 
	$sub2 = strpos($new_page, 'td valign="top" style=" width', $sub1) ; // + strlen('<a style="border:none; background:none;"')) ; 
	$sub_page = substr($new_page, $sub1 , $sub2 - $sub1 ) ; 
	$t_sub  =  $sub1 + strlen('<a style="border:none; background:none;"') ;  
//	echo $sub1."-".$sub2 ."<br>" ;  
	
	$tmp_z1 = strpos($new_page, '<img style="padding:2px 2px 0px 2px;" height="36" width="36" alt="',$t_zender) + strlen('<img style="padding:2px 2px 0px 2px;" height="36" width="36" alt="') ; 
	$tmp_z2 = strpos($new_page, '" src="http',$tmp_z1) ; 
	$zender = substr($new_page, $tmp_z1 , $tmp_z2  - $tmp_z1 ) ;
	$t_zender = $tmp_z1 ;
	
	$tmp_t1 = strpos($new_page, '<span style="color:#E30000;" id="tijd">',$t_tijd) + strlen('<span style="color:#E30000;" id="tijd">') ; 
	$tmp_t2 = strpos($new_page, '</span>',$tmp_t1) ; 
	$tijd = substr($new_page, $tmp_t1 , $tmp_t2  - $tmp_t1 ) ;
	$t_tijd = $tmp_t1 ;


	$tmp_f1 =  strpos($new_page, 'href="http://tvgids.mobi/',$t_tijd) + strlen('href="http://tvgids.mobi/') ; 
	$tmp_f2 = strpos($new_page, '</a></h4>',$tmp_f1) ; 
	$film = substr($new_page, $tmp_f1 , $tmp_f2  - $tmp_f1 ) ;
	$film = substr($film, strpos($film,'>')+1 ) ; 
	$t_film = $tmp_f1 ;

// 	echo strpos($new_page, '"-vandaag.html"',$t_film)  ;
	
// "kjhfklfjdljskfjsld".$new_page ; 

// echo  	$t_sub."-".$tijd."|".$zender."|".$film."<br>" ;
//echo  	$tijd."|".$film."<br>" ;
 	
	$tmp_tijd = str_ireplace(":","",$tijd)*1; 
	if(($tmp_tijd>$start)&&($tmp_tijd<$stop)){
		$data[] = $film ; 
	}
	
		
}

echo '{"film":'.json_encode($data)."}" ; 


?>