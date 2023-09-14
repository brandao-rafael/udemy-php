<?php
include('connection.php');

$sql_clientes = "SELECT * FROM clientes";
$result = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $result->num_rows;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Clientes</title>
</head>

<body>
  <h1>Lista de clientes</h1>
  <p>Estes são os clientes cadastrados no seu sistema:</p>
  <table border="1" cellpadding="10" >
    <thead>
      <th>Id</th>
      <th>Nome</th>
      <th>E-mail</th>
      <th>Telefone</th>
      <th>Nascimento</th>
      <th>Data de cadastro</th>
      <th>Ações</th>
    </thead>
    <tbody>
      <?php
      if ($num_clientes == 0) { ?>
        <tr>
          <td colspan="7">Nenhum cliente foi cadastrado</td>
        </tr>
      <?php  } else {
        while($cliente = $result->fetch_assoc()) {

          $telefone = "Não informado";
          if(!empty($cliente['telefone'])) {
            $telefone = phone_format($cliente['telefone']);
          }

          $nascimento = "Não informado";
          if(!empty($cliente['nascimento'])) {
            $nascimento = date_formater($cliente['nascimento']);
          }

          $dataCadastro = date("d/m/Y H:i", strtotime($cliente['data']));
      ?>
      <tr>
        <td><?php echo $cliente['id']; ?></td>
        <td><?php echo $cliente['nome']; ?></td>
        <td><?php echo $cliente['email']; ?></td>
        <td><?php echo $telefone; ?></td>
        <td><?php echo $nascimento; ?></td>
        <td><?php echo $dataCadastro; ?></td>
        <td>
          <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>">Editar</a>
          <a href="deletar_cliente.php?id=<?php echo $cliente['id']; ?>">Deletar</a>
        </td>
      </tr>
      <?php }} ?>
    </tbody>
  </table>
</body>

</html>