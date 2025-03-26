DROP TABLE IF EXISTS messages;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
	id_user INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(32) NOT NULL,
	username VARCHAR(16),
	email VARCHAR(32) NOT NULL,
	birthdate DATE NOT NULL,
	password CHAR(32) NOT NULL,
	status INT NOT NULL DEFAULT 1
);
INSERT INTO users (name, username, email, birthdate, password)
VALUES ('Zarai Zhang', 'zara', 'zara.zhang@enti.cat', '2000-12-01', md5('enti'));
	
CREATE TABLE messages (
	id_message INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	message VARCHAR(240) NOT NULL,
	post_time DATETIME NOT NULL,
	is_response BOOLEAN NOT NULL DEFAULT FALSE,
	status INT NOT NULL DEFAULT 1,
	id_user INT UNSIGNED,
	FOREIGN KEY (id_user) REFERENCES users(id_user)
);

