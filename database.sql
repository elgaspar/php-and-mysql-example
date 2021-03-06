CREATE TABLE IF NOT EXISTS `users` (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(30) NOT NULL,
last_name VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
password_hash VARCHAR(255) NOT NULL,
is_admin BOOLEAN NOT NULL
);

CREATE TABLE IF NOT EXISTS `applications` (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
vacation_start DATE NOT NULL,
vacation_end DATE NOT NULL,
reason VARCHAR(255) NOT NULL,
user_id INT(6) NOT NULL,
status VARCHAR(8) NOT NULL DEFAULT 'pending',
approval_token VARCHAR(32),
created_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);