INSERT INTO pilot (fname, lname, license_num, birthdate)
VALUES('Garven', 'Dreis', '1',
 '1987-03-12'),
('Wedge', 'Antilles', '2','1954-02-28'),
('Biggs', 'Darklighter', '3', '1902-02-04'),
('John', 'Branon', '4', '1987-12-12'),
('Luke', 'Skywalker', '5', '1951-09-25'),
('Jek', 'Porkins', '6', '1904-09-23'),
('Theron', 'Nett', '10', '1904-09-23'),
('Sila', 'Kott', '7', '2015-11-29'),
('Grizz', 'Frix', '8', '1765-10-23'),
('Han', 'Solo', '100', '1875-04-26');

INSERT INTO plane (tail_num, brand, model, owner_license_num, num_engines)
Values('X7645', 'Millenium', 'Falcon', '100', '5'),
('IVFYJS', 'Boeing', '747', '1', '6'),
('VYDUV', 'Boeing', '757', '2', '6'),
('IVDUTS', 'Boeing', '767', '3', '6'),
('TDGCU', 'Boeing', '777', '4', '6'),
('YDFTS', 'Boeing', '787', '6', '6'),
('EUYDJ', 'Boeing', '797', '7', '6'),
('STCVU', 'Boeing', '807', '8', '6'),
('LOLJK', 'Boeing', '817', '10', '6'),
('UYFVG', 'Boeing', '827', '100', '6');


SELECT brand, model from plane;

SELECT lname from pilot where lname = 'Solo';

SELECT num_engines from plane where brand = 'Boeing';

SELECT birthdate from pilot;

SELECT * from pilot;

SELECT tail_num from plane;


UPDATE plane
SET num_engines = 4
WHERE tail_num = 'UYFVG';

DELETE FROM plane
WHERE tail_num = 'STCVU';

UPDATE pilot
SET lname = 'Skywalker'
WHERE fname = 'John';

UPDATE plane
SET brand = 'Milenium'
WHERE model = '777';

DELETE FROM plane
WHERE num_engines < 2;