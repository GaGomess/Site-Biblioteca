<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="slider.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
</head>
<body>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "tcc";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para obter todos os gêneros
$sql = "SELECT DISTINCT genero FROM livro";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $genero = $row['genero'];
        // Crie uma seção para cada gênero
                echo '<div class="Genero">';
        echo '<center><h1>' . $genero . '</h1></center></div>';

        // Consulta para obter os livros desse gênero
        $livros_sql = "SELECT * FROM livro WHERE genero = '$genero'";
        $livros_result = $conn->query($livros_sql);

        if ($livros_result->num_rows > 0) {
            echo '<div class="slider">';
            echo '<div class="carousel">';
            while ($livro = $livros_result->fetch_assoc()) {
                // Adicione um atributo de dados (data attribute) para armazenar o idLivro
                echo '<div class="item">';
                echo '<img src="' . $livro['img'] . '" data-key="' . $livro['idLivro'] . '">';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        }
    }
} else {
    echo "Nenhum gênero encontrado.";
}

$conn->close();
?>

<script type="text/javascript">
    $(document).ready(function(){
    // Inicialize o carrossel
    $('.carousel').slick({
        slidesToShow: 6, // Número de slides visíveis
        slidesToScroll: 6, // Número de slides para avançar/retroceder
        arrows: false, // Remova as setas de navegação
        infinite: true // Impede rolagem infinita
    });

    // Manipule o clique nas imagens do carrossel
    $('.carousel').on('click', '.item img', function() {
        // Obtenha o idLivro a partir do atributo data-key
        var livroKey = $(this).data('key');

        // Redirecione para outra página com as informações do livro
        window.location.href = 'pagina_livro.php?key=' + livroKey;
    });
});

</script>
<div style="text-align: center;">
            <h4><a href="politicas.html" onclick="politicas()">Política de Privacidade.</a></h4>
        </div>
</body>
</html>
