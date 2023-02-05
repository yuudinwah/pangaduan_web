<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: DELETE');
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

if ($request == 'DELETE') {
    if (
        !empty($data->id)
    ) {
        $log->id = $data->id;

        if ($log->delete()) {
            $response = array(
                'status' => array(
                    'message' => 'Success',
                    'code' => (http_response_code(200))
                )
            );
        } else {
            http_response_code(400);
            $response = array(
                'message' => 'Delete Failed',
                'code' => http_response_code()
            );
        }
    } else {
        http_response_code(400);
        $response = array(
            'status' => array(
                'message' => 'Delete Failed - Wrong Parameter',
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