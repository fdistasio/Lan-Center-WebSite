DROP DATABASE SALA_LAN;
CREATE DATABASE IF NOT EXISTS SALA_LAN;
USE SALA_LAN;


CREATE TABLE IF NOT EXISTS AMMINISTRATORE(
USERNAME_ADMIN VARCHAR(20) DEFAULT 'paolo',
PASSWORD VARCHAR(255) NOT NULL,
PRIMARY KEY(USERNAME_ADMIN)
);


CREATE TABLE IF NOT EXISTS GIOCATORE(
ID_GIOCATORE BIGINT AUTO_INCREMENT  NOT NULL,
NOME_GIOCATORE VARCHAR(10),
USERNAME VARCHAR(20),
COGNOME VARCHAR(10),
DATA_DI_NASCITA DATE,
EMAIL VARCHAR(30),
NUMERO_DI_TELEFONO BIGINT,
PRIMARY KEY(ID_GIOCATORE),
USERNAME_ADMIN VARCHAR(20) DEFAULT 'paolo',
FOREIGN KEY (USERNAME_ADMIN) REFERENCES AMMINISTRATORE(USERNAME_ADMIN)ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS POSTAZIONE(
ID_POSTAZIONE BIGINT AUTO_INCREMENT  NOT NULL,
SERVIZIO_BAR ENUM('si','no'), 
PRIMARY KEY(ID_POSTAZIONE),
RICHIESTE_AGGIUNTIVE VARCHAR(300),
PREZZO INTEGER DEFAULT 20,
DATA_PRENOTAZIONE DATE,
ORARIO TIME, 
ID_GIOCATORE  BIGINT,
FOREIGN KEY (ID_GIOCATORE) REFERENCES GIOCATORE(ID_GIOCATORE)ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS VIDEOGIOCO(
NOME_VIDEOGIOCO VARCHAR(35),
ANNO_DI_PUBBLICAZIONE INTEGER,
SVILUPPATORE VARCHAR(30),
PRIMARY KEY(NOME_VIDEOGIOCO)
);

CREATE TABLE IF NOT EXISTS COMPRENDE(
ID_POSTAZIONE BIGINT NOT NULL,
NOME_VIDEOGIOCO VARCHAR(35),
PRIMARY KEY(ID_POSTAZIONE,NOME_VIDEOGIOCO),
FOREIGN KEY (ID_POSTAZIONE) REFERENCES POSTAZIONE(ID_POSTAZIONE)ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY (NOME_VIDEOGIOCO) REFERENCES VIDEOGIOCO(NOME_VIDEOGIOCO)ON UPDATE CASCADE ON DELETE CASCADE
);



INSERT INTO AMMINISTRATORE VALUES
("paolo","8945c3cb2c93b11ebbc2aeb6821b24e5");

INSERT INTO VIDEOGIOCO VALUES
("League of Legends",2009,"Riot Games"),
("Yu-Gi-Oh! Master Duel",2022,"Konami"),
("Valorant",2020,"Riot Games"),
("Counter-Strike: Global Offensive",2012,"Valve Corporation"),
("Hearthstone: Heroes of Warcraft",2014,"Blizzard Entertainment"),
("Rainbow Six Siege", 2015,"Ubisoft Montreal");

INSERT INTO POSTAZIONE (ID_POSTAZIONE) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

INSERT INTO COMPRENDE VALUES
(1,"League of Legends"),
(1,"Yu-Gi-Oh! Master Duel"),
(1,"Valorant"),
(1,"Counter-Strike: Global Offensive"),

(2,"League of Legends"),
(2,"Yu-Gi-Oh! Master Duel"),
(2,"Valorant"),
(2,"Counter-Strike: Global Offensive"),

(3,"League of Legends"),
(3,"Yu-Gi-Oh! Master Duel"),
(3,"Counter-Strike: Global Offensive"),
(3,"Rainbow Six Siege"),

(4,"League of Legends"),
(4,"Counter-Strike: Global Offensive"),
(4,"Hearthstone: Heroes of Warcraft"),

(5,"League of Legends"),
(5,"Yu-Gi-Oh! Master Duel"),
(5,"Valorant"),
(5,"Counter-Strike: Global Offensive"),

(6,"League of Legends"),
(6,"Rainbow Six Siege"),

(7,"League of Legends"),
(7,"Yu-Gi-Oh! Master Duel"),
(7,"Hearthstone: Heroes of Warcraft"),

(8,"League of Legends"),
(8,"Valorant"),
(8,"Rainbow Six Siege"),
(8,"Hearthstone: Heroes of Warcraft"),

(9,"League of Legends"),
(9,"Valorant"),
(9,"Counter-Strike: Global Offensive"),
(9,"Hearthstone: Heroes of Warcraft"),

(10,"League of Legends"),
(10,"Yu-Gi-Oh! Master Duel"),
(10,"Valorant"),
(10,"Counter-Strike: Global Offensive");


SELECT * FROM GIOCATORE;
SELECT * FROM AMMINISTRATORE;
SELECT * FROM POSTAZIONE;
SELECT * FROM COMPRENDE;








