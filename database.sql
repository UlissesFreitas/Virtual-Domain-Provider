CREATE TABLE ftpusers (

    dominio_id INT NOT NULL,
    FOREIGN KEY (dominio_id) REFERENCES dominios(id)
);


CREATE TABLE dominios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dominio VARCHAR(255) NOT NULL UNIQUE,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

