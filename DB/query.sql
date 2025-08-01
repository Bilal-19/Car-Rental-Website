CREATE TABLE general_enquiry(
    id INT AUTO_INCREMENT PRIMARY KEY,
full_name VARCHAR(50),
email_address VARCHAR(100),
phone VARCHAR(100),
message_subject VARCHAR(100),
user_message VARCHAR(250),
created_at DATETIME DEFAULT NOW()
)

-- To remove table
DROP TABLE general_enquiry