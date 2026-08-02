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
    enabled INT DEFAULT 1,
    thumbnail_image VARCHAR(100),
    registration_number VARCHAR(100) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

-- new columns (for soft delete)
-- ALTER TABLE
--     vehicles ADD COLUMN enabled INT DEFAULT 1

CREATE TABLE vehicle_images(
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_path VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    vehicle_id INT NOT NULL,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE
)

CREATE TABLE vehicle_booking(
    id INT AUTO_INCREMENT PRIMARY KEY,
    pickup_date DATE NOT NULL,
    return_date DATE NOT NULL,
    pickup_location VARCHAR(100),
    need_driver ENUM('Yes','No'),
    additional_notes VARCHAR(200) NULL,
    user_id INT NOT NULL,
    vehicle_id INT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)

-- Insert Query
INSERT INTO general_enquiry(full_name, email_address,phone,message_subject,user_message) VALUES('Test User', 'test@gmail.com', '0300-0078987','test subject','test message');

CREATE TABLE vehicle_brands(
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand_name VARCHAR(100) UNIQUE,
    add_by VARCHAR(100),
    add_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    add_ip VARCHAR(100),
    update_by VARCHAR(100),
    update_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_ip VARCHAR(100)
)

-- SQL to create vehicle models table
CREATE TABLE vehicle_models(
    id INT AUTO_INCREMENT PRIMARY KEY,
    model_name VARCHAR(100) UNIQUE,
    add_by VARCHAR(100),
    add_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    add_ip VARCHAR(100),
    update_by VARCHAR(100),
    update_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    update_ip VARCHAR(100),
    brand_id INT NOT NULL,
    FOREIGN KEY (brand_id) REFERENCES vehicle_brands(id) ON DELETE CASCADE
)
