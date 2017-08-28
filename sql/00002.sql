ALTER TABLE `zeapps_contacts` CHANGE `email_opt_out` `opt_out` BOOLEAN NOT NULL;

ALTER TABLE `zeapps_companies` ADD `email` VARCHAR(255) NOT NULL AFTER `comment`, ADD `opt_out` BOOLEAN NOT NULL AFTER `email`;