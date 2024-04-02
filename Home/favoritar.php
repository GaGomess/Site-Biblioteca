<?php



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

if (isset($_GET['livroKey']) && isset($_GET['action'])) {
    $livroKey = $_GET['livroKey'];
    $action = $_GET['action'];

    if ($action === 'favoritar') {
        // Verifique se o livro já está favoritado
        $favoritoQuery = "SELECT * FROM favoritos WHERE idLivro = '$livroKey'";
        $favoritoResult = $conn->query($favoritoQuery);

        if ($favoritoResult->num_rows === 0) {
            // Se não estiver favoritado, favoritar o livro
            $insertQuery = "INSERT INTO favoritos (favoritado, idLivro) VALUES (1, '$livroKey')";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->execute();
            echo 'Desfavoritar';
        } else {
            echo 'Desfavoritar'; // Se já estiver favoritado, mantenha o estado
        }
    } elseif ($action === 'desfavoritar') {
        // Remova a condição do bloco 'else'
        // Desfavoritar o livro
        $deleteQuery = "DELETE FROM favoritos WHERE idLivro = '$livroKey'";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->execute();
        echo 'Favoritar';
    } else {
        echo 'Ação desconhecida.';
    }
} else {
    echo 'Parâmetros inválidos.';
}

$conn->close();
?>