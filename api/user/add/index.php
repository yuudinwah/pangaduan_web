<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/user.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$user = new UserModel($conn);

$data = json_decode(file_get_contents("php://input"));

$response = [];

if ($request == 'POST') {
    if (
        !empty($data->name) &&
        !empty($data->email) &&
        !empty($data->password)
    ) {
        $user->id = $data->id;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->username = $data->username;
        $user->password = $data->password;
        $user->handphone = $data->handphone;
        $user->status = $data->status;

        $data = array(
            'id' => $user->id,
            'name' => $user->name,
            'email'=>$user->email,
            'username'=>$user->username,
            'password'=>md5($user->password),   
            'handphone'=>$user->handphone,
            'status'=>$user->status,
        );

        if ($user->add()) {
            $response = array(
                'status' =>  array(
                    'message' => 'Success', 'code' => (http_response_code(200))
                ), 'data' => $data
            );
        } else {
            http_response_code(400);
            $response = array(
                'message' => 'Add Failed',
                'code' => http_response_code()
            );
        }
    } else {
        http_response_code(400);
        $response = array(
            'status' =>  array(
                'message' => 'Add Failed - Wrong Parameter', 'code' => http_response_code()
            )
        );
    }
} else {
    http_response_code(405);
    $response = array(
        'status' =>  array(
            'message' => 'Method Not Allowed', 'code' => http_response_code()
        )
    );
}

echo json_encode($response);
