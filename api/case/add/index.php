<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/case.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$case = new CaseModel($conn);

$data = json_decode(file_get_contents("php://input"));

$response = [];

if ($request == 'POST') {
    if (
        !empty($data->name) &&
        !empty($data->email) &&
        !empty($data->title) &&
        !empty($data->detail)
        
    ) {
        $case->id = $data->id;
        $case->userID = $data->userID;
        $case->name = $data->name;
        $case->email = $data->email;
        $case->title = $data->title;
        $case->detail = $data->detail;
        $case->status = $data->status;
        $case->createdAt = $data->createdAt;
        $case->updatedAt = $data->updatedAt;

        $data = array(
            'id' => $case->id,
            'userID' => $case->userID,
            'name' => $case->name,
            'email' => $case->email,
            'title' => $case->title,
            'detail' => $case->detail,
            'status' => $case->status,
            'createdAt' => $case->createdAt,
            'updatedAt' => $case->updatedAt,
        );

        if ($case->add()) {
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
