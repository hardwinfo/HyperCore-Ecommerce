<?php

require_once("../config/database.php");
session_start();

/*
|--------------------------------------------------------------------------
| BUSCA
|--------------------------------------------------------------------------
*/

$sql = "SELECT * FROM produtos";

if(isset($_GET['busca']) && !empty($_GET['busca']))
{
    $busca = $_GET['busca'];

    $sql = "SELECT * FROM produtos
            WHERE nome LIKE :busca";
}

$stmt = $pdo->prepare($sql);

if(isset($busca))
{
    $stmt->bindValue(
        ":busca",
        "%".$busca."%"
    );
}

$stmt->execute();

$produtos =
    $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>
        HyperCore
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body style="background-color:#111; color:white;">

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">

    <div class="container">

        <!-- LOGO -->

        <a
            class="navbar-brand text-info fw-bold"
            href="index.php"
        >
            HyperCore
        </a>

        <!-- BOTÃO MOBILE -->

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menu"
        >

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- MENU -->

        <div
            class="collapse navbar-collapse"
            id="menu"
        >

            <!-- DIREITA -->

            <div class="ms-auto d-flex align-items-center">

                <!-- BUSCA -->

                <form
                    method="GET"
                    class="d-flex me-3"
                >

                    <input
                        class="form-control me-2"
                        type="search"
                        name="busca"
                        placeholder="Buscar produtos"
                    >

                    <button class="btn btn-info">

                        Buscar

                    </button>

                </form>

                <!-- LOGIN -->

                <?php if(isset($_SESSION['cliente'])): ?>

    <span class="text-light me-3">

        Olá,
        <?= $_SESSION['cliente']['nome'] ?>

    </span>

    <a
        href="orders.php"
        class="btn btn-outline-info me-2"
    >
        Meus Pedidos
    </a>

    <a
        href="logout.php"
        class="btn btn-outline-danger me-2"
    >
        Sair
    </a>

<?php else: ?>

    <a
        href="login.php"
        class="btn btn-outline-light me-2"
    >
        Login
    </a>

<?php endif; ?>

<a
    href="cart.php"
    class="btn btn-info"
>
    Carrinho
</a>

            </div>

        </div>

    </div>

</nav>

<!-- CONTEÚDO -->
<section class="bg-dark border-bottom border-secondary py-5">

    <div class="container text-center">

        <h1 class="display-4 text-info fw-bold">

            Hardware Gamer de Alta Performance

        </h1>

        <p class="lead text-light mt-3">

            Os melhores componentes para elevar seu setup ao próximo nível.

        </p>

        <a
            href="#produtos"
            class="btn btn-info btn-lg mt-3"
        >
            Ver Produtos
        </a>

    </div>

</section>

<div
    class="container mt-5"
    id="produtos"
>

    

    <div class="row">

        <?php foreach($produtos as $produto): ?>

            <div class="col-md-3 mb-4">

                <div class="card bg-dark text-white h-100 border border-secondary">

                    <!-- IMAGEM -->

                    <?php if(!empty($produto['imagem'])): ?>

                        <img
                            src="images/<?= $produto['imagem'] ?>"
                            class="card-img-top"
                            style="
                                height:220px;
                                object-fit:cover;
                            "
                        >

                    <?php endif; ?>

                    <!-- CARD BODY -->

                    <div class="card-body d-flex flex-column">

                        <h5 class="text-info">

                            <?= $produto['nome'] ?>

                        </h5>

                        <p class="small">

                            <?= substr(
                                $produto['descricao'],
                                0,
                                80
                            ) ?>...

                        </p>

                        <p class="fw-bold fs-5">

                            R$ <?= number_format(
                                $produto['preco'],
                                2,
                                ',',
                                '.'
                            ) ?>

                        </p>

                        <p>

                            Estoque:
                            <?= $produto['estoque'] ?>

                        </p>

                        <div class="mt-auto">

                            <!-- VER PRODUTO -->

                            <a
                                href="product.php?id=<?= $produto['id'] ?>"
                                class="btn btn-outline-info w-100 mb-2"
                            >
                                Ver Produto
                            </a>

                            <!-- ADICIONAR CARRINHO -->

                            <a
                                href="add_cart.php?id=<?= $produto['id'] ?>"
                                class="btn btn-info w-100"
                            >
                                Adicionar ao Carrinho
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<footer
    class="bg-dark border-top border-secondary text-center text-light p-4 mt-5"
>

    <p class="mb-1">

        HyperCore © 2026

    </p>

    <small class="text-secondary">

        Hardware Gamer • Performance • Tecnologia

    </small>

</footer>

</body>
</html>