<?php 
include("conexao.php");

if (!isset($_SESSION))
  session_start();

if(!isset($_SESSION['usuario']))
  die("Você não está logado. <a href='login.php'>Login</a>");

if (isset($_POST['email'])) {

  $email = $_POST['email'];
  $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

  $mysqli->query("INSERT INTO senhas (email, senha) VALUES('$email', '$senha')") or die($mysqli->error);
}

$id = $_SESSION['usuario'];
$query = "SELECT * FROM senhas WHERE id = '$id' LIMIT 1";
$mysqli_exec = $mysqli->query($query) or die($mysqli->error);
$usuario = $mysqli_exec->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    form {
      display: flex;
      flex-direction: column;
    }
    button {
      width: 10%;
    }
  </style>
  <title>Document</title>
</head>
<body>
  <p>Bem vindo, <?php echo $usuario['nome']?></p>
  <h1>Cadastrar Usuário</h1>
  <form action="" method="post">
    <label>
      Email:
      <input type="text" name="email">
    </label>
    <label>
      Senha:
      <input type="text" name="senha">
    </label>
    <button type="submit">Cadastrar</button>
  </form>
  <span><a href="logout.php">Sair</a></span>
</body>
</html>