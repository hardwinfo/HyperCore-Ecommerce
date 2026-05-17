<?php

require_once("../config/database.php");

$id = $_GET['id'];

$sql = "SELECT * FROM produtos WHERE id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

$produto = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>
        <?= $produto['nome'] ?>
    </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body style="background-color:#111; color:white;">

<div class="container mt-5">

    <a href="index.php" class="btn btn-outline-info mb-4">
        Voltar
    </a>

    <div class="card bg-dark text-white p-4">

        <h1 class="text-info">
            <?= $produto['nome'] ?>
        </h1>

        <hr>

        <p>
            <?= $produto['descricao'] ?>
        </p>

        <h3 class="mt-4">
            R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
        </h3>

        <p class="mt-3">
            Estoque:
            <?= $produto['estoque'] ?>
        </p>

        <a
    href="add_cart.php?id=<?= $produto['id'] ?>"
    class="btn btn-info mt-3"
>

    Adicionar ao Carrinho

</a>

    </div>

</div>

</body>
</html>