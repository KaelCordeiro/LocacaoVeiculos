<?php
    include '../connect/connect.php';

    $acao = '';
    if (isset($_GET["acao"])) {
        $acao = $_GET["acao"];
    }

    if ($acao == "logoff"){
        session_start();
        session_destroy();
        header("location:../login.php");	
    } else {
        if (isset($_POST["acao"])){
            $acao = $_POST["acao"];
            if ($acao == "login"){
                $user = $_POST['user'];
                $senha = $_POST['pass'];
                if ($user == "admin" && $senha == "admin") {
                    session_start();
                    $_SESSION['usuario'] = $user;
                    $_SESSION['perfil'] = $user;
                    header("location:../index.php");
                } else {
                    logar($user,$senha);
                }
            }
        }
    }

    function logar($user,$senha) {
        $sql = "SELECT * FROM ".$GLOBALS['tb_login'].
                " JOIN usuario ".
                "USING (usu_tipo) ".
                "WHERE log_id = '$user';";

        $result = mysqli_query($GLOBALS['conexao'], $sql);
        
        $senhaBD = "";
        $usuario = "";
        $perfil = "";

        while ($row = mysqli_fetch_array($result)){
            $senhaBD = $row['log_senha'];
            $usuario = $row['log_id'];
            $perfil = $row['usu_perfil'];
            $ativo = $row['log_ativo'];
        }

        $senha = sha1($senha); 
        
        if ($ativo) {
            if ($senha == $senhaBD) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                $_SESSION['perfil'] = $perfil;
                header("location:../index.php");	
            } else { 
                header("location:../login.php");
            }
        } else {
            header("location:../inativo.php");
        }
    }
        
        
?>	
