-- @ abc123 Game 
-- database entity and dummy data
-- author : Patrick Saint-Louis 
-- date : 2023

-- 1.Create the Database | Créer la Base de données
CREATE DATABASE IF NOT EXISTS kidsGames; 

-- 2.Access the Database | Accéder à la Base de données
USE kidsGames;

-- 3.Create the Tables and Views | Créer les Tables et Vues
CREATE TABLE IF NOT EXISTS player( 
    fName VARCHAR(50) NOT NULL, 
    lName VARCHAR(50) NOT NULL, 
    userName VARCHAR(20) NOT NULL UNIQUE,
    registrationTime DATETIME NOT NULL,
    id VARCHAR(200) GENERATED ALWAYS AS (CONCAT(UPPER(LEFT(fName,2)),UPPER(LEFT(lName,2)),UPPER(LEFT(userName,3)),CAST(registrationTime AS SIGNED))),
    registrationOrder INTEGER AUTO_INCREMENT,
    PRIMARY KEY (registrationOrder)
)CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; 

CREATE TABLE IF NOT EXISTS authenticator(   
    passCode VARCHAR(255) NOT NULL,
    registrationOrder INTEGER, 
    FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
)CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; 

CREATE TABLE IF NOT EXISTS score( 
    scoreTime DATETIME NOT NULL, 
    result ENUM('success', 'failure', 'incomplete'),
    livesUsed INTEGER NOT NULL,
    registrationOrder INTEGER, 
    FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
)CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; 

CREATE VIEW history AS
SELECT s.scoreTime, p.id, p.fName, p.lName, s.result, s.livesUsed 
FROM player p, score s
WHERE p.registrationOrder = s.registrationOrder;

-- 4.Insert dummy data to the Tables 

-- 4.1.Table player 
INSERT INTO player(fName, lName, userName, registrationTime)
VALUES('Patrick','Saint-Louis', 'sonic12345', now()); 

INSERT INTO player(fName, lName, userName, registrationTime)
VALUES('Marie','Jourdain', 'asterix2023', now());

INSERT INTO player(fName, lName, userName, registrationTime)
--VALUES('Jonathan','David', 'pokemon527', now()); 
VALUES('Jonathan','David', 'pokemon', now()); 
  
-- 4.2.Table authenticator
-- $passCode=password_hash('hellomontreal', PASSWORD_DEFAULT);
INSERT INTO authenticator(passCode, registrationOrder)
VALUES('$2y$10$AMyb4cbGSWSvEcQxt91ZVu5r5OV7/3mMZl7tn8wnZrJ1ddidYfVYW', 1);

-- $passCode=password_hash('helloquebec', PASSWORD_DEFAULT);
INSERT INTO authenticator(passCode, registrationOrder)
VALUES('$2y$10$Lpd3JsgFW9.x2ft6Qo9h..xmtm82lmSuv/vaQKs9xPJ4rhKlMJAF.', 2);

-- $passCode=password_hash('hellocanada', PASSWORD_DEFAULT);
INSERT INTO authenticator(passCode, registrationOrder)
--VALUES('$2y$10$FRAyAIK6.TYEEmbOHF4JfeiBCdWFHcqRTILM7nF/7CPjE3dNEWj3W', 3);
VALUES('123', 3);

-- 4.3.Table score
INSERT INTO score(scoreTime, result , livesUsed, registrationOrder)
VALUES(now(), 'success', 4, 1);

INSERT INTO score(scoreTime, result , livesUsed, registrationOrder)
VALUES(now(), 'failure', 6, 2);

INSERT INTO score(scoreTime, result , livesUsed, registrationOrder)
VALUES(now(), 'incomplete', 5, 3);
