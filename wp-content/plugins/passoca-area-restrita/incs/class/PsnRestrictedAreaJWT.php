<?php 
class PsnRestrictedAreaJWT
{
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->senha =  'WasowM72';
        $this->iss = "localhost";
    }

    private function _createHeader() {
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];
        
        $header = json_encode($header);
        $header = base64_encode($header);

        return $header;
    }

    public function reversePayload($token) {
        $part = explode(".",$token);
        $payload = $part[1];

        $payload = base64_decode($payload);
        $payload = json_decode($payload, true);

        return $payload;
    }

    private function _createPayload($nome,$email) {
        $now = new DateTime('now');
        $now = $now->modify('+3 hours')->format('Y-m-d H:i:s');

        $payload = [
            'iss' => $this->iss,
            'name' => $nome,
            'email' => $email,
            'exp' => $now
        ];

        $payload = json_encode($payload);
        $payload = base64_encode($payload);

        return $payload;
    }

    private function _createSignature($header,$payload) {
        $signature = hash_hmac('sha256',"$header.$payload",$this->senha,true);
        $signature = base64_encode($signature);
        return $signature;
    }

    public function createToken($nome,$email) {
        // HEADER
        $header = $this->_createHeader();
        // PAYLOAD
        $payload = $this->_createPayload($nome,$email);
        // SIGNATURE
        $signature = $this->_createSignature($header,$payload);

        $now = new DateTime('now');
        $now = $now->modify('+3 hours')->format('Y-m-d H:i:s');

        $return = array('token' => "$header.$payload.$signature" , 'exp' => $now );

        return $return;
    }

    public function validateToken($token,$time=true) {
        $part = explode(".",$token);
        $header = $part[0];
        $payload = $part[1];
        $signature = $part[2];


        $payloadReverse = $this->reversePayload($token);

        $valid = hash_hmac('sha256',"$header.$payload",$this->senha,true);
        $valid = base64_encode($valid);

        $dateNow = new DateTime('now');

        if(!$time){
            $dateExp = new DateTime('now');
            $dateExp = $dateExp->modify('+3 hours');
        }else {
            $dateExp = new DateTime($payloadReverse['exp']);
        }


        // $dateExp = new DateTime($payloadReverse['exp']);


        if($signature == $valid && $dateNow <= $dateExp ){
            $return = array(
                'stats' => 1,
                'validade' => $dateExp,
                'login' => $payloadReverse['email'],
                'message' => 'Token Válido'
            );
        } else{
            $return = array(
                'stats' => 0,
                'validade' => $dateExp,
                'atual' => $dateNow,
                'message' => 'Token Invalido',
            );
        }

        return $return;
    }

}
?>