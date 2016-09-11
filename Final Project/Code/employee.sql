DROP TABLE IF EXISTS employee_permissions;

CREATE TABLE employee_permissions (
	permission_id INTEGER PRIMARY KEY,
	permission_name VARCHAR(250) NOT NULL
)ENGINE = INNODB;

DROP TABLE IF EXISTS employee;

CREATE TABLE employee (
	employee_id INT(11) PRIMARY KEY,
	username VARCHAR(16),
	EMAIL varchar(255) NOT NULL,
	name_first VARCHAR(30) NOT NULL,
	name_last VARCHAR (45) NOT NULL,
	hashed_password VARCHAR(256) NOT NULL,
	premission_id VARCHAR(250) REFERENCES employee_permissions (permission_id)
) ENGINE = INNODB;

DROP TABLE IF EXISTS employee_has_permissions;

CREATE TABLE employee_has_permissions (
	employee_id INT(11) NOT NULL,
	employee_permissions_id INT(11) NOT NULL,
	PRIMARY KEY (employee_id, employee_permissions_id),
	CONSTRAINT fk_employee_has_employee_permissions_employee
		FOREIGN KEY (employee_id)
		REFERENCES employee (employee_id)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION,
	CONSTRAINT fk_employee_has_employee_permissions_employee_permissions1
		FOREIGN KEY (employee_permissions_id)
		REFERENCES employee_permissions (permission_id)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION);
		
CREATE INDEX fk_employee_has_employee_permissions_employee_permissions1_idx ON employee_has_permissions (employee_permissions_id ASC);
CREATE INDEX fk_employee_has_employee_permissions_employee_idx ON employee_has_permissions (employee_id ASC);
