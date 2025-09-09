-- Cria a tabela tb_user
CREATE TABLE IF NOT EXISTS tb_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(14) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS password_reset(
    id INT AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(14) NOT NULL NOT NULL,
    cod VARCHAR(6) NOT NULL,
    created_at DATETIME NOT NULL,
    expires_at DATETIME NOT NULL
);


CREATE TABLE  tb_employee(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    position VARCHAR(50) NOT NULL,
    sector VARCHAR(50) NOT NULL,
    admission_date DATE NOT NULL,
    wage DECIMAL(10,2) NOT NULL,
    address TEXT NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL,
    photo VARCHAR(255) 
)

-- Insere dados
INSERT INTO tb_user (cpf, nome, email, password) VALUES
('00000000000', 'Davi', 'davifreitaz999@gmail.com', SHA2('12345678', 256));
