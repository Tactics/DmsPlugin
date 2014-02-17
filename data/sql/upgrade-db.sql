--------------------------------------------------------------------------------
-- Author: Joris Hontelé
-- Date: 17/02/2014
-- Description: dms_aspect: added system_name
--------------------------------------------------------------------------------
ALTER TABLE `dms_aspect` ADD `system_name` VARCHAR( 100 ) NULL DEFAULT NULL AFTER `name` ;