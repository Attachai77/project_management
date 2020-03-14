ALTER TABLE `project_management`.`project_members` 
ADD COLUMN `member_name` VARCHAR(128) NULL AFTER `deleted`;

ALTER TABLE `project_management`.`task_members` 
ADD COLUMN `member_name` VARCHAR(128) NULL AFTER `updated_uid`;


CREATE TABLE `project_management`.`task_files` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `task_id` INT NOT NULL,
  `path` VARCHAR(500) NOT NULL,
  `ext` VARCHAR(16) NULL,
  `original_name` VARCHAR(500) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));