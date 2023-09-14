<?php

include('connection.php');
$id = intval($_GET['id']);
function cleanPhone($str)
{
  return preg_replace("/[^0-9]/", "", $str);
}

if (count($_POST) > 0) {


  $erro = false;

  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $nascimento = $_POST["nascimento"];
  $telefone = $_POST["telefone"];

  if (empty($nome)) {
    $erro = "Preencha o nome";
  }

  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erro = "Preencha o email corretamente";
  }

  if (!empty($nascimento)) {
    $tmp = explode("/", $nascimento);
    if (count($tmp) == 3) {
      $formatedData = implode('-', array_reverse($tmp));
      $nascimento = $formatedData;
    } else {
      $erro = "A data precisa seguir o formato dia/mes/ano.";
    }
  }

  if (!empty($telefone)) {
    $telefone = cleanPhone($telefone);
    if (strlen($telefone) != 11) {
      $erro = "O telefone deve ser preenchido no padrão (00) 00000-0000";
    }
  }

  if ($erro) {
    echo "<p><b>Erro: $erro</b></p>";
  } else {
    $sql = "UPDATE clientes
    SET nome = '$nome',
    email = '$email',
    nascimento = '$nascimento',
    telefone = '$telefone'
    WHERE id = '$id'
    ";

    $deuCerto = $mysqli->query($sql) or die($mysqli->error);
    if ($deuCerto) {
      echo "<p><b>Cliente atualizado com sucesso!</b></p>";
      unset($_POST);
    }
  }
}

$sql_cliente = "SELECT * FROM clientes WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();

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
  </style>
  <title>Clientes</title>
</head>

<body>
  <a href="clientes.php">Voltar para a Lista</a>
  <form action="" method="post">
    <span>
      <label>
        Nome
        <input value="<?php echo $cliente['nome'] ?>" name="nome" type="text" />
      </label>
    </span>
    <span>
      <label>
        Email
        <input value="<?php echo $cliente['email'] ?>" name="email" type="text" />
      </label>
    </span>
    <span>
      <label>
        Data de Nascimento
        <input value="<?php if ($cliente['nascimento']) echo date_formater($cliente['nascimento']) ?>" name="nascimento" type="text" />
      </label>
    </span>
    <span>
      <label>
        Telefone
        <input value="<?php if ($cliente['telefone']) echo phone_format($cliente['telefone']) ?>" placeholder="(11) 98888-8888" name="telefone" type="text" />
      </label>
    </span>
    <span>
      <button type="submit">Enviar</button>
    </span>
  </form>
</body>

</html>