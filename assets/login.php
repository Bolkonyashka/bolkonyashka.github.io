<?php
require('pass.php');
$json_str = file_get_contents('php://input');
$rdata = json_decode($json_str, true);
$pass = $rdata["password"];
$user = $rdata["username"];
$conn = new mysqli("localhost", "root", "", "users");
//$hp = password_hash($pass, PASSWORD_BCRYPT);
//$query_str="UPDATE `users`.`admins` SET `pass` = '$hp' WHERE `id` = 1";
//$result = $conn->query($query_str);
//$hk = base64_encode("mysecretkey");
//$query_str="INSERT INTO `keys`.`skeys`(`id`, `skey`) VALUES (NULL, '$hk')";
//$result = $conn->query($query_str);
$result = $conn->query("SELECT * FROM admins WHERE `login` = '$user'");
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if (password_verify($pass, $rs["pass"]))
    {
        $encoded_header = base64_encode('{"alg": "HS256","typ": "JWT"}');
        $encoded_payload = base64_encode('{"name": "' . $user . '"}');
        $header_and_payload_combined = $encoded_header . '.' . $encoded_payload;
        $conn2 = new mysqli("localhost", "root", "", "keys");
        $kres = $conn2->query("SELECT * FROM skeys WHERE id=1");
        $akres = $kres->fetch_array(MYSQLI_ASSOC);
        $secret_key = base64_decode($akres['skey']);
        $signature = base64_encode(hash_hmac('sha256', $header_and_payload_combined, $secret_key, true));
        $jwt_token = $header_and_payload_combined . '.' . $signature;

        $tokenObj->token = $jwt_token;
        $tokenObj->username = $user;
        echo json_encode($tokenObj);
    }
}
?>