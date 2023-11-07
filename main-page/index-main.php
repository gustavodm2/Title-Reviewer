<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style-main.css">
    <title>Alimentador Automático</title>
</head>
<body>
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
                } else {
                    echo '<span class="login-button" id="loginButton"><a href="../login/index.php">Login</a>/<a href="../cadastro/index.php">Cadastro</a></span>';
                }
                ?>
            </div>
        </header>  
    
    
    </div>

   
    

    
</body>
</html>
