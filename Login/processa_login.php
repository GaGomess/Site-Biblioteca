<?php
session_start();

// Verifica se o formulário de login foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    try {
        // Conexão com o banco de dados
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=tcc', 'root', '');

        // Consulta o banco de dados para verificar o email e senha
        $stmt = $dbh->prepare("SELECT idConta, senha FROM conta WHERE email = :email AND senha = :senha");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR); // Senha em texto simples

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            // Usuário não encontrado
            header("Location: login.html?message=Email ou senha incorretos.");
            exit();
        } else {
            // Senha correta, o login é bem-sucedido
            // Configure a sessão com o ID do usuário
            $_SESSION['user_id'] = $user['idConta'];

            echo '<script>';
            echo 'localStorage.setItem("email", "' . $user['email'] . '");';
            echo '</script>';

            header("Location: ../home/pgInicial.html");
            
            exit();
        }
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}
?>
