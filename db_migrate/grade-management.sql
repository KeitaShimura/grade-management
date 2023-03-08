CREATE TABLE IF NOT EXISTS grademanagement.exams (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    test_id INT(11) NOT NULL,
    student_id INT(11) NOT NULL,
    kokugo INT(11) NOT NULL,
    sugaku INT(11) NOT NULL,
    eigo INT(11) NOT NULL,
    rika INT(11) NOT NULL,
    shakai INT(11) NOT NULL,
    goukei INT(11) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS grademanagement.students (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    class_id INT(11) NOT NULL,
    class INT(11) NOT NULL,
    number INT(11) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS grademanagement.tests (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    year INT(11) NOT NULL,
    name VARCHAR(30) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS grademanagement.teachers (
    id bigint(11) AUTO_INCREMENT PRIMARY KEY,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    name varchar(30) NOT NULL,
    position VARCHAR(20) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS grademanagement.classes (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    year INT(11) NOT NULL,
    name VARCHAR(20) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

CREATE TABLE IF NOT EXISTS grademanagement.teacher_classes (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    teacher_id INT(11) NOT NULL,
    class_id INT(11) NOT NULL,
    created_at DATETIME,
    updated_at DATETIME
);

INSERT INTO grademanagement.teachers SET id=1, email="keitashimura2023@gmail.com", password="111111", name="志村 啓太", position="一般", created_at="2020-10-10", updated_at="2020-10-10";
INSERT INTO grademanagement.classes SET id=1, year=1, name="志村 啓太", created_at="2020-10-10", updated_at="2020-10-10";
INSERT INTO grademanagement.teacher_classes SET id=1, teacher_id=1, class_id=1, created_at="2020-10-10", updated_at="2020-10-10";
