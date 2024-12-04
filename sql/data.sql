CREATE TABLE user (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255),
	first_name VARCHAR(255),
	last_name VARCHAR(255),
  email VARCHAR(255),
	password TEXT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE photos (
	photo_id INT AUTO_INCREMENT PRIMARY KEY,
	photo_name TEXT,
	title VARCHAR(255),
	username VARCHAR(255),
	description VARCHAR(255),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);


CREATE TABLE activity_log (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    record_id INT NOT NULL,
    action_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);


CREATE TABLE collage_records (
    record_id INT AUTO_INCREMENT PRIMARY KEY,  
    student_id INT NOT NULL,                    
    student_name VARCHAR(255) NOT NULL,          
    course_name VARCHAR(255) NOT NULL,           
    date_of_enrollment DATE NOT NULL,            
    grade VARCHAR(5),                           
    status ENUM('Active', 'Graduated', 'Dropped') NOT NULL DEFAULT 'Active',  
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  
);
