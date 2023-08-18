CREATE TABLE equipe (
    ID SMALLINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) UNIQUE,
    ville VARCHAR(80) NOT NULL,
    nb_victoires TINYINT UNSIGNED DEFAULT 0
);

CREATE TABLE joueur (
    ID MEDIUMINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    nb_buts SMALLINT UNSIGNED DEFAULT 0,
    nb_passes SMALLINT UNSIGNED DEFAULT 0,
    id_equipe SMALLINT UNSIGNED,
    FOREIGN KEY(id_equipe) REFERENCES equipe(ID) ON DELETE SET NULL
)

INSERT INTO equipe ( nom, ville, nb_victoires) 
VALUES 
    ('Canadiens','Montréal',30),
    ('Maple Leafs','Toronto',32),
    ('Bruins','Boston',10);

INSERT INTO joueur ( prenom, nom, nb_buts, nb_passes, id_equipe) 
VALUES 
    ('Kirby','Dach', 50, 60, 1),
    ('Cole','Caufield', 32, 50, 1),
    ('Mike','Hoffman', 70, 46, 1),

    ('William','Nylander', 60, 65, 2),
    ('Nick','Ritchie', 82, 64, 2),
    ('Wayne','Simmonds', 64, 40, 2),
    
    ('Linus','Ullmark', 85, 64, 3),
    ('Jeremy', 'Swayman', 66, 23, 3),
    ('Brad','Marchand', 44, 56, 3);

    