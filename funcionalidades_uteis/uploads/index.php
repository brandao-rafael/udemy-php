<?php
include("conexao.php");
if (isset($_FILES['arquivo'])) {
  $arquivo = $_FILES['arquivo'];

  if ($arquivo['error'])
    die('Falha ao enviar o arquivo');

  if ($arquivo['size'] > 2097152)
    die("Arquivo muito grande! Max 2MB");

  $pasta = "arquivos/";
  $nomeDoArquivo = $arquivo['name'];
  $novoNomeDoArquivo = uniqid();
  $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
  $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

  if ($extensao != 'jpg' && $extensao != 'png' && $extensao != 'jpeg')
    die("Tipo de arquivo não aceito");

  $deuCerto = move_uploaded_file($arquivo['tmp_name'], $path);
  
  if ($deuCerto) {
    $sql_code = "INSERT INTO arquivos (nome, path, data_upload) VALUES('$nomeDoArquivo', '$path', NOW())";
    $mysqli->query($sql_code) or die($mysqli->error);
    echo "<p>Arquivo enviado com sucesso! Para acessá-lo, clique <a href=\"arquivos/$novoNomeDoArquivo.$extensao\" target=\"_blank\">aqui</a></p>";
  } else {
    echo "<p>Falha ao enviar arquivo</p>";
  }
}

function date_formater($date) {
  return implode("/", array_reverse(explode("-", $date)));
}

$sql_query = $mysqli->query("SELECT * FROM arquivos");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload</title>
</head>

<body>
  <form enctype="multipart/form-data" method="post">
    <label>
      Selecione seu arquivo:
      <input type="file" name="arquivo">
    </label>
    <button type="submit">Enviar</button>
  </form>
  <h1>Lista de arquivos</h1>
  <table border="1" cellpadding="10">
    <thead>
      <th>Preview</th>
      <th>Arquivo</th>
      <th>Data de Envio</th>
    </thead>
    <tbody>
      <tr>
  <?php 
  while($file = $sql_query->fetch_assoc()) { ?>
  <tr>
    <td><img src="<?php echo $file['path']; ?>" height="50px"></td>
    <td><a href="<?php echo $file['path']; ?>" target="_blank"><?php echo $file['nome']?></a></td>
    <td><?php echo date("d/m/Y H:i", strtotime($file['data_upload']))?></td>
  </tr>
  <?php }
  ?>
        
      </tr>
    </tbody>
  </table>
</body>

</html>