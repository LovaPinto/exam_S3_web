create database databasevite;

CREATE TABLE users (
    id int auto_increment primary key;
    nom VARCHAR(200);
    email VARCHAR(150) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL,
);
