/* Create quai_antique database if don't exist.
If database already exist, the query will be canceled*/
CREATE DATABASE IF NOT EXISTS quai_antique;

/*
 écrire All ENGINE=InnoDB n'est pas forcément nécessaire,
 cependant, il peut être utile de le faire si je veux m'assurer
 que la table est créée avec les bonnes options.
 En général, il est recommandé de spécifier le moteur de stockage et le jeu 
 de caractères lors de la création de la table,
 pour éviter des problèmes potentiels avec des options par défaut inattendues.

 CRÉATION DE CUSTOMER
 Explication:
 Crée la table customer. À l'intérieur, tu met un champ id qui va s'auto incrémenter (1, 2, 3.. à chaque nouvelle entrée) et qui ne peut pas être null,
 tu mets un champ email de type longtext (accepte de plus grande chaines de caractères) non null
 tu mets un champ password de type longtext non null.
 tu met un champ guestNumber de type entier, non null.
 tu met un champ allergies de type LONGTEXT qui peut être null par défaut.
 id doit être la clé primaire, ce qui rend à chaque création d'une nouvelle vue, l'id unique.
 Enfin, on préçise en quel encodage on souhaite stocker nos données, et on précise également quel engine utilise par sécurité.
*/
CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, email LONGTEXT NOT NULL, password LONGTEXT NOT NULL, guest_number INT NOT NULL, allergies LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

/*
 CRÉATION DE BOOKING
 Explication:
 Crée la table BOOKING. À l'intérieur, tu met un champ id qui va s'auto incrémenter (1, 2, 3.. à chaque nouvelle entrée) et qui ne peut pas être null,
 tu mets un champ name de type varchar non null
 tu mets un champ date de type DATE non null.
 tu met un champ booking_time de type TIME, non null.
 tu met un champ allergies de type varchar qui peut être null par défaut.
 id doit être la clé primaire, ce qui rend à chaque création d'une nouvelle vue, l'id unique.
 Enfin, on préçise en quel encodage on souhaite stocker nos données, et on précise également quel engine utilise par sécurité. */
CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date DATE NOT NULL, booking_time TIME NOT NULL, allergies VARCHAR(255) NOT NULL, guest_number INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
/* 
 Create Starter, Dish, Desserts, Drink, Aperitif and Cellar tables.
*/

/*CRÉATION DE STARTER
 Explication:
 Crée la table STARTER. 
 À l'intérieur, tu met un champ id qui va s'auto incrémenter (1, 2, 3.. à chaque nouvelle entrée) et qui ne peut pas être null,
 tu mets un champ title de type longtext non null
 tu mets un champ description de type longtext non null.
 tu met un champ price de type text, non null.
 id doit être la clé primaire, ce qui rend à chaque création d'une nouvelle vue, l'id unique.
 Enfin, on préçise en quel encodage on souhaite stocker nos données, et on précise également quel engine utilise par sécurité.*/
CREATE TABLE starter (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, price LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;*/

/*CRÉATION DE CELLAR
 Explication:
 Crée la table CELLAR. 
 À l'intérieur, tu met un champ id qui va s'auto incrémenter (1, 2, 3.. à chaque nouvelle entrée) et qui ne peut pas être null,
 tu mets un champ title de type longtext non null
 tu mets un champ description de type longtext non null.
 id doit être la clé primaire, ce qui rend à chaque création d'une nouvelle vue, l'id unique.
 Enfin, on préçise en quel encodage on souhaite stocker nos données, et on précise également quel engine utilise par sécurité.*/
CREATE TABLE cellar (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

/*CRÉATION DE DESSERT
 Explication:
 Crée la table DESSERT. 
 À l'intérieur, tu met un champ id qui va s'auto incrémenter (1, 2, 3.. à chaque nouvelle entrée) et qui ne peut pas être null,
 tu mets un champ title de type longtext non null
 tu mets un champ description de type longtext non null.
 tu met un champ price de type text, non null.
 id doit être la clé primaire, ce qui rend à chaque création d'une nouvelle vue, l'id unique.
 Enfin, on préçise en quel encodage on souhaite stocker nos données, et on précise également quel engine utilise par sécurité.*/
CREATE TABLE desserts (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, price LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

/*CRÉATION DE DISH
 Explication:
 Crée la table DISH. 
 À l'intérieur, tu met un champ id qui va s'auto incrémenter (1, 2, 3.. à chaque nouvelle entrée) et qui ne peut pas être null,
 tu mets un champ title de type longtext non null
 tu mets un champ description de type longtext non null.
 tu met un champ price de type text, non null.
 id doit être la clé primaire, ce qui rend à chaque création d'une nouvelle vue, l'id unique.
 Enfin, on préçise en quel encodage on souhaite stocker nos données, et on précise également quel engine utilise par sécurité.*/
CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, price LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

/*CRÉATION DE DRINK
 Explication:
 Crée la table DRINK. 
 À l'intérieur, tu met un champ id qui va s'auto incrémenter (1, 2, 3.. à chaque nouvelle entrée) et qui ne peut pas être null,
 tu mets un champ title de type longtext non null
 tu met un champ price de type text, non null.
 id doit être la clé primaire, ce qui rend à chaque création d'une nouvelle vue, l'id unique.
 Enfin, on préçise en quel encodage on souhaite stocker nos données, et on précise également quel engine utilise par sécurité.*/
CREATE TABLE drink (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, price LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

/*CRÉATION DE APERITIF
 Explication:
 Crée la table APERITIF. 
 À l'intérieur, tu met un champ id qui va s'auto incrémenter (1, 2, 3.. à chaque nouvelle entrée) et qui ne peut pas être null,
 tu mets un champ title de type longtext non null
 tu mets un champ description de type longtext non null.
 tu met un champ price de type text, non null.
 id doit être la clé primaire, ce qui rend à chaque création d'une nouvelle vue, l'id unique.
 Enfin, on préçise en quel encodage on souhaite stocker nos données, et on précise également quel engine utilise par sécurité.*/
CREATE TABLE aperitif (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, price LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

/* Add admin user
 First in VSCODE type this: php bin/console security:hash-password, and enter your password. Copy your hashed password.
 Now, type: USE quai_antique
 And enter your SQL request:*/
INSERT INTO customer (email, password, guest_number, allergies, roles) VALUES ('mon-mail@mon-mail.com', 'hashed_password', 'number_of_guest (max 8)', 'mes_allergies', '["ROLE_ADMIN"]');

/* Insert data in a dish table example*/
INSERT INTO dish (title, description, price) VALUES ('Ravioles gratinées', 'Ravioles aux cèpes, gratinées à la raclette', '6.90');