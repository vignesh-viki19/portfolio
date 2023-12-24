<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

$data = json_decode(file_get_contents("php://input"));

 $name = !empty($data->name)?$data->name:'';
 $email = !empty($data->email)?$data->email:'';
 $comment = !empty($data->comment)?$data->comment:'';


// $name = !empty($_POST['name'])?$_POST['name']:'';
// $email = !empty($_POST['email'])?$_POST['email']:'';
// $comment = !empty($_POST['comment'])?$_POST['comment']:'';
// echo $name;

$account_sid = "AC8545625b46a1ee14e8ed4890271ab95d";
$auth_token = "f87aa127ef32f1c345d08f9268566126";

// A Twilio number you own with SMS capabilities
$twilio_number = "+1 928 451 7128";
$client = new Client($account_sid, $auth_token);

try {
    // Attempt to send the message
    $message = $client->messages->create(
        // Where to send a text message (your cell phone?)
        '+918667712788',
        array(
            'from' => $twilio_number,
            'body' => $name . '-' . $email . '-' . $comment
        )
    );

    // Check if the message was sent successfully
    if ($message) {
        // Construct a success response
        $response = array(
            'status' => 'success',
            'message' => "sid",
            'status_code' =>"200"
            // You can include more information as needed from the $message object
        );
    } else {
        // If message sending failed
        $response = array(
            'status' => 'error',
            'message' => 'Failed to send the message.',
            'status_code' =>"400"
        );
    }
} catch (Exception $e) {
    // If an exception occurred while sending the message
    $response = array(
        'status' => 'error',
        'message' => $e->getMessage(), // Include the exception message for debugging
        'status_code' =>"500"
    );
}

// Return the response as JSON
echo json_encode($response);
exit;


// $res = array("status"=>"200");
// // header("Location: index.html");
// echo json_encode($res);
