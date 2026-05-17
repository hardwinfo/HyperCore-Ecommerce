CREATE DATABASE IF NOT EXISTS hypercore_db;
USE hypercore_db;

-- =====================================
-- TABELA CLIENTES
-- =====================================

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================================
-- TABELA CATEGORIAS
-- =====================================

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- =====================================
-- TABELA PRODUTOS
-- =====================================

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL DEFAULT 0,
    imagem VARCHAR(255),
    categoria_id INT NOT NULL,

    FOREIGN KEY (categoria_id)
    REFERENCES categorias(id)
);

-- =====================================
-- TABELA PEDIDOS
-- =====================================

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,

    subtotal DECIMAL(10,2) NOT NULL,
    desconto DECIMAL(10,2) DEFAULT 0,
    frete DECIMAL(10,2) DEFAULT 0,
    total DECIMAL(10,2) NOT NULL,

    status ENUM(
        'NOVO',
        'PROCESSANDO',
        'ENVIADO',
        'ENTREGUE',
        'CANCELADO'
    ) DEFAULT 'NOVO',

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (cliente_id)
    REFERENCES clientes(id)
);

-- =====================================
-- TABELA PEDIDO_ITENS
-- =====================================

CREATE TABLE pedido_itens (
    id INT AUTO_INCREMENT PRIMARY KEY,

    pedido_id INT NOT NULL,
    produto_id INT NOT NULL,

    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,

    FOREIGN KEY (pedido_id)
    REFERENCES pedidos(id),

    FOREIGN KEY (produto_id)
    REFERENCES produtos(id)
);

-- =====================================
-- TABELA USUARIOS
-- =====================================

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,

    nome VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    senha VARCHAR(255),

    perfil ENUM(
        'ADMIN',
        'ESTOQUE',
        'FINANCEIRO'
    ) DEFAULT 'ESTOQUE'
);

-- =====================================
-- TABELA AVALIACOES
-- =====================================

CREATE TABLE avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,

    produto_id INT NOT NULL,
    cliente_id INT NOT NULL,

    nota INT NOT NULL,
    comentario TEXT,

    aprovado BOOLEAN DEFAULT FALSE,

    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (produto_id)
    REFERENCES produtos(id),

    FOREIGN KEY (cliente_id)
    REFERENCES clientes(id)
);

-- =====================================
-- TABELA CUPONS
-- =====================================

CREATE TABLE cupons (
    id INT AUTO_INCREMENT PRIMARY KEY,

    codigo VARCHAR(50) NOT NULL UNIQUE,

    tipo ENUM(
        'PERCENTUAL',
        'FIXO'
    ) NOT NULL,

    valor DECIMAL(10,2) NOT NULL,

    validade DATE
);