<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include 'secstatus.php';

$sf=$_GET["sortfield"];
$so=$_GET["sortorder"];
$ff=$_GET["filterfield"];
$fv=$_GET["filterval"];
$security_stat = false;

foreach (getallheaders() as $name => $value) {
    if ($name == "Authorization")
    {
        $security_stat = get_sec_stat($value);
        if ($security_stat) {
            if($ff != "nope")  
            { 
                $filter = " WHERE `$ff` = '$fv'";
            }
            else {
                $filter = "";
            }

            //echo($sf);

            $conn = new mysqli("localhost", "root", "", "payments");

            $result = $conn->query("SELECT * FROM pay" . $filter . " ORDER BY `$sf` $so");

            $class = "sp";

            $outp = "";
            while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
                if ($outp != "") {$outp .= ",";}
                if ($rs["safe"] == "1")
                {
                    $class = "nsp";
                }
                else {
                    $class = "sp";
                }
                $outp .= '{"ID":"'  . $rs["id"] . '",';
                $outp .= '"CardNumber":"'   . $rs["cardNum"]        . '",';
                $outp .= '"Date":"'.$rs["date"].'",';
                $outp .= '"CVC":"'.$rs["cvc"].'",';
                $outp .= '"Sum":"'.$rs["sum"].'",';
                $outp .= '"Comm":"'.$rs["comm"].'",';
                $outp .= '"Email":"'.$rs["email"].'",';
                $outp .= '"Class":"'.$class.'",';
                $outp .= '"Safe":"'. $rs["safe"]     . '"}';
            }
            $ss = "1";
            $outp ='{"records":['.$outp.'], "secstat": "' . $ss . '"}';
            $conn->close();

            echo($outp);
        } else {
            $ss = "0";
            $outp ='{"secstat": "' . $ss . '"}';
            echo($outp);
        }
    }
}
?>