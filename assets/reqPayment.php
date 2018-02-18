<?php
$con_str=mysql_connect('localhost', 'root', '');
mysql_select_db('payments',$con_str);
$inn=$_POST["inn"];
$bik=$_POST["bik"];
$accNum = $_POST ["accNum"];
$nds = $_POST ["nds"];
$sum= $_POST ["sum"];
$phone=$_POST ["phone"];
$email= $_POST ["mail"];
$query_str="INSERT INTO `payments`.`reqpay`
(`id`, `inn`, `bik`, `accNum`, `nds`, `sum`, `phone`, `email`, `safe`) VALUES (NULL, '$inn', '$bik', '$accNum', '$nds', '$sum', '$phone', '$email', 0)";
mysql_query($query_str);
mysql_close();
?>