
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
	`status_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `FI_project_status` (`status_id`),
	CONSTRAINT `fk_project_status`
		FOREIGN KEY (`status_id`)
		REFERENCES `status` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user_profile
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_profile`;


CREATE TABLE `sf_guard_user_profile`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_type_id` INTEGER,
	`user_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `FI_sf_guard_user_profile_user_type` (`user_type_id`),
	CONSTRAINT `fk_sf_guard_user_profile_user_type`
		FOREIGN KEY (`user_type_id`)
		REFERENCES `user_type` (`id`),
	INDEX `FI_sf_gaurd_user_profile_user_id` (`user_id`),
	CONSTRAINT `fk_sf_gaurd_user_profile_user_id`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- job
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `job`;


CREATE TABLE `job`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`project_id` INTEGER,
	`publication_id` INTEGER,
	`status_id` INTEGER,
	`event` VARCHAR(64),
	`date` DATE,
	`start_time` DATETIME,
	`end_time` DATETIME,
	`due_date` DATETIME,
	`created_at` DATETIME,
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
	PRIMARY KEY (`id`),
	INDEX `FI_Shoot_Publication` (`publication_id`),
	CONSTRAINT `fk_Shoot_Publication`
		FOREIGN KEY (`publication_id`)
		REFERENCES `publication` (`id`),
	INDEX `FI_Job_Project` (`project_id`),
	CONSTRAINT `fk_Job_Project`
		FOREIGN KEY (`project_id`)
		REFERENCES `project` (`id`),
	INDEX `FI_Job_Status` (`status_id`),
	CONSTRAINT `fk_Job_Status`
		FOREIGN KEY (`status_id`)
		REFERENCES `status` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- photo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photo`;


CREATE TABLE `photo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`job_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `FI_Photo_Job` (`job_id`),
	CONSTRAINT `fk_Photo_Job`
		FOREIGN KEY (`job_id`)
		REFERENCES `job` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- photographer
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photographer`;


CREATE TABLE `photographer`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`name` VARCHAR(64),
	`phone` VARCHAR(45),
	`email` VARCHAR(64),
	`affiliation` VARCHAR(64),
	`website` VARCHAR(64),
	`description` TEXT,
	PRIMARY KEY (`id`),
	INDEX `FI_Photographer_User` (`user_id`),
	CONSTRAINT `fk_Photographer_User`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user_profile` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- client
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `client`;


CREATE TABLE `client`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`name` VARCHAR(45),
	`department` VARCHAR(255),
	`address` VARCHAR(255),
	`email` VARCHAR(255),
	`phone` VARCHAR(32),
	PRIMARY KEY (`id`),
	INDEX `FI_Client_User` (`user_id`),
	CONSTRAINT `fk_Client_User`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user_profile` (`id`)
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
	`format` VARCHAR(255),
	`size` VARCHAR(255),
	`method` VARCHAR(255),
	`instructions` TEXT,
	`job_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `FI_delivery_job` (`job_id`),
	CONSTRAINT `fk_delivery_job`
		FOREIGN KEY (`job_id`)
		REFERENCES `job` (`id`)
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
	`photographer_id` INTEGER,
	`job_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `FI_Job_Photographer_Photographer` (`photographer_id`),
	CONSTRAINT `fk_Job_Photographer_Photographer`
		FOREIGN KEY (`photographer_id`)
		REFERENCES `photographer` (`id`),
	INDEX `FI_Job_Photographer_Job` (`job_id`),
	CONSTRAINT `fk_Job_Photographer_Job`
		FOREIGN KEY (`job_id`)
		REFERENCES `job` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- job_client
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `job_client`;


CREATE TABLE `job_client`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`client_id` INTEGER,
	`job_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `FI_Job_Client_Client` (`client_id`),
	CONSTRAINT `fk_Job_Client_Client`
		FOREIGN KEY (`client_id`)
		REFERENCES `client` (`id`),
	INDEX `FI_Job_Client_Job` (`job_id`),
	CONSTRAINT `fk_Job_Client_Job`
		FOREIGN KEY (`job_id`)
		REFERENCES `job` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_group`;


CREATE TABLE `sf_guard_group`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `sf_guard_group_U_1` (`name`(255))
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_permission
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_permission`;


CREATE TABLE `sf_guard_permission`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `sf_guard_permission_U_1` (`name`(255))
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_group_permission
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_group_permission`;


CREATE TABLE `sf_guard_group_permission`
(
	`group_id` INTEGER  NOT NULL,
	`permission_id` INTEGER  NOT NULL,
	PRIMARY KEY (`group_id`,`permission_id`),
	KEY `sf_guard_group_permission_I_1`(`permission_id`),
	CONSTRAINT `sf_guard_group_permission_FK_1`
		FOREIGN KEY (`group_id`)
		REFERENCES `sf_guard_group` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `sf_guard_group_permission_FK_2`
		FOREIGN KEY (`permission_id`)
		REFERENCES `sf_guard_permission` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user`;


CREATE TABLE `sf_guard_user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(128)  NOT NULL,
	`algorithm` VARCHAR(128)  NOT NULL,
	`salt` VARCHAR(128)  NOT NULL,
	`password` VARCHAR(128)  NOT NULL,
	`created_at` DATETIME,
	`last_login` DATETIME,
	`is_active` TINYINT  NOT NULL,
	`is_super_admin` TINYINT  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `sf_guard_user_U_1` (`username`(128))
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user_permission
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_permission`;


CREATE TABLE `sf_guard_user_permission`
(
	`user_id` INTEGER  NOT NULL,
	`permission_id` INTEGER  NOT NULL,
	PRIMARY KEY (`user_id`,`permission_id`),
	KEY `sf_guard_user_permission_I_1`(`permission_id`),
	CONSTRAINT `sf_guard_user_permission_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `sf_guard_user_permission_FK_2`
		FOREIGN KEY (`permission_id`)
		REFERENCES `sf_guard_permission` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_user_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_user_group`;


CREATE TABLE `sf_guard_user_group`
(
	`user_id` INTEGER  NOT NULL,
	`group_id` INTEGER  NOT NULL,
	PRIMARY KEY (`user_id`,`group_id`),
	KEY `sf_guard_user_group_I_1`(`group_id`),
	CONSTRAINT `sf_guard_user_group_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `sf_guard_user_group_FK_2`
		FOREIGN KEY (`group_id`)
		REFERENCES `sf_guard_group` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sf_guard_remember_key
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_guard_remember_key`;


CREATE TABLE `sf_guard_remember_key`
(
	`user_id` INTEGER  NOT NULL,
	`remember_key` VARCHAR(32),
	`ip_address` VARCHAR(50)  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`user_id`,`ip_address`),
	CONSTRAINT `sf_guard_remember_key_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- log
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `log`;


CREATE TABLE `log`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`message` VARCHAR(255),
	`when` DATETIME,
	`propel_id` INTEGER,
	`propel_class` VARCHAR(255),
	`sf_guard_user_profile_id` INTEGER,
	`log_message_type_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `FI_log_sf_guard_user_profile` (`sf_guard_user_profile_id`),
	CONSTRAINT `fk_log_sf_guard_user_profile`
		FOREIGN KEY (`sf_guard_user_profile_id`)
		REFERENCES `sf_guard_user_profile` (`id`),
	INDEX `FI_log_log_message_type` (`log_message_type_id`),
	CONSTRAINT `fk_log_log_message_type`
		FOREIGN KEY (`log_message_type_id`)
		REFERENCES `log_message_type` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- log_message_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `log_message_type`;


CREATE TABLE `log_message_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type` VARCHAR(64),
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
