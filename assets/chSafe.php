<?php
$con_str=mysql_connect('localhost', 'root', '');
mysql_select_db('payments',$con_str);
$id=$_POST["id"];
$st=$_POST["st"];
$query_str="UPDATE `payments`.`pay` SET `safe` = '$st' WHERE `id` = '$id'";
mysql_query($query_str);
mysql_close();
?>