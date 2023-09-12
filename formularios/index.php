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
      foreach ($_POST as $key => $value) {
        if($key === "enviado") {
          return;
        }
        if($value != "") {
          echo "O " . ucfirst($key) . " é: " . $value . "<br>";
        }
      }
    }
    ?>
</body>

</html>