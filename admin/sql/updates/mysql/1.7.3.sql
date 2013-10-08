--
-- Version 1.7.3 update
--
INSERT INTO `#__churchdirectory_update` (id, version) VALUES (3, '1.7.3')
ON DUPLICATE KEY UPDATE version= '1.7.3';

ALTER TABLE `#__churchdirectory_details` ADD COLUMN `birthdate` DATE NOT NULL DEFAULT '0000-00-00'
AFTER `lng`;
ALTER TABLE `#__churchdirectory_details` ADD COLUMN `anniversary` DATE NOT NULL DEFAULT '0000-00-00'
AFTER `birthdate`;
