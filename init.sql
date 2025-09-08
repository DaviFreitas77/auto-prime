-- Cria a tabela tb_user
CREATE TABLE IF NOT EXISTS tb_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(14) NOT NULL,
    nome VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(255)
);


CREATE TABLE IF NOT EXISTS password_reset(
    id INT AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(14) NOT NULL,
    cod VARCHAR(6),
    created_at DATETIME,
    expires_at DATETIME
);


-- Insere dados
INSERT INTO tb_user (cpf, nome, email, password) VALUES
('00000000000', 'Davi', 'davifreitaz999@gmail.com', SHA2('12345678', 256));
