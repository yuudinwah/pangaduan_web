<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/caseResponse.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$caseResponse = new CaseResponseModel($conn);
$caseResponse->id = isset($_GET['id']) ? $_GET['id'] : die();

$caseResponse->get();

$response = [];

if ($request == 'GET') {
    if ($caseResponse->id != null) {
        $data = array(
            'id'=>$caseResponse->id,
            'caseID'=>$caseResponse->caseID,
            'userID'=>$caseResponse->userID,
            'response'=>$caseResponse->response,
            'createdAt'=>$caseResponse->createdAt,
            'updatedAt'=>$caseResponse->updatedAt,
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
