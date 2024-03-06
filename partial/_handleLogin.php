<?php
$showError = "false";
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include '_dbConnect.php';
        $email = $_POST['loginEmail'];
        $pass = $_POST['loginPass'];

        $sql = "SELECT * FROM users WHERE user_email = '$email'";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($pass,$row['user_pass'])){
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['useremail']=$email;
            }
            header("Location: /forum/index.php");                   
        }
        header("Location: /forum/index.php");                   
    }