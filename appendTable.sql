use bandersnatch;

CREATE TABLE secret_key (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    priv_key text,
    pub_key text
);