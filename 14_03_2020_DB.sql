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


  CREATE TABLE `project_management`.`project_summaries` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `project_id` INT NOT NULL,
  `male` INT NULL DEFAULT 0,
  `female` INT NULL DEFAULT 0,
  `level_1` INT NULL DEFAULT 0,
  `level_2` INT NULL DEFAULT 0,
  `level_3` INT NULL DEFAULT 0,
  `level_4` INT NULL DEFAULT 0,
  `level_other` INT NULL DEFAULT 0,
  `cs_count` INT NULL DEFAULT 0,
  `it_count` INT NULL DEFAULT 0,
  `mt_count` INT NULL DEFAULT 0,
  `r_1` FLOAT NULL DEFAULT 0,
  `r_2` FLOAT NULL DEFAULT 0,
  `r_3` FLOAT NULL DEFAULT 0,
  `r_4` FLOAT NULL DEFAULT 0,
  `r_5` FLOAT NULL DEFAULT 0,
  `r_6` FLOAT NULL DEFAULT 0,
  `r_7` FLOAT NULL DEFAULT 0,
  `r_8` FLOAT NULL DEFAULT 0,
  `r_9` FLOAT NULL DEFAULT 0,
  `r_10` FLOAT NULL DEFAULT 0,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC));

  CREATE TABLE `project_management`.`project_summary_comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `project_id` INT NOT NULL,
  `comment` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));