CREATE TABLE IF NOT EXISTS tblclass (
    ID int(11) NOT NULL AUTO_INCREMENT,
    ClassName varchar(100) DEFAULT NULL,
    Section varchar(20) DEFAULT NULL,
    CreationDate timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS tblstudent;
CREATE TABLE IF NOT EXISTS tblstudent (
    ID int(11) NOT NULL AUTO_INCREMENT,
    StudentName varchar(200) DEFAULT NULL,
    StudentEmail varchar(200) DEFAULT NULL,
    StudentClass varchar(100) DEFAULT NULL,
    Gender varchar(50) DEFAULT NULL,
    DOB date DEFAULT NULL,
    StuID varchar(100) DEFAULT NULL,
    FatherName varchar(200) DEFAULT NULL,
    MotherName varchar(200) DEFAULT NULL,
    ContactNumber varchar(20) DEFAULT NULL,
    AltenateNumber varchar(20) DEFAULT NULL,
    Address mediumtext DEFAULT NULL,
    UserName varchar(200) DEFAULT NULL,
    Password varchar(200) DEFAULT NULL,
    Image varchar(200) DEFAULT NULL,
    DateofAdmission timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tblnotice (
    ID int(11) NOT NULL AUTO_INCREMENT,
    NoticeTitle varchar(200) DEFAULT NULL,
    ClassId int(11) DEFAULT NULL,
    NoticeMsg mediumtext DEFAULT NULL,
    CreationDate timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS tblpublicnotice (
    ID int(11) NOT NULL AUTO_INCREMENT,
    NoticeTitle varchar(200) DEFAULT NULL,
    NoticeMessage mediumtext DEFAULT NULL,
    CreationDate timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS tblhomework;
CREATE TABLE IF NOT EXISTS tblhomework (
    ID int(11) NOT NULL AUTO_INCREMENT,
    homeworkTitle varchar(200) DEFAULT NULL,
    classId int(11) DEFAULT NULL,
    homeworkDescription mediumtext DEFAULT NULL,
    lastDateofSubmission date DEFAULT NULL,
    CreationDate timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 