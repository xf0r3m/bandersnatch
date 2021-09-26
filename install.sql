CREATE DATABASE bandersnatch;
CREATE USER 'bsnatch'@'localhost' IDENTIFIED BY 'bsnatch1234';
GRANT ALL ON bandersnatch.* TO 'bsnatch'@'localhost';

use bandersnatch;

CREATE TABLE users (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    uname varchar(255),
    hash text,
    role varchar(255)
);

CREATE TABLE rsa_keys (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    priv_key text,
    pub_key text
);

CREATE TABLE servers (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    addr varchar(255),
    uname varchar(255),
    auth varchar(255),
    pass varchar(255)
);

CREATE TABLE secret_key (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    priv_key text,
    pub_key text
);