-- Criar o banco de dados
CREATE DATABASE IF NOT EXISTS ace_banco
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Selecionar o banco
USE ace_banco;

-- Criar a tabela de contatos
CREATE TABLE IF NOT EXISTS contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    assunto VARCHAR(100) NOT NULL,
    mensagem TEXT NOT NULL,
    data_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);