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