<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="../Imagens/iconeBranco.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Pesquisa</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="pesquisa.css">

</head>

<body>
    <div class="navbar" id="navbar">
        <a href="../Home/pgInicial.html" class="logo"><img src="../Imagens/IconeBranco.png" alt="Logo"></a>
        <a href="../Favorito/index.html">Favoritos</a>
        <a href="../Sobre/sobre.html">Sobre Nós</a>

        <div class="barra-pesquisa-container">
            <form action="pesquisa.php" method="GET">
                <input type="text" name="nome_livro" size="50" placeholder="Pesquise por livro, autor, categoria...">
                <button type="submit">Pesquisar</button>
            </form>
        </div>
    </div>

    <div class="content">
        <?php
        // Verifica se o parâmetro 'nome_livro' foi fornecido na URL
        if (!isset($_GET['nome_livro'])) {
            // Se não foi fornecido, redireciona o usuário para 'index.html'
            header("Location: index.html");
            exit;
        }

        // Prepara o termo de pesquisa para consulta no banco de dados
        $termo_pesquisa = "%" . trim($_GET['nome_livro']) . "%";

        // Conexão com o banco de dados (ajuste as configurações de acordo com o seu ambiente)
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=tcc', 'root', '');

        // Prepara a consulta SQL para buscar na tabela 'livro' onde o Nome, Autor ou Gênero correspondem ao termo de pesquisa
        $sth = $dbh->prepare("SELECT * FROM livro WHERE Nome LIKE :termo_pesquisa OR Autor LIKE :termo_pesquisa OR Genero LIKE :termo_pesquisa");
        $sth->bindParam(':termo_pesquisa', $termo_pesquisa, PDO::PARAM_STR);
        $sth->execute();

        // Obtém os resultados da consulta
        $resultados = $sth->fetchAll(PDO::FETCH_ASSOC);

        // Verifica se foram encontrados resultados
        if (count($resultados)) {
            echo '<div class="resultados">';
            foreach ($resultados as $resultado) {
                echo '<div class="livro">';
                echo '<label><center><strong> ' . $resultado['Nome'] . '</strong></center></label><br>';
                echo '<img src="' . $resultado['img'] . '" alt="Capa do Livro">';
                echo '<label><strong>Gênero:</strong> ' . $resultado['Genero'] . '</label><br>';
                echo '<label><strong>Ano de Lançamento:</strong> ' . $resultado['AnoLanc'] . '</label><br>';
                echo '<label><strong>Autor:</strong> ' . $resultado['Autor'] . '</label><br>';

                // Verifica se o valor de 'Leitor' não é nulo
                if ($resultado['Leitor'] !== null) {
                    // Redireciona para a URL do leitor
                    echo '<a href="' . $resultado['Leitor'] . '" class="botao-leia">Leia Já</a>';
                } else {
                    // Se não houver URL do leitor, mostra uma mensagem
                    echo '<a href="javascript:void(0);" class="botao-leia" onclick="showMessage(\'' . $resultado['idLivro'] . '\')">Em Breve</a>';
                }

                echo '</div>';
            }
            echo '</div>';
        } else {
            // Se nenhum resultado for encontrado, exibe uma mensagem de nenhum resultado
            echo '<div class="nenhum-resultado">Não foram encontrados resultados pelo termo buscado.</div>';
        }
        
        ?>
    </div>

    <script>
        function showMessage(idLivro) {
            alert("Em breve, este livro estará disponível");
        }
    </script>
</body>

</html>
