CREATE TABLE `amrithaahead`.`ah_designation` (`designation_id` INT NOT NULL AUTO_INCREMENT , `designation_name` VARCHAR(225) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL , `dg_addedon` DATETIME NOT NULL , `dg_addedby` INT NOT NULL , `dg_updatedon` DATETIME NOT NULL , `dg_status` TINYINT NOT NULL , PRIMARY KEY (`designation_id`)) ENGINE = InnoDB;

ALTER TABLE `ah_designation` CHANGE `dg_updatedon` `dg_updatedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;

CREATE TABLE `amrithaahead`.`ah_location` (`location_id` INT NOT NULL AUTO_INCREMENT , `lo_name` VARCHAR(225) NOT NULL , `lo_addedby` INT NOT NULL , `lo_addedon` DATETIME NOT NULL , `lo_updatedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `lo_status` TINYINT NOT NULL , PRIMARY KEY (`location_id`)) ENGINE = InnoDB;

INSERT INTO `ah_location` (`location_id`, `lo_name`, `lo_addedby`, `lo_addedon`, `lo_updatedon`, `lo_status`) VALUES ('1', 'Remote Location', '1', '2022-12-08 10:54:10.000000', current_timestamp(), '0'), ('2', 'From Campus', '1', '2022-12-08 10:54:10.000000', current_timestamp(), '0');

CREATE TABLE `amrithaahead`.`ah_stafflocation` (`stafflocation_id` INT NOT NULL AUTO_INCREMENT , `sl_staff_id` INT NOT NULL , `sl_location_type` INT NOT NULL , `sl_addedby` INT NOT NULL , `sl_addedon` DATETIME NOT NULL , `sl_updatedon` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `sl_status` TINYINT NOT NULL , PRIMARY KEY (`stafflocation_id`)) ENGINE = InnoDB;

ALTER TABLE `ah_stafflocation` ADD CONSTRAINT `staff_id` FOREIGN KEY (`sl_staff_id`) REFERENCES `ck_authentication`(`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `ah_stafflocation` ADD `sl_start_date` DATETIME NULL AFTER `sl_updatedon`, ADD `sl_end_date` DATETIME NULL AFTER `sl_start_date`;

