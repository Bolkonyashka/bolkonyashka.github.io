<?php
  function get_sec_stat($value) {
    $hvalues = explode(' ', $value);
    $recieved_jwt = $hvalues[1];
    $conn2 = new mysqli("localhost", "root", "", "keys");
    $kres = $conn2->query("SELECT * FROM skeys WHERE id=1");
    $akres = $kres->fetch_array(MYSQLI_ASSOC);
    $secret_key = base64_decode($akres['skey']);
    
    $jwt_values = explode('.', $recieved_jwt);
    
    $recieved_signature = $jwt_values[2];
    $recieved_header_and_payload = $jwt_values[0] . '.' . $jwt_values[1];
    
    $what_signature_should_be = base64_encode(hash_hmac('sha256', $recieved_header_and_payload, $secret_key, true));
    
    if($what_signature_should_be == $recieved_signature) {
        return true;
    } else {
        return false;
    }
  }
?>