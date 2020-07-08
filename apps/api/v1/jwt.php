<?php
function TokenJwt($name,$user_id){
    // Create token header as a JSON string
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

    // Create token payload as a JSON string
    $startDate = time();
    $exp = date('Y-m-d H:i:s', strtotime('+365 day', $startDate));
    $payload = json_encode(["exp" => strtotime($exp), 'user_id' => $user_id, 'name' => $name]);

    // Encode Header to Base64Url String
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

    // Encode Payload to Base64Url String
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

    // Create Signature Hash
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'secret', true);

    // Encode Signature to Base64Url String
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

    // Create JWT
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

    $jwt_token = ['exp' => strtotime($exp), 'token' => $jwt];
    return $jwt_token;
}

function verifyJwt() {
    $test = ['token' => "token is required"];
    echo json_encode($test);
    exit;
}
