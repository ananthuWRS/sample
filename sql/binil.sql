CREATE TABLE `ah_subcategory` ( `subcategoryid` INT(11) NOT NULL AUTO_INCREMENT , `sc_categoryid` INT(11) NOT NULL , `sc_name` VARCHAR(255) NOT NULL , `sc_addedby` INT(11) NOT NULL , `sc_addedon` DATETIME NOT NULL , `sc_updatedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `sc_status` TINYINT(2) NOT NULL DEFAULT '0' , PRIMARY KEY (`subcategoryid`)) ENGINE = InnoDB;
INSERT INTO `ck_usertype` (`usertypeid`, `ut_name`, `ut_status`) VALUES (NULL, 'Reporting Person', '0');
CREATE TABLE `ah_departments` ( `departmentid` INT(11) NOT NULL AUTO_INCREMENT , `dp_name` VARCHAR(255) NOT NULL , `dp_addedby` INT(11) NOT NULL , `dp_addedon` DATETIME NOT NULL , `dp_updatedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `dp_status` TINYINT(2) NOT NULL DEFAULT '0' , PRIMARY KEY (`departmentid`)) ENGINE = InnoDB;
CREATE TABLE `ah_campus` ( `campus_id` INT(11) NOT NULL AUTO_INCREMENT , `campus_name` VARCHAR(255) NOT NULL , `cp_addedon` DATETIME NOT NULL , `cp_addedby` INT(11) NOT NULL , `cp_updatedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `cp_status` TINYINT(2) NOT NULL , PRIMARY KEY (`campus_id`)) ENGINE = InnoDB;
CREATE TABLE `ah_programme` ( `programmeid` INT(11) NOT NULL AUTO_INCREMENT , `pg_name` VARCHAR(255) NOT NULL , `pg_addedon` DATETIME NOT NULL , `pg_addedby` INT(11) NOT NULL , `pg_updatedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `pg_status` TINYINT(2) NOT NULL DEFAULT '0' , PRIMARY KEY (`programmeid`)) ENGINE = InnoDB;

