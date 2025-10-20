<?php
// Inicia sessão e importa lógica de autenticação
session_start();
require_once 'autenticacao.php';

// Verifica se o usuário já está logado e redireciona se estiver
if (isset($_SESSION['usuario_id'])) {
    header('Location: principal.php');
    exit;
}

$erro = '';

// Processamento do formulário de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $senha = $_POST['senha'] ?? '';
    if ($login && $senha) {
        if (autenticar($login, $senha)) {
            // Se autenticado, redireciona para a página principal
            header('Location: principal.php');
            exit;
        } else {
            // Informa ao usuário sobre a falha
            $erro = 'Login ou senha inválidos.';
        }
    } else {
        $erro = 'Preencha todos os campos.';
    }
}
?>