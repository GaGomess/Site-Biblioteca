    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Informações do Livro</title>

        <style>
            body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .content {
            text-align: center;
            margin-top: 20px;
        }

        h1 {
            font-size: 24px;
            color: #333;
        }

        img {
            max-width: 300px;
            height: auto;
            margin: 10px auto; /* Configura a margem para centralizar a imagem */
}

        p {
            font-size: 18px;
            color: #666;
            text-align: center;
            margin: 10px 0;
        }

        .button-container {
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            width: 110px; /* Tamanho padrão para largura */
            height: 40px; /* Tamanho padrão para altura */
            background-color: #531053;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #message {
            display: none;
        }
    </style>
    </head>

    <body>
        <div class="content">
        <?php
            // Função para conectar ao banco de dados
            function conectarBanco()
            {
                $servername = "127.0.0.1";
                $username = "root";
                $password = "";
                $dbname = "tcc";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Conexão falhou: " . $conn->connect_error);
                }

                return $conn;
            }

            $conn = conectarBanco();

            if (isset($_GET['key'])) {
                $livroKey = $_GET['key'];

                $sql = "SELECT * FROM livro WHERE idLivro = '$livroKey'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $livro = $result->fetch_assoc();

                    $nomeLivro = $livro['Nome'];
                    $imgLivro = $livro['img'];
                    $autorLivro = $livro['Autor'];
                    $anoLancamentoLivro = $livro['AnoLanc'];
                    $generoLivro = $livro['Genero'];

                    // Verifique se o livro está favoritado
                    $favoritado = false;
                    $favoritoQuery = "SELECT * FROM favoritos WHERE idLivro = '$livroKey'";
                    $favoritoResult = $conn->query($favoritoQuery);
                    if ($favoritoResult->num_rows > 0) {
                        $favoritado = true;
                    }
                    ?>
                    <h1><?php echo $nomeLivro; ?></h1>
                    <img src="<?php echo $imgLivro; ?>" alt="<?php echo $nomeLivro; ?>">
                    <p>Autor: <?php echo $autorLivro; ?></p>
                    <p>Ano de Lançamento: <?php echo $anoLancamentoLivro; ?></p>
                    <p>Gênero: <?php echo $generoLivro; ?></p>

                    <div class="button-container">
                        <?php
                        // Verifica se a URL do leitor está disponível
                        if ($livro['Leitor'] !== null) {
                            echo '<button onclick="redirectToLeitor(\'' . $livroKey . '\')">Ler</button>';
                        } else {
                            echo '<button onclick="showMessage(\'' . $livroKey . '\')">Em Breve</button>';
                        }
                        ?>

                        <button id="favoritarBtn" onclick="toggleFavorito('<?php echo $livroKey; ?>', <?php echo $favoritado ? 'true' : 'false'; ?>)">
                            <?php echo $favoritado ? 'Desfavoritar' : 'Favoritar'; ?>
                        </button>
                    </div>

                    <?php
                } else {
                    echo "Livro não encontrado.";
                }
            }


            $conn->close();
            ?>
        </div>

        <script>
            // Função JavaScript para alternar entre favoritar e desfavoritar
            function toggleFavorito(livro, favoritado) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Atualize o texto do botão para refletir o estado atual
                        document.getElementById("favoritarBtn").innerHTML = this.responseText;
                    }
                };

                var action = favoritado ? 'desfavoritar' : 'favoritar';
                // Envie a solicitação para o arquivo PHP responsável por favoritar/desfavoritar
                xhttp.open("GET", "favoritar.php?livroKey=" + livro + "&action=" + action, true);
                xhttp.send();
            }
            </script>

            <script>
            function redirectToLeitor(livro) {
                // Redireciona para a URL do leitor
                window.location.href = '<?php echo $livro["Leitor"]; ?>';
            }

            function showMessage(Livro) {
                alert("Em breve, este livro estará disponível");
            }

        </script>
    </body>

    </html>