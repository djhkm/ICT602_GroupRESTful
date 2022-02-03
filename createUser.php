<?php
$conn = "";
require_once 'db.php';

if (isset($_POST['username']) && isset($_POST['password'])) {

    $filteredPost = filter_input_array(INPUT_POST, ['username' => FILTER_SANITIZE_STRING, 'password' => FILTER_SANITIZE_STRING]);
    $username = $filteredPost['username'];
    $password = $filteredPost['password'];

    if ($username == null  || $password == null) {
        die("Please fill in the form");
    }

    $result = $conn->query("INSERT INTO User (UserID, Username, Password, UserTypeID) VALUES (null, '$username', '$password', null)");

    if (!$result) {
        echo $conn->error;
        echo "Some stupid error";
    }
    else {
        echo "'$username' successfully registered";
    }
}
else {
    die("Incomplete HTTP request");
}
?>
