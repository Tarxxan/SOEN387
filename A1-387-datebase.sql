-- A1_SOEN387.person definition

CREATE TABLE `person` (
  `personalID` int(10) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `streetName` varchar(30) NOT NULL,
  `streetNumber` int(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `postalCode` varchar(10) NOT NULL,
  PRIMARY KEY (`personalID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- A1_SOEN387.student definition

CREATE TABLE `student` (
  `studentID` int(10) NOT NULL,
  `personalID` int(10) NOT NULL,
  PRIMARY KEY (`studentID`),
  KEY `student_FK` (`personalID`),
  CONSTRAINT `student_FK` FOREIGN KEY (`personalID`) REFERENCES `person` (`personalID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- A1_SOEN387.courses definition

CREATE TABLE `courses` (
  `courseCode` varchar(10) NOT NULL,
  `title` varchar(30) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `days` varchar(20) NOT NULL,
  `time` time NOT NULL,
 -- `instructor` varchar(30) NOT NULL,
  `classroom` varchar(30) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  PRIMARY KEY (`courseCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- A1_SOEN387.employee definitions

CREATE TABLE `employee` (
  `employeeID` int(10) NOT NULL,
  `personalID` int(10) NOT NULL,
 -- `instructor` varchar(30) NOT NULL,
  PRIMARY KEY (`employeeID`),
  KEY `employee_FK` (`personalID`),
--  KEY `employee_FK_1` (`instructor`),
  CONSTRAINT `employee_FK` FOREIGN KEY (`personalID`) REFERENCES `person` (`personalID`)
 -- CONSTRAINT `employee_FK_1` FOREIGN KEY (`instructor`) REFERENCES `courses` (`instructor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- A1_SOEN387.enrollment definition

CREATE TABLE `enrollment` (
  `enrollID` int(10) NOT NULL,
  `studentID` int(10) NOT NULL,
  `courseCode` varchar(10) NOT NULL,
  PRIMARY KEY (`enrollID`),
  KEY `enrollment_FK` (`studentID`),
  KEY `enrollment_FK_1` (`courseCode`),
  CONSTRAINT `enrollment_FK` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`),
  CONSTRAINT `enrollment_FK_1` FOREIGN KEY (`courseCode`) REFERENCES `courses` (`courseCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- insert TO person
insert into person values (12345678,'Jojo','Smith','jojo123@gmail.com','123456789','2000-12-05','Mckay', 2323,'Montreal','Canada','G4S 3R4');
insert into person values (12345679,'Jo','Meth','jo1@gmail.com','123456888','1991-10-15','lime', 8923,'Sydny','Australia','X4R 7V8');
insert into person values (12347878,'John','Mcjohn','johnjohn123@gmail.com','123456777','1984-03-09','Oak', 2893,'St.louis','USA','D9G 5T2');
insert into person values (33345678,'Mark','White','white3@gmail.com','123554789','1989-8-25','Newton', 1793,'San diego','USA','G4W 7A9');
insert into person values (11115678,'Mika','Martin','martinmik@gmail.com','123479789','1990-9-28','Jean-paul', 1993,'Quebec city','Canada','Z6F 8Q3');
insert into person values (12355578,'Matt','Landon','mattlandon@gmail.com','157576789','1976-12-25','Pierce', 2223,'Montreal','Canada','S7J 2N6');

-- insert TO student
insert into student values (12345678,12345678);
insert into student values (12345679,12345679);
insert into student values (12347878,12347878);


-- insert TO courses
insert into courses values ('MATH 233','Advanced Calculus','Winter only','Mondays         ','13:15','DR 3.120','2020-01-05','2020-04-14'); 
insert into courses values ('PHYS 203','Intro to physics','Fall,Winter ','Tuesdays,Thursday','10:15','SP 2.220','2020-01-05','2020-04-14'); 
insert into courses values ('SOCI 213','Intro to Society','Fall only ','Friday             ','14:45','LSR 1.300','2022-09-06','2022-12-07'); 

-- insert TO employee
insert into employee values (33345678,33345678);
insert into employee values (11115678,11115678);
insert into employee values (12355578,12355578);

-- insert TO enrollment
insert into enrollment values (32255678,12345678,'MATH 233');
insert into enrollment values (11344678,12345679,'PHYS 203');
insert into enrollment values (12225578,12347878,'SOCI 213');






