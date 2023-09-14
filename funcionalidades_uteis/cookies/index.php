<?php
if (isset($_POST['nome'])) {
  // echo "<p> Bem Vindo,  " . $_POST['nome'] . "</p>";
  $duracao = time() + (30 * 24 * 60 * 60); // 30 dias
  setcookie("nome", $_POST['nome'], $duracao);
  header("Location: boasvindas.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="post">
    <p>Nome:</p>
    <input type="text" name="nome">
    <button type="submit">Entrar</button>
  </form>
</body>

</html>