<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/case.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$case = new CaseModel($conn);
$case->id = isset($_GET['id']) ? $_GET['id'] : die();

$case->get();

$response = [];

if ($request == 'GET') {
    if ($case->id != null) {
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
        $response = array(
            'status' =>  array(
                'messsage' => 'Success', 'code' => (http_response_code(200))
            ), 'data' => $data
        );
    } else {
        http_response_code(404);
        $response = array(
            'status' =>  array(
                'messsage' => 'No Data Found', 'code' => http_response_code()
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
