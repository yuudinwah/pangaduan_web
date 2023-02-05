<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/case.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$case = new CaseModel($conn);

$data = json_decode(file_get_contents("php://input"));

$case->id = $data->id;


$response = [];

if ($request == 'DELETE') {
    if (
        !empty($data->id)
    ) {
        $case->id = $data->id;

        if ($case->delete()) {
            $response = array(
                'status' =>  array(
                    'message' => 'Success', 'code' => (http_response_code(200))
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
            'status' =>  array(
                'message' => 'Delete Failed - Wrong Parameter', 'code' => http_response_code()
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
