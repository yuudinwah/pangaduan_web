<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/user.php";
include_once "../../../data/token.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$user = new UserModel($conn);
$token = new TokenModel($conn);

$data = json_decode(file_get_contents("php://input"));

$response = [];

if ($request == 'POST') {
    if (
        !empty($data->name)&&
        !empty($data->email)&&
        !empty($data->password)
    ) {
        $user->email = $data->email;

        $user->getEmail();
        if($user->id != null){
            http_response_code(400);
            $response = array(
                'status' =>  array(
                    'messsage' => 'Email sudah pernah terdaftar', 'code' => http_response_code()
                )
            );
        }else{
            $user = new UserModel($conn);
            $user->name = $data->name;
            $user->email = $data->email;
            $user->password = md5($data->password);
            $user->register();
            $response = array(
                'status' =>  array(
                    'messsage' => 'Success', 'code' => (http_response_code(200))
                )
            );
        }
    } else {
        http_response_code(400);
        $response = array(
            'status' =>  array(
                'messsage' => 'Authentication Failed - Wrong Parameter', 'code' => http_response_code()
            )
        );
    }
} else {
    http_response_code(405);
    $response = array(
        'status' =>  array(
            'messsage' => 'Method Not Allowed', 'code' => http_response_code()
        )
    );
}

echo json_encode($response);
