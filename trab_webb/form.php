<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Área de Cadastro</title>
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
            font-size:15px;
        }

        h1 {
            text-align: center;
            font-size:24px;
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
            padding: 8px;
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

        .message-edit {
            color: green;
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $NOME = $_POST["NOME"];
        $CPF = $_POST["CPF"];
        $EMAIL = $_POST["EMAIL"];
        $CARGO = $_POST["CARGO"];
        $HABILIDADE = $_POST["HABILIDADE"];

        // Verificar se o usuário já existe
        $verifica_CPF = "SELECT * FROM PESSOAS WHERE CPF = '$CPF'";
        $resultado = $conn->query($verifica_CPF);

        if ($resultado->num_rows > 0) {
            $error_message = "CPF já cadastrado. Certifique-se de que digitou corretamente.";
        } else {
            // Query para inserir os dados no banco
            $sql = "INSERT INTO PESSOAS (NOME, CPF, EMAIL, CARGO, HABILIDADE) VALUES ('$NOME', '$CPF', '$EMAIL', '$CARGO', '$HABILIDADE')";

            if ($conn->query($sql) === TRUE) {
                $message = "Cadastro realizado com sucesso!";
            } else {
                $error_message = "Erro ao cadastrar: " . $conn->error;
            }
        }
    }
    $conn->close();
    ?>

    <div class="formulario">
        <h1>Faça seu cadastro</h1>
        <!-- Mostrar a mensagem de erro acima do formulário -->
        <?php
        if (isset($error_message) && $error_message !== "") {
            echo "<p class='error-message'>$error_message</p>";
        }
        if (isset($message) && $message !== "") {
            echo "<p class='message-edit'>$message</p>";
        }
        ?>
        <!-- Formulário para inserir dados -->
        <form id="login_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="NOME">NOME:</label>
            <input type="text" name="NOME" id="NOME" required><br>

            <label for="CPF">CPF:</label>
            <input type="text" name="CPF" id="CPF" required><br>

            <label for="EMAIL">E-MAIL:</label>
            <input type="text" name="EMAIL" id="EMAIL" required><br>

            <label for="CARGO">CARGO:</label>
            <input type="text" name="CARGO" id="CARGO" required><br>

            <label for="HABILIDADE">HABILIDADE:</label>
            <input type="text" name="HABILIDADE" id="HABILIDADE" required><br>

            <button type="submit" value="Inserir">Cadastrar</button>
        </form>
        <br><a href="sub_tela.html"><button>Voltar</button></a>
    </div>
</body>

</html>