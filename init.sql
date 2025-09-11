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
('Ana Silva', '11111111111', 'Gerente', 'Financeiro', '2020-01-15', 5500.00, 'Rua A, 123', '11999990001', 'ana.silva@email.com', NULL),
('Bruno Costa', '22222222222', 'Analista', 'TI', '2019-03-10', 4200.50, 'Rua B, 456', '11999990002', 'bruno.costa@email.com', NULL),
('Carla Mendes', '33333333333', 'Coordenadora', 'Marketing', '2021-06-20', 4800.75, 'Rua C, 789', '11999990003', 'carla.mendes@email.com', NULL),
('Daniel Souza', '44444444444', 'Assistente', 'RH', '2018-11-05', 3200.00, 'Rua D, 101', '11999990004', 'daniel.souza@email.com', NULL),
('Eduardo Lima', '55555555555', 'Desenvolvedor', 'TI', '2022-02-18', 4500.00, 'Rua E, 202', '11999990005', 'eduardo.lima@email.com', NULL),
('Fernanda Rocha', '66666666666', 'Analista', 'Financeiro', '2019-08-12', 4300.00, 'Rua F, 303', '11999990006', 'fernanda.rocha@email.com', NULL),
('Gabriel Alves', '77777777777', 'Estagiário', 'Marketing', '2023-01-02', 1800.00, 'Rua G, 404', '11999990007', 'gabriel.alves@email.com', NULL),
('Helena Martins', '88888888888', 'Gerente', 'RH', '2020-05-22', 5700.00, 'Rua H, 505', '11999990008', 'helena.martins@email.com', NULL),
('Igor Pereira', '99999999999', 'Desenvolvedor', 'TI', '2021-09-14', 4600.00, 'Rua I, 606', '11999990009', 'igor.pereira@email.com', NULL),
('Juliana Santos', '10101010101', 'Coordenadora', 'Financeiro', '2018-12-30', 5000.00, 'Rua J, 707', '11999990010', 'juliana.santos@email.com', NULL);

-- Insere dados
INSERT INTO tb_user (cpf, nome, email, password) VALUES
('00000000000', 'Davi', 'davifreitaz999@gmail.com', SHA2('12345678', 256));
