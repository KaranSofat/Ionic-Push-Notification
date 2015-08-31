<!--<?php
$msg = 'dasdasd';
$user = 'dasdasd';

$device_token="APA91bHigOZ7Znbzb-C1pzv4Xj5b48ectvoVLoy9CwLGmotMvjQUsMpImbJc957_B551w0EKjWPKsdLU0ZUwJuMYRmJTXYjFXN8mptzcouNu34_1pC3c2_Gc3hlCkROms7TDXbxh8lXUb3n3lKjq1co5PKgbB9eUBA";
$url = 'https://push.ionic.io/api/v1/push';

$data = array(
                  'tokens' => array($device_token), 
                  'notification' => array('alert' => ''.$user.': '.$msg),      
                  );
      
$content = json_encode($data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
curl_setopt($ch, CURLOPT_USERPWD, "b531f59325549afc443bebdb95a15e8821e75a0e45c01409" . ":" );  
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'X-Ionic-Application-Id: 3f78d153' 
));
$result = curl_exec($ch);
curl_close($ch);

?>-->
<?php

//enable it

//$deviceType = 'ios';

$deviceType = 'android';

//operation begin

if($deviceType == 'ios'){

echo $deviceType;

$deviceToken = 'APA91bHigOZ7Znbzb-C1pzv4Xj5b48ectvoVLoy9CwLGmotMvjQUsMpImbJc957_B551w0EKjWPKsdLU0ZUwJuMYRmJTXYjFXN8mptzcouNu34_1pC3c2_Gc3hlCkROms7TDXbxh8lXUb3n3lKjq1co5PKgbB9eUBA';

// Put your device token here (without spaces):

// Put your private key's passphrase here:

$passphrase = '1e8d805809f47c477f72bc299a3685980611f92c443c6fe8';

// Put your alert message here:

$message = 'Technovault is awesome!!!';

////////////////////////////////////////////////////////////////////////////////

$ctx = stream_context_create();

stream_context_set_option($ctx, 'ssl', 'local_cert', 'ck.pem');

stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

// Open a connection to the APNS server

$fp = stream_socket_client(

    'ssl://gateway.sandbox.push.apple.com:2195', $err,

    $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

if (!$fp)

    exit("Failed to connect: $err $errstr" . PHP_EOL);

echo 'Connected to APNS' . PHP_EOL;

// Create the payload body

$body['aps'] = array(

    'alert' => $message,

    'sound' => 'default',

    'badge' => 1

    );

// Encode the payload as JSON

$payload = json_encode($body);

// Build the binary notification

$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server

$result = fwrite($fp, $msg, strlen($msg));

if (!$result)

    echo 'Message not delivered' . PHP_EOL;

else

    echo 'Message successfully delivered' . PHP_EOL;

// Close the connection to the server

fclose($fp);

}

else if($deviceType == 'android'){

echo $deviceType;

$deviceToken = 'APA91bHKwBKrIjmmZ9lke97fl_GbOQ9iRRo-S2sNnZp085hPqVaTHMOd0wqhYFF1PtrtOzFrETX7ZNIkU0JDhC49Tby_AEFIQFRX99B0QpZd7xdiTqsP6sZ08P-8ESdJAie5AJNxhW89nQ7S9evZNcAc9tsJaG91Xw';

$registrationIds = explode(",",$deviceToken);

//$registrationIds = array($deviceToken);

// prep the bundle

$msg = array

(

    'notId' => time(),

    'message'       => 'Technovault is awesome!!!',

    'title'         => 'Title',

    'smallIcon'     =>'icon',
    'path'          =>'www.google.com'

   

);

$fields = array

(

    'registration_ids'  => $registrationIds,

    'data'              => $msg
    

);

$headers = array

(

    'Authorization: key=' . 'AIzaSyAs8MhEmpfxp3msHNNk32KcMvPn_HRuWiA',

    'Content-Type: application/json'

);

$ch = curl_init();

curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );

curl_setopt( $ch,CURLOPT_POST, true );

curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );

curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );

curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );

curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );

$result = curl_exec($ch );

curl_close( $ch );

echo $result;

}

else {

    echo "Error";

}
