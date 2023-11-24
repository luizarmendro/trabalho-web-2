<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>

    <style>
        body {
            font-family: calibri;
            
            
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

        .message-edit {
            color: green;
            font-weight: bold;
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

    $message = "";
    $error_message = "";

    // Processa os dados do formulário e verifica se o usuário já existe
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $USR_LOGIN_NOME = $_POST["username"];
        $SENHA = $_POST["senha"];

        // Verificar se o usuário já existe
        $verifica_usuario = "SELECT * FROM USR_LOGIN WHERE USR_LOGIN_NOME = '$USR_LOGIN_NOME'";
        $resultado = $conn->query($verifica_usuario);

        if ($resultado->num_rows > 0) {
            $error_message = "Usuário já cadastrado. Escolha outro nome de usuário.";
        } else {
            // Query para inserir os dados no banco
            $sql = "INSERT INTO USR_LOGIN (USR_LOGIN_NOME, SENHA) VALUES ('$USR_LOGIN_NOME', '$SENHA')";

            if ($conn->query($sql) === TRUE) {
                $message = "Usuário cadastrado com sucesso!";
            } else {
                $error_message = "Erro ao cadastrar: " . $conn->error;
            }
        }
    }
    $conn->close();
    ?>

    <div class="formulario">
        <h1>Faça seu cadastro</h1>
        <?php
        if (isset($message) && $message !== "") {
            echo "<p class='message-edit'>$message</p>";
        }
        if (isset($error_message) && $error_message !== "") {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>
        <!-- Formulário para inserir dados -->
        <form id="login_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Usuário:</label>
            <input type="text" name="username" id="username" required><br>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required><br>

            <button type="submit" value="Inserir">Cadastrar</button>
        </form>
        <br><a href="index.php"><button>Sair</button></a>
    </div>
</body>

</html>