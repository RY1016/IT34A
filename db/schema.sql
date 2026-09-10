CREATE TABLE IF NOT EXISTS activity_logs (
    activity_log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255),
    user_email VARCHAR(255),
    activity_log_action VARCHAR(50) NOT NULL,
    activity_log_status ENUM('success', 'failure') DEFAULT 'success',

    -- Client Parameters
    activity_log_ip_address VARCHAR(45),
    activity_log_user_agent VARCHAR(255),

    -- Timestamp
    activity_log_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table #3 users table
CREATE TABLE IF NOT EXISTS users (

    -- Primary key for users table
    user_id INT PRIMARY KEY AUTO_INCREMENT,

    -- Initial user details
    user_email VARCHAR(50) UNIQUE NOT NULL,
    user_username VARCHAR(20) UNIQUE NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_role ENUM('admin', 'manager', 'user') NOT NULL DEFAULT 'user',

    -- User Created Timestamp
    user_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- User Updated Timestamp
    user_updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);

insert into users (user_email, user_username, user_password, user_role) 
values ('admin@gmail.com','admin','admin123','admin');

UPDATE `users` 
SET `user_password` = '$2y$10$4.aBq3k0pQ65.x2LpEa.k.6G4SXZzB0T2K8H7qD9O8f/gXJ.M4Y4O' 
WHERE `user_username` = 'admin';