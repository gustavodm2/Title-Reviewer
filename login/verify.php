<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = mysqli_connect("localhost", "ota", "password", "froggers");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$email = $_POST["email"];
$senha = $_POST["password"];

$sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";

$resultado = mysqli_query($conn, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    session_start();
    $row = mysqli_fetch_assoc($resultado);
    $_SESSION['user_id'] = $row['id'];
    $token = bin2hex(random_bytes(16));
    $user_id = $row['id'];
    $query = "INSERT INTO tokens (user_id, token) VALUES ('$user_id', '$token')";
    mysqli_query($conn, $query);
    setcookie('auth_token', $token, time() + 60 * 60 * 24 * 30, '/');

    header('Location: /pages/home/index.php');
exit();

} else {
  
    $_SESSION['error_message'] = "Email e/ou senha incorretos!";
    header('Location: /pages/login/index.php');
}

mysqli_close($conn);
?>
