-- Cria a tabela tb_user
CREATE TABLE IF NOT EXISTS tb_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(14) NOT NULL,
    nome VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100)
);

-- Insere dados
INSERT INTO tb_user (cpf, nome, email, password) VALUES
('00000000000', 'Davi', 'davifreitaz999@gmail.com', SHA2('12345678', 256));
