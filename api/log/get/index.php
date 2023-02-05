<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/log.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$log = new LogModel($conn);
$log->id = isset($_GET['id']) ? $_GET['id'] : die();

$log->get();

$response = [];

if ($request == 'GET') {
    if ($log->id != null) {
        $data = array(
            'id'=>$log->id,
            'userID'=>$log->userID,
            'action'=>$log->action,
            'detail'=>$log->detail,
            'createdAt'=>$log->createdAt
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
