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
values ('admin@gmail.com','admin','	$2a$05$bvIG6Nmid91Mu9RcmmWZfO5HJIMCT8riNW0hEp8f6/FuA2/mHZFpe','admin');

insert into users (user_email, user_username, user_password, user_role) 
values ('manager@gmail.com','manager','	$2a$05$bvIG6Nmid91Mu9RcmmWZfO5HJIMCT8riNW0hEp8f6/FuA2/mHZFpe','manager');

insert into users (user_email, user_username, user_password, user_role) 
values ('user@gmail.com','user','	$2a$05$bvIG6Nmid91Mu9RcmmWZfO5HJIMCT8riNW0hEp8f6/FuA2/mHZFpe','user');



