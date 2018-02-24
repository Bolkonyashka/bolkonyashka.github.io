<?php
    include 'secstatus.php';

    $tok=$_GET["tok"];
    //$userObj->tok = $tok;
    $security_stat = get_sec_stat('pam '.$tok);
    if ($security_stat) {
        $securstatus = "1";
    } else {
        $securstatus = "0";
    }
    echo ($securstatus);
?>