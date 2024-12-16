CREATE DATABASE animals;
CREATE USER 'animals_user'@'localhost' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON animals.* TO 'animals_users'@'localhost' IDENTIFIED BY '123456';
FLUSH PRIVILEGES;

