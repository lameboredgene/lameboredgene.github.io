<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Database connection
    $conn = new mysqli('localhost', 'root', '', 'registration_test');
    if($conn->connect_error){
        echo "$conn->connect_error";
        die('Connection Failed : '.$conn->connect_error);
    } else {
        $stmt = $conn->prepare("select * from registration where email = ?");
        $stmt->bind_param("s", $email);
        $execval = $stmt->execute();
        echo $execval;
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if($data['password'] === $password) {
                echo "<h2>Login Successful</h2>";
            }
        } else {
            echo "<h2>Invalid Email or Password</h2>";
        }
    }

?>

>