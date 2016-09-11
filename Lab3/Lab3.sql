/* Holt Skinner lab 3*/

DROP TABLE IF EXISTS building;
CREATE TABLE building(
    name varchar(30),
    address varchar(30),
    city varchar(15),
    state varchar(2),
    zipcode int(5),
    PRIMARY KEY(address, zipcode)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS office;
CREATE TABLE office(
    room_number int(3) PRIMARY KEY,
    waiting_room_capacity int(2),
    building_address varchar(30) REFERENCES building(address)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS doctor;
CREATE TABLE doctor(
    first_name varchar(15),
    last_name varchar(15),
    medical_license_num int(3),
    office_num int(3) REFERENCES office(room_number)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS patient;
CREATE TABLE patient(
    first_name varchar(15),
    last_name varchar(15),
    ssn int(9) PRIMARY KEY
)ENGINE=InnoDB;

DROP TABLE IF EXISTS appointments;
CREATE TABLE appointments(
    appt_date date,
    appt_time time,
    doctor_license_num int(3) REFERENCES doctor(medical_license_num),
    patient_ssn int(9) REFERENCES patient(ssn),
    PRIMARY KEY (doctor_license_num, patient_ssn)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS insurance;
CREATE TABLE insurance(
    policy_num varchar(15),
    insurer varchar(15),
    customer_ssn int(9) REFERENCES patient(ssn)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS conditions;
CREATE TABLE conditions(
    icd10 varchar(10) PRIMARY KEY,
    description varchar(30)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS patient_has_condition;
CREATE TABLE patient_has_condition(
    patient_ssn int(9) REFERENCES patient(ssn),
    condition_icd10 varchar(10) REFERENCES conditions(icd10),
    PRIMARY KEY(patient_ssn, condition_icd10)  
)ENGINE=InnoDB;

DROP TABLE IF EXISTS labwork;
CREATE TABLE labwork(
    test_name varchar(15),
    test_timestamp datetime,
    test_value varchar(15),
    patient_ssn int(9) REFERENCES patient(ssn),
    PRIMARY KEY(test_name,test_timestamp)
)ENGINE=InnoDB;

/* Begin Insert statements
*/

INSERT INTO building (name, address, city, state, zipcode)
VALUES  ("Mizzou Health Care", "101 Hospital Drive", "Columbia", "MO", "65201"),
        ("Boone County Medical Center", "1600 E Broadway", "Columbia", "MO", "65201"),
        ("Ozarka Medical Center", "1100 Kentucky Ave", "West Plains", "MO", "65775");
        
INSERT INTO office (room_number, waiting_room_capacity, building_address)
VALUES  ("101", "12", "101 Hospital Drive"),
        ("103", "15", "101 Hospital Drive"),
        ("105", "17", "101 Hospital Drive");
        
INSERT INTO doctor (first_name, last_name, office_num, medical_license_num)
VALUES  ("Joe", "Guilliams", "101", "456"),
        ("Rohit", "Chadha", "103", "964"),
        ("Mike", "Phinney", "105", "986");
        
INSERT INTO patient (first_name, last_name, ssn)
VALUES  ("Holt", "Skinner", "123456789"),
        ("Grace", "Rogers", "987654321"),
        ("John", "Doe", "976356765");

INSERT INTO appointments (appt_date, appt_time, doctor_license_num, patient_ssn)
VALUES  ("2016-02-14", "12:00", "456", "123456789"),
        ("2016-02-14", "1:00", "964", "987654321"),
        ("2016-02-14", "5:00", "964", "976356765");

INSERT INTO insurance (policy_num, insurer, customer_ssn)
VALUES  ("94756485", "Obamacare", "123456789"),
        ("94756486", "Obamacare", "987654321"),
        ("94756487", "Obamacare", "976356765");
        
INSERT INTO conditions (icd10, description)
VALUES  ("J00", "Common Cold"),
        ("A49.2", "Hemophilus influenzae infection"),
        ("Z37.0", "Single live birth");

INSERT INTO patient_has_condition (patient_ssn, condition_icd10)
VALUES  ("123456789", "J00"),
        ("987654321", "A49.2"),
        ("976356765", "A49.2");

INSERT INTO labwork (test_name, test_timestamp, test_value, patient_ssn)
VALUES  ("Electric Shock", "2014-02-17 12:56", "Negative", "123456789"),
        ("Electric Shock", "2014-02-17 1:56", "Positive", "987654321"),
        ("DNA Test", "2015-02-17 4:34", "Positive", "987654321");
