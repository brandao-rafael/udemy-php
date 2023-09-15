<?php
include("conexao.php");

if(isset($_GET['deletar'])) {
  $id = intval($_GET['deletar']);
  $sql_query = $mysqli->query("SELECT * FROM arquivos WHERE id = $id") or die($mysqli->error);
  $arquivo = $sql_query->fetch_assoc();
  
  if(unlink($arquivo['path'])) {
    $deu_certo = $mysqli->query("DELETE FROM arquivos WHERE id = $id") or die($mysqli->error);
    if($deu_certo)
      echo "<p>Arquivo removido com sucesso</p>";
  }

}

function enviarArquivo($error, $size, $name, $tmp_name)
{
  include("conexao.php");
  if ($error)
    die('Falha ao enviar o arquivo');

  if ($size > 2097152)
    die("Arquivo muito grande! Max 2MB");

  $pasta = "arquivos/";
  $nomeDoArquivo = $name;
  $novoNomeDoArquivo = uniqid();
  $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
  $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

  if ($extensao != 'jpg' && $extensao != 'png' && $extensao != 'jpeg')
    die("Tipo de arquivo não aceito");

  $deuCerto = move_uploaded_file($tmp_name, $path);

  if ($deuCerto) {
    $sql_code = "INSERT INTO arquivos (nome, path, data_upload) VALUES('$nomeDoArquivo', '$path', NOW())";
    $mysqli->query($sql_code) or die($mysqli->error);
    return true;
  } else {
    return false;
  }
};

if (isset($_FILES['arquivos'])) {
  $arquivos = $_FILES['arquivos'];
  $tudo_certo = true;
  foreach($arquivos['name'] as $index => $arq) {
    $deu_certo = enviarArquivo($arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos['tmp_name'][$index]);

    if(!$deu_certo)
      $tudo_certo = false;
  }

  if($tudo_certo) {
    echo "<p>Todos os arquivos foram enviados com sucesso!</p>";
  } else {
    echo "falha ao enviar um ou mais arquyivos";
  }

}

function date_formater($date)
{
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
      <input multiple type="file" name="arquivos[]">
    </label>
    <button type="submit">Enviar</button>
  </form>
  <h1>Lista de arquivos</h1>
  <table border="1" cellpadding="10">
    <thead>
      <th>Preview</th>
      <th>Arquivo</th>
      <th>Data de Envio</th>
      <th>Deletar</th>
    </thead>
    <tbody>
      <tr>
        <?php
        while ($file = $sql_query->fetch_assoc()) { ?>
      <tr>
        <td><img src="<?php echo $file['path']; ?>" height="50px"></td>
        <td><a href="<?php echo $file['path']; ?>" target="_blank"><?php echo $file['nome'] ?></a></td>
        <td><?php echo date("d/m/Y H:i", strtotime($file['data_upload'])) ?></td>
        <td><a href="index.php?deletar=<?php echo $file['id']; ?>">Deletar</td>
      </tr>
    <?php }
    ?>

    </tr>
    </tbody>
  </table>
</body>

</html>