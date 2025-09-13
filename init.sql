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
    cpf VARCHAR(14) NOT NULL,
    cod VARCHAR(6) NOT NULL,
    created_at DATETIME NOT NULL,
    expires_at DATETIME NOT NULL
);


CREATE TABLE IF NOT EXISTS  tb_employee(
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
);



INSERT INTO tb_employee (name, cpf, position, sector, admission_date, wage, address, telephone, email, photo) VALUES
('Ana Silva', '000.000.000-00', 'Gerente', 'Financeiro', '2020-01-15', 5500.00, 'Rua A, 123', '(11) 95204-1574', 'ana.silva@email.com', NULL),
('Bruno Costa', '222.222.222-22', 'Analista', 'TI', '2019-03-10', 4200.50, 'Rua B, 456', '(11) 95204-1575', 'bruno.costa@email.com', NULL),
('Carla Mendes', '333.333.333-33', 'Coordenadora', 'Marketing', '2021-06-20', 4800.75, 'Rua C, 789', '(11) 95204-1576', 'carla.mendes@email.com', NULL);


-- Insere dados
INSERT INTO tb_user (cpf, nome, email, password) VALUES
('00000000000', 'Davi', 'davifreitaz999@gmail.com','$2y$10$IBragyXdt1I46eRh5gLw1.n2J7phP6.80DDlClcvA898aX97RJBrS');
