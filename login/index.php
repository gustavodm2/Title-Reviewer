<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"];
    $senha = $_POST["password"];
    $captchaChecked = isset($_POST["show-captcha"]);

    if (!$captchaChecked) {
        echo '<script>alert("Por favor marque o CAPTCHA!");</script>';
    } else {
        $captchaResult = (int) $_POST["captcha_result"];
        $userCaptcha = (int) $_POST["captcha"];

        if ($userCaptcha !== $captchaResult) {
            echo '<script>alert("CAPTCHA está incorreto!");</script>';
        } else {
            $sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";
            $resultado = mysqli_query($conn, $sql);
            $isUserLoggedIn = false;

            if ($resultado && mysqli_num_rows($resultado) > 0) {
                $isUserLoggedIn = true;
                $userData = mysqli_fetch_assoc($resultado);
                $_SESSION['username'] = $userData['nome'];
                $_SESSION['IDcliente'] = $userData['id'];

                header('Location: ../main-page/index-main.php');
                exit();
            } else {
                echo '<script>alert("Email e/ou senha incorretos!");</script>';
            }
            if (!$resultado) {
                printf("Error: %s\n", mysqli_error($conn));
                exit();
            }
        }
    }
}

if (isset($_POST['logout'])) {
    unset($_SESSION['username']);
    unset($_SESSION['IDcliente']);
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>title reviewer</title>
    <link rel="icon" type="image/png" href="/assets/images/logo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  
</head>
<body>
    <div class="pagina">
        <header>
            <a href="../main-page/index-main.php">    
                <i class="fas fa-home fa-2x" id="menu-icon"></i>
            </a>
            <div class="page-title">
                <h1>CRAZY MOTHERFUCKER</h1>
            </div>
            <div id="user-info" class="user-info">
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo "Bem-vindo, $username!";
                    echo '<form action="" method="post"><input type="submit" name="logout" value="Sair"></form>';
                } else {
                    echo '<span class="login-button" id="loginButton"><a href="../login/index.php">Login</a>/<a href="../cadastro/index.php">Cadastro</a></span>';
                }
                ?>
            </div>
        </header>  
        <div class="form-container">
            <?php
            if (!isset($_SESSION['username'])) {
            ?>
            <form class="login-form" action="./index.php" method="post">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Senha">
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
                <button type="submit">Login</button>
                <a id="cadastrese" href="../cadastro/index.php">Não possui cadastro? Clique aqui e cadastre-se!</a>
            </form>
            <?php
            }
            ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>   
</html>