//31-10-2022
ALTER TABLE `ck_authentication` ADD `au_title` VARCHAR(100) NULL AFTER `au_usertype`, ADD `au_emp_number` INT(11) NOT NULL AFTER `au_title`, ADD `au_gender` ENUM('Male','Female') NULL DEFAULT NULL AFTER `au_emp_number`, ADD `au_deptarment` VARCHAR(255) NULL AFTER `au_gender`, ADD `au_school` VARCHAR(255) NULL AFTER `au_deptarment`, ADD `au_campus` VARCHAR(255) NULL AFTER `au_school`;
CREATE TABLE `ah_staff_reporting_conn` ( `reportingid` INT(11) NOT NULL AUTO_INCREMENT , `rp_staffid` INT(11) NOT NULL , `rp_reportingperson` INT(11) NOT NULL , `rp_addedon` DATETIME NOT NULL , `rp_addedby` INT(11) NOT NULL , `rp_updatedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`reportingid`)) ENGINE = InnoDB;

CREATE TABLE `ah_tasks` ( `taskid` INT(11) NOT NULL AUTO_INCREMENT , `task_category` INT(11) NOT NULL , `task_subcategory` INT(11) NOT NULL , `task_title` TEXT NOT NULL , `task_details` LONGTEXT NOT NULL , `task_staffid` INT(11) NOT NULL , `task_priority` ENUM('low','normal','urgent ') NULL DEFAULT NULL , `task_completed_percentage` INT(11) NOT NULL , `task_status` INT(2) NULL DEFAULT '0' COMMENT '0=>active,1=>pending,2=>completed' , `task_addedon` DATETIME NOT NULL , `task_updatedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `task_addedby` INT(11) NOT NULL , PRIMARY KEY (`taskid`)) ENGINE = InnoDB;
ALTER TABLE `ah_tasks` ADD CONSTRAINT `fk_task_category_category` FOREIGN KEY (`task_category`) REFERENCES `ah_task_category`(`task_categoryid`) ON DELETE CASCADE ON UPDATE NO ACTION; ALTER TABLE `ah_tasks` ADD CONSTRAINT `fk_task_subcategory_subcat` FOREIGN KEY (`task_subcategory`) REFERENCES `ah_subcategory`(`subcategoryid`) ON DELETE CASCADE ON UPDATE NO ACTION; ALTER TABLE `ah_tasks` ADD CONSTRAINT `fk_task_staffid_auth_staff` FOREIGN KEY (`task_staffid`) REFERENCES `ck_authentication`(`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION;
CREATE TABLE `ah_team` ( `teamid` INT(11) NOT NULL AUTO_INCREMENT , `team_name` VARCHAR(255) NOT NULL , `team_addedon` DATETIME NOT NULL , `team_addedby` INT(11) NOT NULL , `team_updatedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `team_status` TINYINT(2) NOT NULL DEFAULT '0' , PRIMARY KEY (`teamid`)) ENGINE = InnoDB;
CREATE TABLE `ah_team_member` ( `team_memberid` INT(11) NOT NULL AUTO_INCREMENT , `tm_staffid` INT(11) NOT NULL , `tm_ishead` TINYINT(2) NOT NULL DEFAULT '0' COMMENT '1=>head,0=>not head' , `tm_status` TINYINT(2) NOT NULL DEFAULT '0' , `tm_addedon` DATETIME NOT NULL , `tm_updatedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`team_memberid`)) ENGINE = InnoDB;
ALTER TABLE `ah_team_member` ADD `tm_teamid` INT(11) NOT NULL AFTER `tm_staffid`;
ALTER TABLE `ah_team_member` ADD CONSTRAINT `fk_teamid_team` FOREIGN KEY (`tm_teamid`) REFERENCES `ah_team`(`teamid`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `ah_team_member` ADD CONSTRAINT `fk_tm_staff_authentication` FOREIGN KEY (`tm_staffid`) REFERENCES `ck_authentication`(`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `ah_staff_reporting_conn` ADD CONSTRAINT `fk_rp_staffid_authentication` FOREIGN KEY (`rp_staffid`) REFERENCES `ck_authentication`(`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `ah_staff_reporting_conn` ADD `rp_status` TINYINT(2) NOT NULL DEFAULT '0' AFTER `rp_updatedon`;


CREATE TABLE `ah_task_staff` ( `task_staff_addedid` INT(11) NOT NULL AUTO_INCREMENT , `tsa_staffid` INT(11) NOT NULL , `tsa_taskid` INT(11) NOT NULL , `tsa_addedon` DATETIME NOT NULL , `tsa_addedby` INT(11) NOT NULL , `tsa_status` TINYINT(2) NOT NULL DEFAULT '0' , PRIMARY KEY (`task_staff_addedid`)) ENGINE = InnoDB;
ALTER TABLE `ah_task_staff` ADD CONSTRAINT `fk_tsa_staffid_authentication_id` FOREIGN KEY (`tsa_staffid`) REFERENCES `ck_authentication`(`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `ah_task_staff` ADD CONSTRAINT `tsa_taskid_tasks_id` FOREIGN KEY (`tsa_taskid`) REFERENCES `ah_tasks`(`taskid`) ON DELETE CASCADE ON UPDATE NO ACTION;
CREATE TABLE `ah_task_status_details` ( `task_details_id` INT(11) NOT NULL AUTO_INCREMENT , `td_staff_id` INT(11) NOT NULL , `td_task_id` INT(11) NOT NULL , `td_completion_status` INT(11) NOT NULL DEFAULT '0' , `td_execution_date` DATE NOT NULL , `td_hours` INT(11) NOT NULL , `td_minutes` INT(11) NOT NULL , `td_addedon` DATETIME NOT NULL , `td_addedby` INT(11) NOT NULL , `td_status` TINYINT(2) NOT NULL DEFAULT '0' , PRIMARY KEY (`task_details_id`)) ENGINE = InnoDB;
ALTER TABLE `ah_task_status_details` ADD CONSTRAINT `td_staff_id_authentication_id` FOREIGN KEY (`td_staff_id`) REFERENCES `ck_authentication`(`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `ah_task_status_details` ADD CONSTRAINT `td_task_id_tasks_id` FOREIGN KEY (`td_task_id`) REFERENCES `ah_tasks`(`taskid`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `ah_tasks` ADD `task_date` DATE NULL AFTER `task_completed_percentage`, ADD `task_end_date` DATE NULL AFTER `task_date`;
ALTER TABLE `ah_task_staff` ADD `tsa_completed_status` INT(2) NULL DEFAULT '0' COMMENT '0=>active,1=>pending,2=>completed ' AFTER `tsa_taskid`;
ALTER TABLE `ah_tasks` CHANGE `task_staffid` `task_staffid` INT(11) NOT NULL COMMENT 'added staff id (not assigned staff id)';
ALTER TABLE `ah_task_staff` ADD `tsa_completed_percentage` INT(11) NULL AFTER `tsa_completed_status`;
ALTER TABLE `ah_task_status_details` CHANGE `td_completion_status` `td_completion_percentage` INT(11) NOT NULL DEFAULT '0';
ALTER TABLE `ah_task_status_details` ADD `td_remarks` TEXT NULL AFTER `td_minutes`;
ALTER TABLE `ah_tasks` ADD `task_temids` VARCHAR(255) NULL AFTER `task_status`;
ALTER TABLE `ah_tasks` ADD `task_active` TINYINT(2) NOT NULL DEFAULT '0' AFTER `task_addedby`;


ALTER TABLE `ah_task_staff` ADD `tsa_approved` TINYINT(2) NOT NULL DEFAULT '0' COMMENT '1=>approved,2=>rejected' AFTER `tsa_completed_percentage`;
ALTER TABLE `ah_task_staff` ADD `tsa_approvedon` DATETIME NULL AFTER `tsa_approved`, ADD `tsa_approved_by` INT(11) NOT NULL DEFAULT '0' AFTER `tsa_approvedon`;
ALTER TABLE `ah_task_staff` ADD `tsa_comment` TEXT NULL AFTER `tsa_approved_by`;

ALTER TABLE `ah_task_status_details` ADD `td_approved` INT(2) NOT NULL COMMENT '1=>approved,2=>rejected' AFTER `td_status`;
CREATE TABLE `ah_staff_task_approved_details` ( `approveddetailsid` INT(11) NOT NULL AUTO_INCREMENT , `ad_staff_id` INT(11) NOT NULL , `ad_task_id` INT(11) NOT NULL , `ad_approved_date` DATE NOT NULL , `ad_approved_comment` TEXT NULL , `ad_approved_by` INT(11) NOT NULL , `ad_addedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`approveddetailsid`)) ENGINE = InnoDB;
ALTER TABLE `ah_staff_task_approved_details` ADD CONSTRAINT `fk_ad_staff_id_authentication` FOREIGN KEY (`ad_staff_id`) REFERENCES `ck_authentication`(`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `ah_staff_task_approved_details` ADD CONSTRAINT `fk_ad_task_id_tasks` FOREIGN KEY (`ad_task_id`) REFERENCES `ah_tasks`(`taskid`) ON DELETE CASCADE ON UPDATE NO ACTION;
ALTER TABLE `ah_task_status_details` ADD `td_approved_id` INT(11) NULL DEFAULT '0' AFTER `td_approved`;
ALTER TABLE `ah_staff_task_approved_details` ADD `ad_approved_type` INT(2) NOT NULL COMMENT '1=>approved,2=>rejected' AFTER `ad_approved_date`;
ALTER TABLE `ah_staff_reporting_conn` ADD `rp_teamid` INT(11) NULL DEFAULT NULL AFTER `rp_reportingperson`;

//updated above
