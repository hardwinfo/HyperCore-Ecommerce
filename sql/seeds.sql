USE hypercore_db;

-- =====================================
-- CATEGORIAS
-- =====================================

INSERT INTO categorias (nome) VALUES
('Processadores'),
('Placa-mãe'),
('Placa de vídeo'),
('SSDs'),
('Monitores'),
('Headsets'),
('Teclados'),
('Mouse'),
('Fontes');

-- =====================================
-- PRODUTOS
-- =====================================

INSERT INTO produtos
(nome, descricao, preco, estoque, imagem, categoria_id)
VALUES

(
'Ryzen 7 7800X3D',
'Processador AMD Ryzen 7 para alta performance gamer.',
2899.90,
10,
'ryzen7800x3d.jpg',
1
),

(
'RTX 4070 Ti',
'Placa de vídeo NVIDIA RTX 4070 Ti 12GB.',
5499.90,
6,
'rtx4070ti.jpg',
3
),

(
'SSD Kingston NV2 1TB',
'SSD NVMe PCIe 4.0 de alta velocidade.',
499.90,
20,
'ssdkingston.jpg',
4
),

(
'Monitor Gamer 27 165Hz',
'Monitor gamer Full HD 165Hz IPS.',
1399.90,
8,
'monitor27.jpg',
5
),

(
'Headset HyperX Cloud II',
'Headset gamer com áudio surround.',
349.90,
15,
'cloud2.jpg',
6
),

(
'Teclado Redragon Kumara',
'Teclado mecânico RGB switch blue.',
229.90,
12,
'kumara.jpg',
7
),

(
'Mouse Logitech G403',
'Mouse gamer ergonômico RGB.',
189.90,
18,
'g403.jpg',
8
),

(
'Fonte Corsair 750W',
'Fonte 80 Plus Bronze 750W.',
599.90,
9,
'corsair750.jpg',
9
);

-- =====================================
-- CLIENTE TESTE
-- senha: 123456
-- =====================================

INSERT INTO clientes
(nome, email, senha)
VALUES
(
'Cliente Teste',
'cliente@hypercore.com',
'123456'
);

-- =====================================
-- USUARIO ADMIN
-- senha: admin123
-- =====================================

INSERT INTO usuarios
(nome, email, senha, perfil)
VALUES
(
'Administrador',
'admin@hypercore.com',
'admin123',
'ADMIN'
);

-- =====================================
-- CUPOM
-- =====================================

INSERT INTO cupons
(codigo, tipo, valor, validade)
VALUES
(
'PROMO10',
'PERCENTUAL',
10,
'2026-12-31'
);