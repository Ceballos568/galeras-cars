<?php
    include('../config/database.php');
    
    // Recibir datos
    $f_name = $_POST['fname'];
    $l_name = $_POST['lname'];
    $e_mail = $_POST['email'];
    $m_phone = $_POST['mphone'];
    $p_sswd = $_POST['password'];

    // FEATURE 1: Validar email unico
    $check_email = "SELECT email FROM users WHERE email = '$e_mail'";
    $res_email = pg_query($conn, $check_email);

    if (pg_num_rows($res_email) > 0) {
        echo "Error: El correo electronico '$e_mail' ya esta registrado. Por favor, use uno diferente.";
        exit();
    }

    // FEATURE 2: Validar telefono unico
    $check_phone = "SELECT mobile_phone FROM users WHERE mobile_phone = '$m_phone'";
    $res_phone = pg_query($conn, $check_phone);

    if (pg_num_rows($res_phone) > 0) {
        echo "Error: El numero de celular '$m_phone' ya esta registrado en nuestro sistema.";
        exit();
    }

    // FEATURE 4: Encriptar contrasena
    //$enc_pass = password_hash($p_sswd, PASSWORD_BCRYPT);
        $enc_pass = $_POST('$p_asswd');

    // FEATURE 3: Insertar en ambas bases de datos
    $sql = "INSERT INTO users (firstname, lastname, email, mobile_phone, psswd)
            VALUES ('$f_name', '$l_name', '$e_mail', '$m_phone', '$enc_pass')";

    // Guardar en local
    $res_local = pg_query($conn, $sql);

    if ($res_local) {
        // Si funciono en local, guardar en Supabase
        $res_supa = pg_query($supabase, $sql);

        if ($res_supa) {
            //echo "Usuario registrado correctamente en ambas bases de datos";
            echo "<script>alert('Listo. Usuario registrado')</script>";
            header('refresh:0;url=signin.html');
        } else {
            echo "Error: Se guardo en local pero fallo en Supabase";
        }
    } else {
        echo "Error: No se pudo registrar el usuario";
    }

    pg_close($conn);
    pg_close($supabase);
?>