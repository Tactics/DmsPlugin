--------------------------------------------------------------------------------
-- Author: Joris Hontelé
-- Date: 17/02/2014
-- Description: dms_aspect: added system_name
--------------------------------------------------------------------------------
ALTER TABLE `dms_aspect` ADD `system_name` VARCHAR( 100 ) NULL DEFAULT NULL AFTER `name` ;

--------------------------------------------------------------------------------
-- Author: Glenn Van Loock
-- Date: 20/02/2014
-- Description: dms_property_type: added system_name + values
--------------------------------------------------------------------------------
ALTER TABLE `dms_property_type` ADD `system_name` VARCHAR( 100 ) NULL DEFAULT NULL AFTER `name` ;
ALTER TABLE `dms_property_type` ADD `options` TEXT NULL DEFAULT NULL AFTER `data_type` ;

--------------------------------------------------------------------------------
-- Author: Benjamin Boutmans
-- Date: 31/01/2016
-- Description: content_update_at toegevoegd aan dmsnode
--------------------------------------------------------------------------------
ALTER TABLE `dms_node`
ADD COLUMN `content_updated_at` DATETIME NULL DEFAULT NULL COMMENT '' AFTER `disk_name`;

--------------------------------------------------------------------------------
-- Author: Joris Hontelé
-- Date: 31/01/2016
-- Description: nieuwe tabel dms_ws_updated added
--------------------------------------------------------------------------------
CREATE TABLE `dms_ws_updated`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`node_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;
