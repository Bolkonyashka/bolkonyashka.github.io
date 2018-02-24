<?php
include 'secstatus.php';

foreach (getallheaders() as $name => $value) {
    if ($name == "Authorization")
    {
        $security_stat = get_sec_stat($value);
        if ($security_stat) {
            $con_str=mysql_connect('localhost', 'root', '');
            mysql_select_db('payments',$con_str);
            $id=$_POST["id"];
            $st=$_POST["st"];
            $query_str="UPDATE `payments`.`pay` SET `safe` = '$st' WHERE `id` = '$id'";
            mysql_query($query_str);
            mysql_close();
            
            $ss = "1";
            $outp ='{"secstat": "' . $ss . '"}';
            echo($outp);
        } else {
            $ss = "0";
            $outp ='{"secstat": "' . $ss . '"}';
            echo($outp);
        }
    }
}

//$con_str=mysql_connect('localhost', 'root', '');
//mysql_select_db('payments',$con_str);
//$id=$_POST["id"];
//$st=$_POST["st"];
//$query_str="UPDATE `payments`.`pay` SET `safe` = '$st' WHERE `id` = '$id'";
//mysql_query($query_str);
//mysql_close();
?>