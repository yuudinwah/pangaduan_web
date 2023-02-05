<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/user.php";
include_once "../../../data/token.php";
include_once "../../../data/dashboard.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$token = new TokenModel($conn);
$token->token = isset($_SERVER['HTTP_TOKEN']) ? $_SERVER['HTTP_TOKEN'] : die();

$token->get();

$user = new UserModel($conn);
$user->id = $token->userID;
$user->get();

$dashboard = new DashboardModel($conn);
$dashboard->userID=$user->id;
$dashboard->getWithID();

$response = [];

if ($request == 'GET') {
    if ($dashboard->waiting != null) {
        $data = array(
            "waiting" => $dashboard->waiting,
            "process" => $dashboard->process,
            "end" => $dashboard->end,
            "total" => $dashboard->total,
        );
        $response = array(
            'status' =>  array(
                'message' => 'Success', 'code' => (http_response_code(200))
            ), 'data' => $data
        );
    } else {
        http_response_code(404);
        $response = array(
            'status' =>  array(
                'message' => 'No Data Found', 'code' => http_response_code()
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
