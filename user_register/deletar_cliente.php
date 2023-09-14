<?php 
if(isset($_POST['confirmar'])) {
  include("connection.php");
  $id = intval($_GET['id']);
  $sql_code = "DELETE FROM clientes WHERE id='$id'";
  $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

  if($sql_query) { ?>
    <h1>Cliente deletado com sucesso</h1>
    <a href="clientes.php">Voltar para lista de clientes</a>
  <?php 
  die();
  } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deletar cliente</title>
</head>
<body>
  <div>
    <h3>Tem certeza que deseja deletar o cliente?</h3>
    <form action="" method="post">
      <a href="clientes.php">Não</a>
      <button name="confirmar" value="1" type="submit">Sim</button>
    </form>
  </div>
</body>
</html>