CREATE TABLE IF NOT EXISTS `#__booking` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`image_room` VARCHAR(255)  NOT NULL ,
`room_name` VARCHAR(255)  NOT NULL ,
`number_room` INT(11)  NOT NULL ,
`desc` TEXT NOT NULL ,
`price` INT(11)  NOT NULL ,
`area` INT(11)  NOT NULL ,
`beds` TEXT NOT NULL ,
`is_extra_bed` VARCHAR(255)  NOT NULL ,
`utilities` TEXT NOT NULL ,
`language` VARCHAR(5)  NOT NULL ,
`alias` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__booking_order` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`start_date` DATE NOT NULL ,
`end_date` DATE NOT NULL ,
`number_room` INT(11)  NOT NULL ,
`number_persons` DATE NOT NULL ,
`number_children` INT(11)  NOT NULL ,
`order_note` TEXT NOT NULL ,
`name_customer` VARCHAR(255)  NOT NULL ,
`phome` VARCHAR(255)  NOT NULL ,
`email` VARCHAR(255)  NOT NULL ,
`idroom` TEXT NOT NULL ,
`total` FLOAT NOT NULL ,
`parentroom` TEXT NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

