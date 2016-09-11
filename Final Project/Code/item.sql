DROP DATABASE IF EXISTS final;
CREATE DATABASE final;
USE final;
DROP TABLE IF EXISTS Item;
CREATE table Item
(
    id varchar(20),
    notes text(1000),
    conditions varchar(20),
    isCheckedOut boolean,
    dueAt date,
    
    PRIMARY KEY (id),
    
    /*Foreign Keys*/    
    item_class varchar(20) REFERENCES ItemClass(class),
    location_name varchar(20) REFERENCES Location(name),
    studentId integer REFERENCES Student(id)

)ENGINE=InnoDB;

DROP TABLE IF EXISTS ItemTag; /*Joint table of Item and Tag*/
CREATE table ItemTag
(
    tag varchar(20),
    class varchar(20),
    
    PRIMARY KEY(tag, class) AS tag_class
)ENGINE=InnoDB;

DROP TABLE IF EXISTS ItemClass;
CREATE table ItemClass
(
    class varchar(20),
    timeLimit interval,
    
    PRIMARY KEY(class);
    
    tag_and_class REFERENCES ItemTag(tag_class)
    /*This weird foreign key is because foreign keys must reference a primary key*/
   
)ENGINE=InnoDB;

DROP TABLE IF EXISTS Tag;
CREATE table Tag
(
    tag varchar(20),
    
    PRIMARY KEY (tag);
    
    /*Foreign Key*/
    tag_and_class REFERENCES ItemTag(tag_class)

)ENGINE=InnoDB;



DROP TABLE IF EXISTS Student;
CREATE table Student
(
    id integer,
    filedWaiver boolean,
    
    PRIMARY KEY(id)
)ENGINE=InnoDB;

DROP TABLE IF EXISTS Location;
CREATE table Location
(
    name varchar(20),
    campus varchar(40),
    supportEmail varchar(40),
    
    PRIMARY KEY(name)
)ENGINE=InnoDB;
    
    