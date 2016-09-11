
DROP DATABASE IF EXISTS final;
CREATE DATABASE final;
--TEAM AWESOME: FINAL PROJECT__

----------EMPLOYEE----------------------
DROP TABLE IF EXISTS employee_permissions;
CREATE TABLE employee_permissions (
    permission_id INTEGER PRIMARY KEY,
    permission_name VARCHAR(250) NOT NULL
)ENGINE = INNODB;

DROP TABLE IF EXISTS employee;
CREATE TABLE employee (
    employee_id INTEGER PRIMARY KEY,
    username VARCHAR(16) NOT NULL,
    email VARCHAR(255) NOT NULL,
    name_first VARCHAR(30) NOT NULL,
    name_last VARCHAR(45) NOT NULL,
    permission_id INTEGER REFERENCES employee_permissions (permission_id)
)ENGINE = INNODB;
--instead of creating a new employee_has_permissions table, have an admin that grants employee permissions
--an employee can have permissions revoked as well

----------STUDENT----------------------
DROP TABLE IF EXISTS student;
CREATE TABLE student (
    student_id INTEGER PRIMARY KEY,
    username VARCHAR(16) NOT NULL,
    email VARCHAR(255) NOT NULL,
    name_first VARCHAR(30) NOT NULL,
    name_last VARCHAR(45) NOT NULL
)ENGINE = INNODB;

---------WAIVER-------------------------
DROP TABLE IF EXISTS waiver;
CREATE TABLE waiver (
    waiver_name VARCHAR(250) PRIMARY KEY,
    is_filed boolean,
    is_expired boolean
)ENGINE = INNODB;

DROP TABLE IF EXISTS student_has_waiver;
CREATE TABLE student_has_waiver(
    student_id INTEGER REFERENCES student (student_id),
    waiver_name VARCHAR(250) REFERENCES waiver (waiver_name),
    PRIMARY KEY(student_id, waiver_name)
)ENGINE = INNODB;
--waiver for laptops is signed online via the student's access page
--also has an expiry date after the new semester
--must be filled out before checking out an item
--waiver for bikes is handwritten

----------LOCATION-----------------------
DROP TABLE IF EXISTS location;
CREATE TABLE location(
    id INTEGER PRIMARY KEY,
    name VARCHAR(250),
)ENGINE=INNODB;
--either MU Student Center or Memorial Union
--if there is time, can later implement locations for IT checkout and the Journalism school

----------ITEM---------------------------
DROP TABLE IF EXISTS item_category;
CREATE TABLE item_category (
    cat_id INTEGER PRIMARY KEY,
    name VARCHAR (250) NOT NULL,
    time_limit INTEGER -- in minutes
)ENGINE = INNODB;
--at this point, either laptops or bikes (possibly add chargers)
--items such as billiard balls only require holding id

DROP TABLE IF EXISTS item;
CREATE TABLE item (
    id INTEGER PRIMARY KEY,
    name VARCHAR(250),
    category_id INTEGER REFERENCES item_category (cat_id)
)ENGINE=INNODB;
--also will implement a bar code for the item (JUSTIN!)

DROP TABLE IF EXISTS item_has_category;
CREATE TABLE item_has_category (
  item_category_id INTEGER NOT NULL,
  item_id INTEGER NOT NULL,
  PRIMARY KEY (item_category_id, item_id),
  CONSTRAINT item_has_category_item_category_fkey
    FOREIGN KEY (item_category_id) REFERENCES item_category (cat_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT item_has_category_item_id_fkey
    FOREIGN KEY (item_id) REFERENCES item (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX item_has_category_item_category_fkey_index ON item_has_category (item_category_id ASC);
CREATE INDEX item_has_category_item_id_fkey_index ON item_has_category (item_id ASC);


DROP TABLE IF EXISTS item_condition;
CREATE TABLE item_condition(
    id INTEGER,
    name VARCHAR(250),
    item_id INTEGER REFERENCES item(id)
)ENGINE = INNODB;
--condition ranges from good to broken with notes to comment on the condition

DROP TABLE IF EXISTS item_condition_update;
CREATE TABLE item_condition_update (
  item_id INTEGER NOT NULL,
  updateTime DATETIME(19) NOT NULL,
  condition_id INTEGER REFERENCES item_condition (id),
  employee_id INTEGER NOT NULL,
  PRIMARY KEY (item_id, condition_id, updateTime),
  CONSTRAINT item_condition_update_item_fkey --the condition that was updated (good/broken as of now)
    FOREIGN KEY (item_id) REFERENCES item (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT item_condition_update_employee_fkey --which employee made the change, should also make the note
    FOREIGN KEY (employee_id) REFERENCES employee (employee_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE INDEX item_condition_update_item_fkey_index ON item_condition_update (item_id ASC);
CREATE INDEX item_condition_update_employee_fkey_index ON item_condition_update (employee_id ASC);

------------CHECK IN/CHECK OUT-------------------
DROP TABLE IF EXISTS student_item_transaction;
CREATE TABLE student_item_transaction (
  student_id INTEGER NOT NULL REFERENCES student (student_id),
  item_id INTEGER NOT NULL REFERENCES item(id),
  item_condition_id INTEGER NULL REFERENCES item_condition (id),
  location_id INTEGER NOT NULL REFERENCES location (id),
  employee_id INTEGER NOT NULL REFERENCES employee (employee_id),

  check_out DATETIME(19) NOT NULL,
  check_in DATETIME(19) NULL,
  due_date DATETIME(19) NULL,
  --transaction should include when the items were checked out and when they were checked in
  --timer that notifies students with an e-mail when overdue, otherwise they'll be charged $$
  --should update for employees to find overdue items

  PRIMARY KEY (student_id, item_id, item_condition_id, location_id, employee_id),
  CONSTRAINT student_item_transaction_student_fkey --which student checked out
    FOREIGN KEY (student_id) REFERENCES student (student_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT student_item_transaction_item_fkey --what item was checked out
    FOREIGN KEY (item_id) REFERENCES item (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT student_item_transaction_item_condition_fkey --if the item was broken when checked out
    FOREIGN KEY (item_condition_id) REFERENCES item_condition (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT student_item_transaction_location_fkey --where item was checked out
    FOREIGN KEY (location_id) REFERENCES location (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT student_item_transaction_employee_fkey --which employee checked out the item
    FOREIGN KEY (employee_id) REFERENCES employee (employee_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,

    CREATE INDEX student_item_transaction_student_fkey_index ON student_item_transaction (student_id ASC);
    CREATE INDEX student_item_transaction_item_fkey_index ON student_item_transaction (item_id ASC);
    CREATE INDEX student_item_transaction_item_condition_fkey_index ON student_item_transaction (item_condition_id ASC);
    CREATE INDEX student_item_transaction_location_fkey_index ON student_item_transaction (location_id ASC);
    CREATE INDEX student_item_transaction_employee_fkey_index ON student_item_transaction (employee_id ASC);
