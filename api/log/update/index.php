<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/log.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$log = new LogModel($conn);

$data = json_decode(file_get_contents("php://input"));

$log->id = $data->id;

$response = [];

if ($request == 'PUT') {
    if (
        !empty($data->id) &&
        !empty($data->userID) &&
        !empty($data->action) &&
        !empty($data->detail)
    ) {
        $log->id = $data->id;
        $log->userID = $data->userID;
        $log->action = $data->action;
        $log->detail = $data->detail;

        $data = array(
            'id' => $log->id,
            'userID' => $log->userID,
            'action' => $log->action,
            'detail' => $log->detail,
            'createdAt' => $log->createdAt
        );

        if ($log->update()) {
            $response = array(
                'status' =>  array(
                    'message' => 'Success', 'code' => (http_response_code(200))
                ), 'data' => $data
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
            'status' =>  array(
                'message' => 'Update Failed - Wrong Parameter', 'code' => http_response_code()
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