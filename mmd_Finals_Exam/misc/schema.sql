CREATE TABLE user_credentials (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    role ENUM('User', 'Admin') NOT NULL,
    username VARCHAR (50),
    first_Name VARCHAR (50),
    last_Name VARCHAR (50),
    password text,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);