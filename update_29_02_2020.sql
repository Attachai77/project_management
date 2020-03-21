ALTER TABLE `project_management`.`projects` 
ADD COLUMN `type` VARCHAR(45) NULL COMMENT 'ประเภทโครงการ' AFTER `adviser_id`,
ADD COLUMN `faculty_consistencies` VARCHAR(45) NULL COMMENT 'ความสอดคล้องกับคณะ' AFTER `type`,
ADD COLUMN `university_consistencies` VARCHAR(45) NULL COMMENT 'ความสอดคล้องกับมหาลัย' AFTER `faculty_consistencies`,
ADD COLUMN `student_consistencies` VARCHAR(45)  NULL COMMENT 'ความสอดคล้องกับบัณฑิต' AFTER `university_consistencies`;


CREATE TABLE `project_management`.`project_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `project_management`.`project_types`
(`id`,
`name`)
VALUES
(1,'การบริหารวิชาการ'),
(2,'การพัฒนานักศึกษา'),
(3,'การพัฒนาการเรียนการสอน'),
(4,'การจัดการความรู้'),
(5,'การบูรณาการการบริการวิชาการกับการวิจัย'),
(6,'การบูรณาการการบริการวิชาการกับการเรียนการสอน'),
(7,'การบูรณาการการบริการวิชาการกับการวิจัยและการเรียนการสอน');

CREATE TABLE `project_management`.`project_university_consistencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


INSERT INTO `project_management`.`project_university_consistencies`
(`id`,
`name`)
VALUES
(1,'พันธกิจสัมพันธ์กับการพัฒนาท้องถิ่น'),
(2,'การผลิตครูและบัณฑิตที่มีคุณภาพ'),
(3,'การยกระดับคุณภาพการศึกษา'),
(4,'การพัฒนาระบบการบริหาร');


CREATE TABLE `project_management`.`project_faculty_consistencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `project_management`.`project_faculty_consistencies`
(`id`,
`name`)
VALUES
(1,'คณะแห่งวิจัย พัฒนาวัตกรรมและเทคโนโลยีเป็นที่ยอมรับระดับชาติและนานาชาติ'),
(2,'คณะเป็นเลิศด้านวิชาการวิทยาศาตร์และเทคโนโลยี'),
(3,'คณะต้นแบบการบริหารจัดการงานพันธกิจสัมพันธ์คณะกับสังคม'),
(4,'สร้างต้นแบบการจัดกิจกรรมนักศึกษาร่วมการงานพันธกิจสัมพันธ์ของคณะกับสังคม'),
(5,'สร้างอัตลักษณ์ขององค์กรด้วยการทำนุบำรุงศิลปะ วัฒนธรรม และการอนุรักษ์ทรัพยากรธรรมชาติและสิ่งแวดล้อม และโครงการพระราชดำริ'),
(6,'บริหารเชิงรุกโดยใช้หลัก 5MNK ที่มีการประกันคุณภาพทั้งองค์กรภายใต้หลักธรรมาภิบาล');

CREATE TABLE `project_management`.`project_student_consistencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `project_management`.`project_student_consistencies`
(`id`,
`name`)
VALUES
(1,'คุณธรรม จริยธรรม'),
(2,'ความรู้'),
(3,'ทักษะทางปัญญา'),
(4,'ทักษะความาสัมพันธ์ระหว่างบุคคลและความรับผิดชอบ'),
(5,'ทักษะการวิเคราะห์เชิงตัวเลข การสื่อสารและการใช้เทคโนโลยีสารสนเทศ');


CREATE TABLE `project_management`.`project_files` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `project_id` INT NOT NULL,
  `path` VARCHAR(500) NOT NULL,
  `ext` VARCHAR(16) NULL,
  `original_name` VARCHAR(500) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));
