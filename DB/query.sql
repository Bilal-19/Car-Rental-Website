-- To remove tables
DROP TABLE general_enquiry
DROP TABLE users
DROP TABLE vehicles

CREATE TABLE general_enquiry(
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(50),
    email_address VARCHAR(100),
    phone VARCHAR(100),
    message_subject VARCHAR(100),
    user_message VARCHAR(250),
    created_at DATETIME DEFAULT NOW()
)


-- Create Users table
CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(50),
    email_address VARCHAR(100),
    phone VARCHAR(100),
    user_pswd VARCHAR(100),
    created_at DATETIME DEFAULT NOW(),
    is_account_activated BOOLEAN DEFAULT 0
)

-- Do not store price in 
-- ON DELETE CASCADE used when delete record form master table, then records from detail will also be deleted

CREATE TABLE vehicles(
    id INT AUTO_INCREMENT PRIMARY KEY,
    make VARCHAR(100) NOT NULL,
    model VARCHAR(100) NOT NULL,
    engine_capacity SMALLINT UNSIGNED,
    category VARCHAR(100),
    transmission ENUM(
        'Automatic Transmission (AT)',
        'Manual Transmission (MT)',
        'Automated Manual Transmission (AM)',
        'Continuously Variable Transmission (CVT)'
    ),
    TRIM VARCHAR(50),
    horsepower SMALLINT UNSIGNED,
    doors TINYINT UNSIGNED,
    fuel_type VARCHAR(50),
    no_of_cylinders TINYINT UNSIGNED,
    interior_color VARCHAR(50),
    exterior_color VARCHAR(50),
    per_day_cost DECIMAL(10, 2),
    drive_type VARCHAR(50),
    seating_capacity TINYINT UNSIGNED,
    thumbnail_image VARCHAR(100),
    registration_number VARCHAR(100) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

CREATE TABLE vehicle_images(
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    vehicle_id INT NOT NULL,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE
)
-- Insert Query
INSERT INTO general_enquiry(full_name, email_address,phone,message_subject,user_message) VALUES('Test User', 'test@gmail.com', '0300-0078987','test subject','test message');
