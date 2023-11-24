<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Pagina de Login</title>
    <style>
        body {
            font-family: calibri;
            font-weight: bold;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .formulario {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size:18px;
        }

        h1 {
            text-align: center;
            color:#007bff;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
            text-decoration: none;
            font-size:15px;
            font-weight: bold;
        }

        button:hover {
            background-color: #0056b3;
        }

        button a{
            text-decoration: none;
            color:#fff;
        }

        .error-message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    // Conexão com o banco de dados (substitua essas informações pelos seus dados)
    $servername = "localhost";
    $username = "root";
    $password = "sucesso";
    $dbname = "trab_web2";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Definindo a variável de erro
    $error_message = "";

    // Processa os dados do formulário e verifica se o usuário já existe
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $USR_LOGIN_NOME = $_POST["user_cad"];
        $SENHA = $_POST["passw"];

        // Verificar se o usuário já existe
        $consulta_usuario = "SELECT * FROM USR_LOGIN WHERE USR_LOGIN_NOME = '$USR_LOGIN_NOME' AND SENHA = '$SENHA'";
        $verifica_usuario = "SELECT * FROM USR_LOGIN WHERE USR_LOGIN_NOME = '$USR_LOGIN_NOME' AND SENHA <> '$SENHA'";
        $resultado1 = $conn->query($consulta_usuario);
        $resultado2 = $conn->query($verifica_usuario);

        // VERIFICAR SE O USUÁRIO EXISTE AO LOGAR
        if ($resultado1->num_rows > 0) {
            // Se não houver cadastro em PESSOAS, redireciona para form.php
            echo '<META HTTP-EQUIV="Refresh" Content="1;URL=sub_tela.html">';
        } elseif ($resultado2->num_rows > 0) {
            $error_message = "Usuário ou senha incorretos.";
        } else {
            $error_message = "Usuário não encontrado no nosso banco de dados.";
        }
    }
    $conn->close();
    ?>

    <div class="formulario">
        <h1>Faça seu login</h1>
        <!-- Mostrar a mensagem de erro acima do formulário -->
        <?php
        if (isset($error_message) && $error_message !== "") {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
        <!-- Formulário para inserir dados -->
        <form id="login_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="user_cad">Usuário:</label>
            <input type="text" name="user_cad" id="user_cad" required><br>

            <label for="passw">Senha:</label>
            <input type="password" name="passw" id="passw" required><br>

            <button type="submit" value="Inserir">Entrar</button>
        </form>
        <br><a href="cadastro_login.php"><button>Cadastre-se</button></a>
    </div>
</body>

</html>
