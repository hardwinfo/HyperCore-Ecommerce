<?php

session_start();

require_once("../config/database.php");

/*
|--------------------------------------------------------------------------
| VERIFICAR LOGIN
|--------------------------------------------------------------------------
*/

if(!isset($_SESSION['cliente']))
{
    header("Location: login.php");

    exit;
}

/*
|--------------------------------------------------------------------------
| RECEBER DADOS
|--------------------------------------------------------------------------
*/

$produto_id = $_POST['produto_id'];

$cliente_id = $_SESSION['cliente']['id'];

$nota = $_POST['nota'];

$comentario = $_POST['comentario'];

/*
|--------------------------------------------------------------------------
| INSERIR AVALIAÇÃO
|--------------------------------------------------------------------------
*/

$sql = "INSERT INTO avaliacoes
(produto_id, cliente_id, nota, comentario)
VALUES (?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $produto_id,
    $cliente_id,
    $nota,
    $comentario
]);

/*
|--------------------------------------------------------------------------
| VOLTAR PARA PRODUTO
|--------------------------------------------------------------------------
*/

header(
    "Location: product.php?id=".$produto_id
);

exit;

?>