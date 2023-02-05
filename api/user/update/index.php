<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/user.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$user = new UserModel($conn);

$data = json_decode(file_get_contents("php://input"));

$user->id = $data->id;

$response = [];

if ($request == 'PUT') {
    if (
        !empty($data->id) &&
        !empty($data->name) &&
        !empty($data->email) &&
        !empty($data->username) &&
        !empty($data->password) &&
        !empty($data->handphone) &&
        !empty($data->status)
    ) {
        $user->id = $data->id;
        $user->name = $data->name;
        $user->email = $data->email;
        $user->username = $data->username;
        $user->password = md5($data->password);
        $user->handphone = $data->handphone;
        $user->status = $data->status;

        $data = array(
            'id'=>$user->id,
            'name'=>$user->name,
            'email'=>$user->email,
            'username'=>$user->username,
            'password'=>$user->password,
            'handphone'=>$user->handphone,
            'status'=>$user->status,
        );

        if ($user->update()) {
            $response = array(
                'status' => array(
                    'message' => 'Success',
                    'code' => (http_response_code(200))
                ),
                'data' => $data
            );
        } else {
            http_response_code(400);
            $response = array(
                'message' => 'Update Failed',
                'code' => http_response_code()
            );
        }
    } else {
        http_response_code(400);
        $response = array(
            'status' => array(
                'message' => 'Update Failed - Wrong Parameter',
                'code' => http_response_code()
            )
        );
    }
} else {
    http_response_code(405);
    $response = array(
        'status' => array(
            'message' => 'Method Not Allowed',
            'code' => http_response_code()
        )
    );
}

echo json_encode($response);