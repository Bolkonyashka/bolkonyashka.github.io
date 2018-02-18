<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$conn = new mysqli("localhost", "root", "", "payments");

$result = $conn->query("SELECT * FROM pay");

$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"ID":"'  . $rs["id"] . '",';
    $outp .= '"CardNumber":"'   . $rs["cardNum"]        . '",';
    $outp .= '"Date":"'.$rs["date"].'",';
    $outp .= '"CVC":"'.$rs["cvc"].'",';
    $outp .= '"Sum":"'.$rs["sum"].'",';
    $outp .= '"Comm":"'.$rs["comm"].'",';
    $outp .= '"Email":"'.$rs["email"].'",';
    $outp .= '"Safe":"'. $rs["safe"]     . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);
?>