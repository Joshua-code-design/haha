-- 1. Users Table
CREATE TABLE Admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(60) NOT NULL,
    email VARCHAR(60) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('doctor', 'nurse') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Database: apply
-- Table structure for table `patients`

CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    record_number VARCHAR(20) NOT NULL UNIQUE,    
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50) DEFAULT NULL,
    birthdate DATE NOT NULL,
    age INT DEFAULT NULL,
    gender VARCHAR(10) NOT NULL,
    mobile_number VARCHAR(20) NOT NULL,
    city VARCHAR(50) NOT NULL,
    street VARCHAR(100) NOT NULL,
    patient_ailment TEXT NOT NULL,
    allergies TEXT DEFAULT NULL,
    chief_complaint TEXT NOT NULL,
    medical_history TEXT DEFAULT NULL,
    social_history TEXT DEFAULT NULL,
    admission_date DATE NOT NULL,
    admission_time TIME NOT NULL,
    temperature VARCHAR(10) NOT NULL,
    pulse VARCHAR(10) NOT NULL,
    respiratory_rate VARCHAR(10) NOT NULL,
    blood_pressure VARCHAR(20) DEFAULT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE lab_tests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_name VARCHAR(255) NOT NULL,
    test_type VARCHAR(255) NOT NULL,
    test_date DATE NOT NULL,
    test_time TIME,
    payment_status VARCHAR(50) NOT NULL,
    payment_amount DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50),
    FOREIGN KEY (patient_id) REFERENCES patients(id) -- Adjust patient table reference
);


CREATE TABLE patient_medications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    medication_name VARCHAR(100) NOT NULL,
    dosage VARCHAR(50) NOT NULL,
    frequency VARCHAR(50) NOT NULL,
    notes TEXT,
    image_path VARCHAR(255),
    created_at DATETIME NOT NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(id)
);

-- Lab Results Table
CREATE TABLE lab_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    test_type VARCHAR(255) NOT NULL,
    test_date DATE NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE
);

-- Lab Result Files Table
CREATE TABLE lab_result_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    result_id INT NOT NULL,
    original_name VARCHAR(255) NOT NULL,
    stored_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    file_type VARCHAR(100) NOT NULL,
    file_size INT NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (result_id) REFERENCES lab_results(id) ON DELETE CASCADE
);
