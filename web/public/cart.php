<?php

session_start();

require_once("../config/database.php");

$cart = isset($_SESSION['cart'])
    ? $_SESSION['cart']
    : [];

$total = 0;

$desconto = 0;

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>
        Carrinho - HyperCore
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body style="background-color:#111; color:white;">

<div class="container mt-5">

    <h1 class="text-info mb-4">
        Meu Carrinho
    </h1>

    <?php if(empty($cart)): ?>

        <div class="card bg-dark text-white p-4">

            <p>
                Seu carrinho está vazio.
            </p>

        </div>

    <?php else: ?>

        <?php foreach($cart as $id => $quantidade): ?>

            <?php

            $sql = "SELECT * FROM produtos WHERE id = ?";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([$id]);

            $produto = $stmt->fetch(PDO::FETCH_ASSOC);

            $subtotal =
                $produto['preco'] * $quantidade;

            $total += $subtotal;

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
                    Preço:
                    R$ <?= number_format(
                        $produto['preco'],
                        2,
                        ',',
                        '.'
                    ) ?>
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

                <a
                    href="remove_cart.php?id=<?= $produto['id'] ?>"
                    class="btn btn-danger mt-2"
                >
                    Remover
                </a>

            </div>

        <?php endforeach; ?>

        <?php

        /*
        |--------------------------------------------------------------------------
        | CUPOM
        |--------------------------------------------------------------------------
        */

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(isset($_POST['cupom']))
            {
                $cupom = strtoupper(
                    trim($_POST['cupom'])
                );

                if($cupom == 'PROMO10')
{
    $desconto = $total * 0.10;

    $_SESSION['desconto'] = $desconto;

    $_SESSION['cupom'] = $cupom;
}
else
{
    $_SESSION['desconto'] = 0;

    unset($_SESSION['cupom']);
}
            }
        }

        $totalFinal = $total - $desconto;

        ?>

        <div class="card bg-info text-dark p-4">

            <form method="POST">

                <label class="mb-2">
                    Cupom de desconto
                </label>

                <div class="d-flex mb-4">

                    <input
                        type="text"
                        name="cupom"
                        class="form-control me-2"
                        placeholder="Digite o cupom"
                    >

                    <button
                        class="btn btn-dark"
                        type="submit"
                    >
                        Aplicar
                    </button>

                </div>

            </form>

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

                <h5 class="text-success">

                    Desconto:
                    - R$ <?= number_format(
                        $desconto,
                        2,
                        ',',
                        '.'
                    ) ?>

                </h5>

            <?php endif; ?>

            <h2 class="mt-3">

                Total Final:
                R$ <?= number_format(
                    $totalFinal,
                    2,
                    ',',
                    '.'
                ) ?>

            </h2>

            <a
                href="checkout.php"
                class="btn btn-dark mt-4"
            >
                Finalizar Compra
            </a>

        </div>

    <?php endif; ?>

    <a
        href="index.php"
        class="btn btn-outline-info mt-4"
    >
        Continuar comprando
    </a>

</div>

</body>
</html>