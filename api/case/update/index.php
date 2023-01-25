<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: PUT');
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

if ($request == 'PUT') {
    if (
        !empty($data->id) &&
        !empty($data->name) &&
        !empty($data->email) &&
        !empty($data->title) &&
        !empty($data->detail) &&
        !empty($data->status)
    ) {
        $case->id = $data->id;
        $case->name = $data->name;
        $case->email = $data->email;
        $case->title = $data->title;
        $case->detail = $data->detail;
        $case->status = $data->status;
        $case->updatedAt = date("Y-m-d h:i:s");

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

        if ($case->update()) {
            $response = array(
                'status' =>  array(
                    'messsage' => 'Success', 'code' => (http_response_code(200))
                ), 'data' => $data
            );
        } else {
            http_response_code(400);
            $response = array(
                'messsage' => 'Update Failed',
                'code' => http_response_code()
            );
        }
    } else {
        http_response_code(400);
        $response = array(
            'status' =>  array(
                'messsage' => 'Update Failed - Wrong Parameter', 'code' => http_response_code()
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
