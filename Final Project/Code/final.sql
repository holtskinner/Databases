DROP DATABASE IF EXISTS final;
CREATE DATABASE final;

DROP TABLE IF EXISTS employee_permissions;
CREATE TABLE employee_permissions (
    permission_id INTEGER PRIMARY KEY,
    permission_name VARCHAR(250) NOT NULL
)ENGINE = INNODB;


DROP TABLE IF EXISTS employee;

CREATE TABLE employee (
    username VARCHAR(16) PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name_first VARCHAR(30) NOT NULL,
    name_last VARCHAR(45) NOT NULL,
    permission_id VARCHAR(250) REFERENCES employee_permissions (permission_id)
)ENGINE = INNODB;

DROP TABLE IF EXISTS student;
CREATE TABLE student (
    student_id INTEGER PRIMARY KEY,
    username VARCHAR(16) NOT NULL,
    email VARCHAR(255) NOT NULL,
    name_first VARCHAR(30) NOT NULL,
    name_last VARCHAR(45) NOT NULL
)ENGINE = INNODB;

DROP TABLE IF EXISTS waiver;
CREATE TABLE waiver (
    waiver_name VARCHAR(250) PRIMARY KEY,
    is_filed boolean
)ENGINE = INNODB;

DROP TABLE IF EXISTS student_has_waiver;
CREATE TABLE student_has_waiver(

    student_id INTEGER REFERENCES student(student_id),
    waiver_name VARCHAR(250) REFERENCES waiver(waiver_name),

    PRIMARY KEY(student_id, waiver_name)

)ENGINE = INNODB;

DROP TABLE IF EXISTS lcoation;
CREATE TABLE location(
    id INTEGER PRIMARY KEY,
    name VARCHAR(250)
)ENGINE=INNODB;

DROP TABLE IF EXISTS item_category;
CREATE TABLE item_category (
    cat_id INTEGER PRIMARY KEY,
    name VARCHAR (250) NOT NULL,
    time_limit INTEGER -- in minutes
)ENGINE = INNODB;

DROP TABLE IF EXISTS item;
CREATE TABLE item(
    id INTEGER PRIMARY KEY,
    name VARCHAR(250),
    category_id INTEGER REFERENCES item_category(cat_id)
)ENGINE=INNODB;

DROP TABLE IF EXISTS item_condition;
CREATE TABLE item_condition(
    id INTEGER,
    name VARCHAR(250),
    item_id INTEGER REFERENCES item(id)
)ENGINE = INNODB;

DROP TABLE IF EXISTS item_condition_update;
CREATE TABLE item_condition_update(

    item_id INTEGER REFERENCES item(id),
    condition_id INTEGER REFERENCES item_condition(id),
    updatetime TIMESTAMP
)ENGINE = INNODB;

DROP TABLE IF EXISTS student_item_transaction;
CREATE TABLE student_item_transaction(

    student_id INTEGER REFERENCES student(student_id),
    location_id INTEGER REFERENCES location(id),
    condition_of_item INTEGER REFERENCES item_condition(id),
    item_id INTEGER REFERENCES item(id),
    employee_username VARCHAR(16) REFERENCES employee(username)
)ENGINE = INNODB;
