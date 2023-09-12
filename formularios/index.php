<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário</title>
  <style>
    .error {
      color: red;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    button {
      width: 10vw;
    }
  </style>
</head>

<body>
  <form method="post" action="">
    <h1>Formulário com PHP</h1>
    <p class="error">* Obrigatório</p>

    <label>
      Nome: <input type="text" name="nome" /> <span class="error">*</span>
    </label>
    <label>
      Email: <input type="text" name="email" /> <span class="error">*</span>
    </label>
    <label>
      WebSite: <input type="text" name="website" />
    </label>
    <label>
      Comentarios: <textarea name="comentario" cols="30" rows="3"></textarea>
    </label>
    <div>
      Gênero:
      <label>
        <input type="radio" name="genero" value="masculino"> Masculino
      </label>
      <label>
        <input type="radio" name="genero" value="feminino"> Feminino
      </label>
      <label>
        <input type="radio" name="genero" value="outros"> Outros
      </label>
    </div>
    <button name="enviado" type="submit">Enviar</button>
  </form>
  <h2>Dados enviados:</h2>
  <?php
  if (isset($_POST['enviado'])) {
    if (empty($_POST['nome']) || strlen($_POST['nome']) < 3 || strlen($_POST["nome"]) > 100) {
      echo '<p class="error">Nome inválido</p>';
      die();
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      echo '<p class="error">Email inválido</p>';
      die();
    }

    if (!empty($_POST['website']) && !filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
      echo '<p class="error">URL inválida</p>';
      die();
    }
    if (
      !empty($_POST['genero'])
      &&
      ($_POST['genero'] != 'masculino' && $_POST['genero'] != 'feminino' && $_POST['genero'] != 'outros')
    ) {
      echo '<p class="error">Gênero inválido</p>';
      die();
    }

    foreach ($_POST as $key => $value) {
      if ($key === "enviado") {
        return;
      }
      if ($value != "") {
        echo "O " . ucfirst($key) . " é: " . $value . "<br>";
      }
    }
  }
  ?>
</body>

</html>