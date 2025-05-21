
-- Tabela de Clientes
CREATE TABLE Cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    email VARCHAR(100),
    telefone VARCHAR(20),
    data_nascimento DATE,
    endereco TEXT
);

-- Tabela de Cartões
CREATE TABLE Cartao (
    id_cartao INT AUTO_INCREMENT PRIMARY KEY,
    numero_cartao VARCHAR(20) UNIQUE NOT NULL,
    validade DATE NOT NULL,
    codigo_seguranca VARCHAR(4) NOT NULL,
    tipo ENUM('Titular', 'Adicional') NOT NULL
);

-- Tabela Associativa: Relacionamento N:N entre Cliente e Cartao
CREATE TABLE ClienteCartao (
    id_cliente INT NOT NULL,
    id_cartao INT NOT NULL,
    papel ENUM('Titular', 'Adicional') NOT NULL,
    PRIMARY KEY (id_cliente, id_cartao),
    FOREIGN KEY (id_cliente) REFERENCES Cliente(id_cliente)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_cartao) REFERENCES Cartao(id_cartao)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Tabela de Transações
CREATE TABLE Transacao (
    id_transacao INT AUTO_INCREMENT PRIMARY KEY,
    id_cartao INT NOT NULL,
    data_transacao DATETIME NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    descricao VARCHAR(255),
    tipo ENUM('Débito', 'Crédito', 'Estorno') NOT NULL,
    FOREIGN KEY (id_cartao) REFERENCES Cartao(id_cartao)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
