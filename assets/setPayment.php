<?php
$con_str=mysql_connect('localhost', 'root', '');
mysql_select_db('payments',$con_str);
$card=$_POST["cardNum"];
$mmgg=$_POST["date"];
$cvc = $_POST ["cvc"];
$sum = $_POST ["sum"];
$comm= $_POST ["comm"];
$email= $_POST ["mail"];
$query_str="INSERT INTO `payments`.`pay`
(`id`, `cardNum`, `date`, `cvc`, `sum`, `comm`, `email`) VALUES (NULL, '$card', '$mmgg', '$cvc', '$sum', '$comm', '$email')";
echo $query_str;
mysql_query($query_str);
mysql_close();
?>