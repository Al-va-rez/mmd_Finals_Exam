CREATE TABLE user_credentials (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    role ENUM('User', 'Admin') NOT NULL,
    username VARCHAR (50),
    first_Name VARCHAR (50),
    last_Name VARCHAR (50),
    password text,
    account_Status ENUM('Suspended', 'Active') DEFAULT 'Active',
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE documents (
    document_id INT AUTO_INCREMENT PRIMARY KEY,
    owner_id INT,
    title VARCHAR(255),
    content LONGTEXT,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE document_shares (
    share_id INT AUTO_INCREMENT PRIMARY KEY,
    document_id INT NOT NULL,
    collaborator_id INT NOT NULL,
    date_shared TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);