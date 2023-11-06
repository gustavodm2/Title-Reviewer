<?php
include '../db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $senha_confirmada = $_POST['confirm_password'];
    $captchaChecked = isset($_POST["show-captcha"]);

    if (!$captchaChecked) {
        echo '<script>alert("Please verify the CAPTCHA!");</script>';
    } else {
        $captchaResult = (int) $_POST["captcha_result"];
        $userCaptcha = (int) $_POST["captcha"];

        if ($userCaptcha !== $captchaResult) {
            echo '<script>alert("CAPTCHA answer is incorrect!");</script>';
        } else {
            $sql = "INSERT INTO clientes (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
            if ($conn->query($sql) === TRUE) {
                header("Location: ../login/index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>title reviewer</title>
  
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
    </head>
    <body>
        <div class="pagina">
        <header>
        
        <div class="page-title">
        <h1>BEST FEEDER</h1>
        </div>
            <div id="user-info" class="user-info">
                  
            </div>
     
            <span class="login-button" id="loginButton">Fazer Login/Cadastro</span>
      

    </header>

            <div class="form-container">
               
                <form class="login-form" action="./index.php" method="post">
                    <input type="nome" placeholder="Nome Completo" name="name">
                    <input type="email" placeholder="Email" name="email">
                    <div class="caixa-senha">
                        <input type="password" placeholder="Senha" name="password">
                        <input type="password" placeholder="Repetir Senha" name="confirm_password">                       
                    </div>
                    <div class="checkbox-div">
                    <label class="custom-checkbox"> 
                    <input type="checkbox" id="show-captcha" name="show-captcha">
                        <span id="CAPTCHA">CAPTCHA</span> 
                        <span class="checkmark"></span>
                    </label>
                    </div>
                        <div id="captcha-container" style="display: none;">
                            <input type="hidden" name="captcha_result" id="captcha_result">
                        <div id="captcha"></div>
                            <input type="text" name="captcha" placeholder="Digite o resultado">
                        </div>
                        <button type="submit">Registrar</button>
                    <a id=cadastrado href="/pages/login/index.php">Já é cadastrado? Clique aqui para efetuar o login!</a>
                </form>
            </div>
        </div>   
        
        <script src="script.js"></script>
    </body>   
    
</html>

