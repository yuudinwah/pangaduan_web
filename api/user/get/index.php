<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/user.php";
include_once "../../../data/token.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$user = new UserModel($conn);

$user->id = isset($_GET['id']) ? $_GET['id'] : die();
$user->get();

$response = [];

if ($request == 'GET') {
    if ($user->id != null) {
        $data = array(
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "username" => $user->username,
            "password" => $user->password,
            "handphone" => $user->handphone,
            "status" => $user->status,
            "createdAt" => $user->createdAt,
            "updatedAt" => $user->updatedAt,
        );
        $response = array(
            'status' => array(
                'message' => 'Success',
                'code' => (http_response_code(200))
            ),
            'data' => $data
        );
    } else {
        http_response_code(404);
        $response = array(
            'status' => array(
                'message' => 'No Data Found',
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