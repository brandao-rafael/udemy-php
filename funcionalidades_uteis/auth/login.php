<?php 
if (isset($_POST['email'])) {
  
  include("conexao.php");
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $sql_code = "SELECT * FROM senhas WHERE email = '$email' LIMIT 1";
  $sql_exec = $mysqli->query($sql_code) or die($mysqli->error);
  $usuario = $sql_exec->fetch_assoc();
  if (password_verify($senha, $usuario['senha'])) {
    echo "Usuário logado";
  } else {
    echo "Senha ou email inválidos";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body>
  <form action="" method="post">
    <input type="text" name="email">
    <input type="text" name="senha">
    <button type="submit">Logar</button>
  </form>
</body>

</html>