<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .formulario {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
        }

        tr:hover {
            background-color: #f9f9f9;
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
    </style>
    <title>Seu cadastro</title>
</head>

<body>
    <div class="formulario">
        <h1>Seu cadastro:</h1>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Habilidade</th>
                </tr>
            </thead>
            <tbody>
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

                // Query para buscar informações no banco de dados
                $sql = "SELECT Nome, CPF, Email, Cargo, Habilidade FROM PESSOAS";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['Nome']}</td>
                                <td>{$row['CPF']}</td>
                                <td>{$row['Email']}</td>
                                <td>{$row['Cargo']}</td>
                                <td>{$row['Habilidade']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum registro encontrado.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
        <br><a href="sub_tela.html"><button>Voltar</button></a>
    </div>
</body>

</html>