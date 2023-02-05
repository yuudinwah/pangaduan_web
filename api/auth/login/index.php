<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: X-Requested-With');
header("Content-Type: application/json; charset=UTF-8");

include_once "../../../config/database.php";
include_once "../../../data/account.php";
include_once "../../../data/token.php";

$request = $_SERVER['REQUEST_METHOD'];

$db = new Database();
$conn = $db->connection();

$account = new AccountModel($conn);
$token = new TokenModel($conn);

$data = json_decode(file_get_contents("php://input"));

$response = [];

if ($request == 'POST') {
    if (
        !empty($data->email) &&
        !empty($data->password)
    ) {
        $account->email = $data->email;

        $account->signin();
        if ($account->id != null) {
            if ($account->password == md5($data->password)) {
                $date = date("Y-m-d h:i:s");
                $expiredAt = date_create($date);
                date_add($expiredAt, date_interval_create_from_date_string("1 days"));
                $expiredAt = date_format($expiredAt, "Y-m-d");
                $generatedToken = md5($date . $account->id);

                $token->userID = $account->id;
                $token->token = $generatedToken;
                $token->expiredAt = $expiredAt;
                $token->add();
                $response = array(
                    'status' => array(
                        'message' => 'Success',
                        'code' => (http_response_code(200))
                    ),
                    'data' => array(
                        'token' => $generatedToken,
                        'expiredAt' => $expiredAt,
                        'date' => $date,
                    )
                );
            } else {
                http_response_code(404);
                $response = array(
                    'status' => array(
                        'message' => 'Incorrect Email or Password',
                        'code' => http_response_code()
                    )
                );
            }
        } else {
            http_response_code(404);
            $response = array(
                'status' => array(
                    'message' => 'account Not Found',
                    'code' => http_response_code()
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