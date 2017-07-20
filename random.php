<?php
$num = explode(",", $_GET['nums']) ;
echo rand($num[0],$num[1]);
?>
