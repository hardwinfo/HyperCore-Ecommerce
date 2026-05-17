<?php

session_start();

require_once("../config/database.php");

if(!isset($_SESSION['cliente']))
{
    header("Location: login.php");

    exit;
}

$cliente_id = $_SESSION['cliente']['id'];

$sql = "SELECT * FROM pedidos
WHERE cliente_id = ?
ORDER BY id DESC";

$stmt = $pdo->prepare($sql);

$stmt->execute([$cliente_id]);

$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>
        Meus Pedidos - HyperCore
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body style="background-color:#111; color:white;">

<div class="container mt-5">

    <!-- TOPO -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="text-info">

            Meus Pedidos

        </h1>

        <a
            href="index.php"
            class="btn btn-outline-info"
        >
            Voltar para Loja
        </a>

    </div>

    <!-- SEM PEDIDOS -->

    <?php if(empty($pedidos)): ?>

        <div class="alert alert-danger">

            Nenhum pedido encontrado.

        </div>

    <?php else: ?>

        <!-- LISTA -->

        <?php foreach($pedidos as $pedido): ?>

            <div class="card bg-dark text-white border border-secondary p-4 mb-4">

                <!-- CABEÇALHO -->

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h4 class="text-info">

                        Pedido #<?= $pedido['id'] ?>

                    </h4>

                    <!-- STATUS -->

                    <?php if($pedido['status'] == 'NOVO'): ?>

                        <span class="badge bg-warning text-dark fs-6">

                            NOVO

                        </span>

                    <?php elseif($pedido['status'] == 'PROCESSANDO'): ?>

                        <span class="badge bg-primary fs-6">

                            PROCESSANDO

                        </span>

                    <?php elseif($pedido['status'] == 'ENVIADO'): ?>

                        <span class="badge bg-success fs-6">

                            ENVIADO

                        </span>

                    <?php else: ?>

                        <span class="badge bg-secondary fs-6">

                            <?= $pedido['status'] ?>

                        </span>

                    <?php endif; ?>

                </div>

                <!-- INFORMAÇÕES -->

                <div class="row">

                    <div class="col-md-3 mb-3">

                        <strong>
                            Subtotal:
                        </strong>

                        <br>

                        R$ <?= number_format(
                            $pedido['subtotal'],
                            2,
                            ',',
                            '.'
                        ) ?>

                    </div>

                    <div class="col-md-3 mb-3">

                        <strong>
                            Desconto:
                        </strong>

                        <br>

                        R$ <?= number_format(
                            $pedido['desconto'],
                            2,
                            ',',
                            '.'
                        ) ?>

                    </div>

                    <div class="col-md-3 mb-3">

                        <strong>
                            Frete:
                        </strong>

                        <br>

                        R$ <?= number_format(
                            $pedido['frete'],
                            2,
                            ',',
                            '.'
                        ) ?>

                    </div>

                    <div class="col-md-3 mb-3">

                        <strong class="text-info">
                            Total:
                        </strong>

                        <br>

                        <span class="fs-5 fw-bold text-info">

                            R$ <?= number_format(
                                $pedido['total'],
                                2,
                                ',',
                                '.'
                            ) ?>

                        </span>

                    </div>

                </div>

                <!-- DATA -->

                <hr class="border-secondary">

                <p class="mb-0 text-light">

                    Pedido realizado em:
                    <?= date(
                        'd/m/Y H:i',
                        strtotime($pedido['criado_em'])
                    ) ?>

                </p>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

</div>

</body>
</html>