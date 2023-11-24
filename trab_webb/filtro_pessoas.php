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

        #botao-sair {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
        }

        #botao-sair:hover {
            background-color: #0056b3;
        }

        .filtro-form {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .filtro-form select,
        .filtro-form input {
            flex: 1;
            margin-right: 10px;
            padding: 8px;
            box-sizing: border-box;
        }

        .filtro-form button {
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .filtro-form button:hover {
            background-color: #2980b9;
        }
    </style>
    <title>Area Filtros</title>
</head>

<body>
    <div class="formulario">
        <h1>Filtrar por:</h1>
        
        <!-- Formulário de Filtro -->
        <form class="filtro-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <select name="filtro">
                <option value="Nome">Nome</option>
                <option value="CPF">CPF</option>
                <option value="Email">Email</option>
                <option value="Cargo">Cargo</option>
            </select>
            <input type="text" name="buscar" placeholder="Digite o que quer buscar:">
            <button type="submit">Filtrar</button>
        </form>

        <!-- Tabela de Resultados -->
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

                // processar o formulário de filtro
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $filtro = $_POST["filtro"];
                    $buscar = $_POST["buscar"];

                    // query com base no filtro e termo de busca
                    $sql = "SELECT Nome, CPF, Email, Cargo, Habilidade FROM PESSOAS WHERE $filtro LIKE '%$buscar%'";
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
                }

                $conn->close();
                ?>
            </tbody>
        </table>
        <br><a id="botao-sair" href="sub_tela.html">Voltar</a>
    </div>
</body>

</html>
