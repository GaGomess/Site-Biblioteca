    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        

            .content {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }

            .row {
                display: flex;
                justify-content: space-around;
                width: 100%;
            }

            .livro {
                background-color: white;
                border: 1px solid #ddd;
                border-radius: 5px;
                margin: 10px;
                padding: 10px;
                width: 300px;
                display: flex; /* Para alinhar os elementos verticalmente */
                flex-direction: column; /* Para empilhar os elementos verticalmente */
                align-items: center; /* Alinhar os elementos centralmente */
                text-align: center; /* Centralizar o texto */
            }

            .livro img {
                text-align: center; /* Centraliza horizontalmente */
                max-width: 100%;
                height: auto;
                margin-top: 10px; /* Adicione espaço acima da imagem */
            }

            h1 {
                font-size: 20px;
                margin: 10px 0;
                /* Defina o tamanho máximo e permita a quebra de linha */
                max-width: 100%;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                word-wrap: break-word;
            }
        </style>
    </head>

    <body>
        <div class="content">
            <?php
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "tcc";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexão falhou: " . $conn->connect_error);
            }

            $sql = "SELECT livro.idLivro, livro.Nome, livro.img 
            FROM favoritos
            JOIN livro ON favoritos.idLivro = livro.idLivro
            WHERE favoritos.favoritado = 1";

            $result = $conn->query($sql);

            $counter = 0;

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($counter % 3 == 0) {
                        echo '<div class="row">';
                    }

                    echo '<div class="livro">';
                    echo '<h1>' . $row['Nome'] . '</h1>';
                    echo '<img src="' . $row['img'] . '" alt="' . $row['Nome'] . '" data-key="' . $row['idLivro'] . '">';
                    echo '</div>';

                    $counter++;

                    if ($counter % 3 == 0) {
                        echo '</div>';
                    }
                }

                if ($counter % 3 != 0) {
                    echo '</div>';
                }
            } else {
                echo "Nenhum livro favoritado encontrado.";
            }

            $conn->close();
            ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript">
            // Manipule o clique nas imagens do carrossel
            $(document).on('click', '.livro img', function() {
                // Obtenha o idLivro a partir do atributo data-key
                var livroId = $(this).data('key');

                // Redirecione para outra página com as informações do livro
                window.location.href = '../home/pagina_livro.php?key=' + livroId;
            });
        </script>
    </body>

    </html>