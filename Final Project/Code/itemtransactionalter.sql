DROP TABLE IF EXISTS student_item_transaction;
CREATE TABLE student_item_transaction
(
	student_id INTEGER NOT NULL REFERENCES student(student_id),
	item_id INTEGER NOT NULL REFERENCES item(id),
	item_condition_id INTEGER NOT NULL REFERENCES item_condition(id),
	location_id INTEGER NOT NULL REFERENCES location(id),
	employee_id INTEGER NOT NULL REFERENCES employee(employee_id),

	check_out DATETIME NOT NULL,
	check_in DATETIME NULL,
	due_date DATETIME NOT NULL,

	PRIMARY KEY(student_id, item_condition_id, location_id, employee_id),
	CONSTRAINT student_item_transaction_student_fkey FOREIGN KEY(student_id) REFERENCES student(student_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT student_item_transaction_item_fkey FOREIGN KEY(item_id) REFERENCES item(id) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT student_item_transaction_item_condition_fkey FOREIGN KEY(item_condition_id) REFERENCES item_condition(id) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT student_item_transaction_location_fkey FOREIGN KEY(location_id) REFERENCES location(id) ON DELETE NO ACTION ON UPDATE NO ACTION,
	CONSTRAINT student_item_transaction_employee_fkey FOREIGN KEY(employee_id) REFERENCES employee(employee_id) ON DELETE NO ACTION ON UPDATE NO ACTION)ENGINE=INNODB;
