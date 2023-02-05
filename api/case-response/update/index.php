<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/caseResponse.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$caseResponse = new CaseResponseModel($conn);

$data = json_decode(file_get_contents("php://input"));

$caseResponse->id = $data->id;

$response = [];

if ($request == 'PUT') {
    if (
        !empty($data->id) &&
        !empty($data->caseID) &&
        !empty($data->userID) &&
        !empty($data->response)
    ) {
        $caseResponse->id = $data->id;
        $caseResponse->caseID = $data->caseID;
        $caseResponse->userID = $data->userID;
        $caseResponse->response = $data->response;
        $caseResponse->updatedAt = date("Y-m-d h:i:s");

        $data = array(
            'id' => $caseResponse->id,
            'caseID' => $caseResponse->caseID,
            'userID' => $caseResponse->userID,
            'response' => $caseResponse->response,
            'createdAt' => $caseResponse->createdAt,
            'updatedAt' => $caseResponse->updatedAt,
        );

        if ($caseResponse->update()) {
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
