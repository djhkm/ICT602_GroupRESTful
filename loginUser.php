<?php
$conn = "";
require_once 'db.php';

if (isset($_POST['username']) && isset($_POST['password'])) {

    $filteredPost = filter_input_array(INPUT_POST, ['username' => FILTER_SANITIZE_STRING, 'password' => FILTER_SANITIZE_STRING]);
    $username = $filteredPost['username'];
    $password = $filteredPost['password'];

    if ($username == null  || $password == null) {
        echo json_encode(array(
            "statusCode"=>400,
            "statusDesc"=>"Please fill in the form"
        ));
    }
    else {
        $verifyAccount = $conn->query("SELECT UserID, Username, Password, UserTypeID FROM User WHERE Username = '$username' AND Password = '$password'");

        if ($verifyAccount->num_rows > 0) {

            $rowAccount = $verifyAccount->fetch_object();

            echo json_encode(array(
                "id"=>$rowAccount->UserID,
                "username"=>$rowAccount->Username,
                "userType"=>$rowAccount->UserTypeID,
                "statusCode"=>200,
                "statusDesc"=>"Success"
            ));
        }
        else {
            echo json_encode(array(
                "statusCode"=>400,
                "statusDesc"=>"Username and password does not match"
            ));
        }
    }
}
else {
    echo json_encode(array(
        "statusCode"=>400,
        "statusDesc"=>"Incomplete HTTP request"
    ));
}
$conn->close();
?>