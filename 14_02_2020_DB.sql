ALTER TABLE `project_management`.`project_members` 
ADD COLUMN `member_name` VARCHAR(128) NULL AFTER `deleted`;

ALTER TABLE `project_management`.`task_members` 
ADD COLUMN `member_name` VARCHAR(128) NULL AFTER `updated_uid`;
