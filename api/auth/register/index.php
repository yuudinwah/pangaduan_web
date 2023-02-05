<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/account.php";
include_once "../../../data/token.php";
include_once "../../../data/userRole.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$account = new AccountModel($conn);
$userRole = new UserRoleModel($conn);

$data = json_decode(file_get_contents("php://input"));

$response = [];

if ($request == 'POST') {
    if (
        !empty($data->name) &&
        !empty($data->email) &&
        !empty($data->password)
    ) {
        $account->email = $data->email;

        $account->getEmail();
        if ($account->id != null) {
            http_response_code(400);
            $response = array(
                'status' => array(
                    'message' => 'Email sudah pernah terdaftar',
                    'code' => http_response_code()
                )
            );
        } else {
            $account = new AccountModel($conn);
            $account->name = $data->name;
            $account->email = $data->email;
            $account->password = md5($data->password);
            $account->signup();
            $account->getEmail();
            $response = array(
                'status' => array(
                    'message' => 'Success',
                    'code' => (http_response_code(200))
                )
            );
        }
    } else {
        http_response_code(400);
        $response = array(
            'status' => array(
                'message' => 'Authentication Failed - Wrong Parameter',
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