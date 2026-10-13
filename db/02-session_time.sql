CREATE TABLE user_sessions(
    
    session_id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,

    session_start DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    session_end DATETIME NOT NULL,
    session_duration INT DEFAULT NULL,

    CONSTRAINT fk_user_sessions_user_id
        FOREIGN KEY (user_id) 
        REFERENCES users(user_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);