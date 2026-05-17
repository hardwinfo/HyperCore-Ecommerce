<?php

session_start();

require_once("../config/database.php");

if(!isset($_SESSION['cliente']))
{
    header("Location: login.php");

    exit;
}

$cart = isset($_SESSION['cart'])
    ? $_SESSION['cart']
    : [];

$total = 0;

$frete = 0;

$desconto = isset($_SESSION['desconto'])
    ? $_SESSION['desconto']
    : 0;

/*
|--------------------------------------------------------------------------
| CALCULAR TOTAL
|--------------------------------------------------------------------------
*/

foreach($cart as $id => $quantidade)
{
    $sql = "SELECT * FROM produtos WHERE id = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([$id]);

    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    $total +=
        $produto['preco'] * $quantidade;
}

/*
|--------------------------------------------------------------------------
| CALCULAR FRETE
|--------------------------------------------------------------------------
*/

if($total >= 500)
{
    $frete = 0;
}
else
{
    $frete = 25;
}

/*
|--------------------------------------------------------------------------
| TOTAL FINAL
|--------------------------------------------------------------------------
*/

$total_final =
    $total - $desconto + $frete;

/*
|--------------------------------------------------------------------------
| FINALIZAR PEDIDO
|--------------------------------------------------------------------------
*/

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $cliente_id =
        $_SESSION['cliente']['id'];

    $subtotal = $total;

    /*
    |--------------------------------------------------------------------------
    | INSERIR PEDIDO
    |--------------------------------------------------------------------------
    */

    $sql = "INSERT INTO pedidos
    (
        cliente_id,
        subtotal,
        desconto,
        frete,
        total
    )
    VALUES
    (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $cliente_id,
        $subtotal,
        $desconto,
        $frete,
        $total_final
    ]);

    $pedido_id = $pdo->lastInsertId();

    /*
    |--------------------------------------------------------------------------
    | INSERIR ITENS
    |--------------------------------------------------------------------------
    */

    foreach($cart as $id => $quantidade)
    {
        $sql =
            "SELECT * FROM produtos WHERE id = ?";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([$id]);

        $produto =
            $stmt->fetch(PDO::FETCH_ASSOC);

        /*
        |--------------------------------------------------------------------------
        | ITEM DO PEDIDO
        |--------------------------------------------------------------------------
        */

        $sql = "INSERT INTO pedido_itens
        (
            pedido_id,
            produto_id,
            quantidade,
            preco_unitario
        )
        VALUES
        (?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $pedido_id,
            $id,
            $quantidade,
            $produto['preco']
        ]);

        /*
        |--------------------------------------------------------------------------
        | ATUALIZAR ESTOQUE
        |--------------------------------------------------------------------------
        */

        $novo_estoque =
            $produto['estoque'] - $quantidade;

        $sql = "UPDATE produtos
        SET estoque = ?
        WHERE id = ?";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $novo_estoque,
            $id
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | LIMPAR SESSÃO
    |--------------------------------------------------------------------------
    */

    unset($_SESSION['cart']);

    unset($_SESSION['desconto']);

    unset($_SESSION['cupom']);

    $cart = [];

    $sucesso = true;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>
        Checkout - HyperCore
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body style="background-color:#111; color:white;">

<div class="container mt-5">

    <h1 class="text-info mb-4">
        Checkout
    </h1>

    <?php if(isset($sucesso)): ?>

        <div class="alert alert-success">

            <h4>
                Pedido realizado com sucesso!
            </h4>

            <p class="mt-3">
                Seu pedido foi registrado no sistema.
            </p>

            <div class="mt-4">

                <a
                    href="orders.php"
                    class="btn btn-dark me-2"
                >
                    Ver meus pedidos
                </a>

                <a
                    href="index.php"
                    class="btn btn-success"
                >
                    Voltar para loja
                </a>

            </div>

        </div>

    <?php endif; ?>

    <?php if(empty($cart)): ?>

        <div class="alert alert-danger">

            Seu carrinho está vazio.

        </div>

    <?php else: ?>

        <?php foreach($cart as $id => $quantidade): ?>

            <?php

            $sql =
                "SELECT * FROM produtos WHERE id = ?";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([$id]);

            $produto =
                $stmt->fetch(PDO::FETCH_ASSOC);

            $subtotal =
                $produto['preco'] * $quantidade;

            ?>

            <div class="card bg-dark text-white p-4 mb-3">

                <h4>
                    <?= $produto['nome'] ?>
                </h4>

                <p>
                    Quantidade:
                    <?= $quantidade ?>
                </p>

                <p>
                    Subtotal:
                    R$ <?= number_format(
                        $subtotal,
                        2,
                        ',',
                        '.'
                    ) ?>
                </p>

            </div>

        <?php endforeach; ?>

        <div class="card bg-info text-dark p-4">

            <h4>
                Subtotal:
                R$ <?= number_format(
                    $total,
                    2,
                    ',',
                    '.'
                ) ?>
            </h4>

            <?php if($desconto > 0): ?>

                <h5 class="text-success mt-3">

                    Desconto:
                    - R$ <?= number_format(
                        $desconto,
                        2,
                        ',',
                        '.'
                    ) ?>

                </h5>

            <?php endif; ?>

            <h5 class="mt-3">

                Frete:

                <?php if($frete == 0): ?>

                    <span class="text-success">
                        GRÁTIS
                    </span>

                <?php else: ?>

                    R$ <?= number_format(
                        $frete,
                        2,
                        ',',
                        '.'
                    ) ?>

                <?php endif; ?>

            </h5>

            <h2 class="mt-4">

                Total Final:
                R$ <?= number_format(
                    $total_final,
                    2,
                    ',',
                    '.'
                ) ?>

            </h2>

            <form method="POST">

                <button
                    class="btn btn-dark mt-4"
                >
                    Confirmar Compra
                </button>

            </form>

        </div>

    <?php endif; ?>

</div>

</body>
</html>