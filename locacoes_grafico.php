<?php
    session_start();
    if (isset($_SESSION['perfil']) && $_SESSION['perfil' == "admin"]) {
        $perfil = $_SESSION['perfil'];
    } else {
        session_destroy();
        header("location:login.php");
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            
        ?>
    </body>
</html>
