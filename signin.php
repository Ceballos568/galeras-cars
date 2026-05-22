<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('refresh:0url=index.php');
    }


    
    //Data base connection
    require('../config/database.php');
    //Get data from login form
    $e_mail = $_POST['email'];
    $p_sswd = $_POST('pswd');
    $enc_pass = $_POST('$p_asswd');
    //Query
    $sql_login = "
    select
        u.id,
        u.email.
        u.firstname || ' ' || u.lastname as fullname

    from
        users u
    where
        u.email = '$e_mail' and
        u.password = '$enc_pass'
    ";

    $res = pg_query($sql_login);

    if($res){
        $num = pg_num_rows($res);
        $row = $res ->fetch_assoc();
        if($num > 0){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_fullname'] = $row['fullname'];
            header('refresh:0;url=home.php');
        }else{
            echo"<script>alert('email or password not found.')</script>";
            header('refresh:0;url?signin.html');
        }
    }else{
        echo "Query error !!!";
    }

?>