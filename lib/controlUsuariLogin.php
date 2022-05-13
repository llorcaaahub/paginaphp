<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"]!="POST" ){
        header("Location:./index.php");
    }else{
        
        require_once('../ConexionDB/conexionBD.php');

        
        // Les variables de Login
        if( isset($_POST['usuari_login']) && isset($_POST['password_login'])){
            if (strpos($_POST["usuari_login"], '@') !== false) {
                $mailLogin = $_POST['usuari_login'];
                $passwordLogin = $_POST['password_login'];
            }else{
                $usuariLogin = $_POST['usuari_login'];
                $passwordLogin = $_POST['password_login'];
            }
        }
        
        try{
            if(isset($usuariLogin) && isset($passwordLogin)){
                // Login USUARI
                $correcte = false;
                $sql = 'SELECT username,passHash,active FROM `users`';
                $usuaris = $db->query($sql);
                foreach ($usuaris as $fila) {
                    if($usuariLogin == $fila[0] && password_verify($passwordLogin, $fila[1]) && $fila[2] == 1){
                        $_SESSION['usuari'] = $usuariLogin;
                        $correcte = true;
                        $ultimlogin = date('Y\/m\/d G:i:s');
                        $update = "update users SET lastSignIn = :ultim WHERE username = :usu ;";
                        $preparada = $db->prepare($update);
                        $preparada->execute(array(':ultim' => $ultimlogin, ':usu' => $usuariLogin));
                        echo "<form name='fr' action='../index.php' method='POST'>
                        <include type='hidden' name='var1' value='val1'>
                        <include type='hidden' name='var2' value='val2'>
                        </form>
                        <script type='text/javascript'>
                        document.fr.submit();
                        </script>";
                        break;                 
                    }
                }
                if($correcte == false){
                    $missatge = "Login Incorrecte, prova de canviar de credencial o activar el compte";
                        echo 
                        "<script type='text/javascript'>
                                alert('$missatge');
                                window.location.href='../index.php';
                        </script>";
                }
            }
            if(isset($mailLogin) && isset($passwordLogin)){
                // Login MAIL
                $correcte = false;
                $sql = 'SELECT username,passHash,mail FROM `users`';
                $usuaris = $db->query($sql);
                foreach ($usuaris as $fila) {
                    if($mailLogin == $fila[2] && password_verify($passwordLogin, $fila[1]) && $fila[2] == 1){
                        $usuariLogin = $fila[0];
                        $_SESSION['usuari'] = $usuariLogin;
                        $correcte = true;
                        $ultimlogin = date('Y\/m\/d G:i:s');
                        $update = "update users SET lastSignIn = :ultim WHERE username = :usu ;";
                        $preparada = $db->prepare($update);
                        $preparada->execute(array(':ultim' => $ultimlogin, ':usu' => $usuariLogin));
                        echo "<form name='fr' action='../index.php' method='POST'>
                        <include type='hidden' name='var1' value='val1'>
                        <include type='hidden' name='var2' value='val2'>
                        </form>
                        <script type='text/javascript'>
                        document.fr.submit();
                        </script>";
                        break;                 
                    }
                }
                if($correcte == false){
                    $missatge = "Login Incorrecte, prova de canviar de credencial o activar el compte";
                        echo "<script type='text/javascript'>
                                alert('$missatge');
                                window.location.href='../index.php';
                            </script>";
                }
            }
        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
    }
?>