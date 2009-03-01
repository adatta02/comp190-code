
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- project
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `project`;


CREATE TABLE `project`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(45),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`User_Type_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `FI_User_User_Type` (`User_Type_id`),
	CONSTRAINT `fk_User_User_Type`
		FOREIGN KEY (`User_Type_id`)
		REFERENCES `user_type` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- job
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `job`;


CREATE TABLE `job`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`Project_id` INTEGER,
	`Publication_id` INTEGER,
	`Status_id` INTEGER,
	`event` VARCHAR(64),
	`date` DATETIME,
	`start_time` DATETIME,
	`end_time` DATETIME,
	`due_date` DATETIME,
	`street` VARCHAR(64),
	`city` VARCHAR(64),
	`state` VARCHAR(64),
	`zip` INTEGER,
	`contact_name` VARCHAR(45),
	`contact_email` VARCHAR(64),
	`contact_phone` VARCHAR(45),
	`notes` TEXT,
	`estimate` INTEGER,
	`photo_type` INTEGER,
	`acct_num` VARCHAR(32),
	`dept_id` VARCHAR(32),
	`grant_id` VARCHAR(32),
	`other` VARCHAR(255),
	`idr` VARCHAR(32),
	PRIMARY KEY (`id`),
	INDEX `FI_Shoot_Publication` (`Publication_id`),
	CONSTRAINT `fk_Shoot_Publication`
		FOREIGN KEY (`Publication_id`)
		REFERENCES `publication` (`id`),
	INDEX `FI_Job_Project` (`Project_id`),
	CONSTRAINT `fk_Job_Project`
		FOREIGN KEY (`Project_id`)
		REFERENCES `project` (`id`),
	INDEX `FI_Job_Status` (`Status_id`),
	CONSTRAINT `fk_Job_Status`
		FOREIGN KEY (`Status_id`)
		REFERENCES `status` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- photo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photo`;


CREATE TABLE `photo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`Job_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `FI_Photo_Job` (`Job_id`),
	CONSTRAINT `fk_Photo_Job`
		FOREIGN KEY (`Job_id`)
		REFERENCES `job` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- photographer
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photographer`;


CREATE TABLE `photographer`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`User_id` INTEGER,
	`name` VARCHAR(64),
	`phone` VARCHAR(45),
	`email` VARCHAR(64),
	`affiliation` VARCHAR(64),
	`website` VARCHAR(64),
	`description` TEXT,
	PRIMARY KEY (`id`),
	INDEX `FI_Photographer_User` (`User_id`),
	CONSTRAINT `fk_Photographer_User`
		FOREIGN KEY (`User_id`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- client
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `client`;


CREATE TABLE `client`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`User_id` INTEGER,
	`name` VARCHAR(45),
	`department` VARCHAR(255),
	`address` VARCHAR(255),
	`email` VARCHAR(255),
	`phone` VARCHAR(32),
	PRIMARY KEY (`id`),
	INDEX `FI_Client_User` (`User_id`),
	CONSTRAINT `fk_Client_User`
		FOREIGN KEY (`User_id`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- delivery
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `delivery`;


CREATE TABLE `delivery`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`pub_name` VARCHAR(255),
	`pub_type` VARCHAR(255),
	`other` VARCHAR(255),
	`color` VARCHAR(255),
	`size` VARCHAR(255),
	`method` VARCHAR(255),
	`instructions` TEXT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- status
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `status`;


CREATE TABLE `status`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`state` VARCHAR(45),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- publication
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `publication`;


CREATE TABLE `publication`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`contact_name` VARCHAR(64),
	`contact_email` VARCHAR(64),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_type`;


CREATE TABLE `user_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type` VARCHAR(45),
	`permissions` INTEGER,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- job_photographer
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `job_photographer`;


CREATE TABLE `job_photographer`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`Photographer_id` INTEGER,
	`Job_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `FI_Job_Photographer_Photographer` (`Photographer_id`),
	CONSTRAINT `fk_Job_Photographer_Photographer`
		FOREIGN KEY (`Photographer_id`)
		REFERENCES `photographer` (`id`),
	INDEX `FI_Job_Photographer_Job` (`Job_id`),
	CONSTRAINT `fk_Job_Photographer_Job`
		FOREIGN KEY (`Job_id`)
		REFERENCES `job` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- job_client
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `job_client`;


CREATE TABLE `job_client`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`Client_id` INTEGER,
	`Job_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `FI_Job_Client_Client` (`Client_id`),
	CONSTRAINT `fk_Job_Client_Client`
		FOREIGN KEY (`Client_id`)
		REFERENCES `client` (`id`),
	INDEX `FI_Job_Client_Job` (`Job_id`),
	CONSTRAINT `fk_Job_Client_Job`
		FOREIGN KEY (`Job_id`)
		REFERENCES `job` (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
