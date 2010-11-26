--
-- Table structure for table `dms_aspect`
--

CREATE TABLE IF NOT EXISTS `dms_aspect` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(45) default NULL,
  `created_by` int(11) default NULL,
  `updated_by` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dms_aspect_property_type`
--

CREATE TABLE IF NOT EXISTS `dms_aspect_property_type` (
  `id` int(11) NOT NULL auto_increment,
  `aspect_id` int(11) default NULL,
  `type_id` int(11) default NULL,
  `volgorde` int(11) default NULL,
  `created_by` int(11) default NULL,
  `updated_by` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `FI_dms_aspect_has_dms_node_property_type_dms_aspect1` (`aspect_id`),
  KEY `FI_dms_aspect_has_dms_node_property_type_dms_node_property_ty1` (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dms_node`
--

CREATE TABLE IF NOT EXISTS `dms_node` (
  `id` int(11) NOT NULL auto_increment,
  `store_id` int(11) NOT NULL,
  `parent_id` int(11) default NULL,
  `is_folder` int(11) default NULL,
  `name` varchar(255) collate utf8_bin default NULL,
  `disk_name` varchar(255) collate utf8_bin default NULL,
  `created_by` int(11) default NULL,
  `updated_by` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `FI_tt_file_tt_store1` (`store_id`),
  KEY `FI_tt_file_tt_store2` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Table structure for table `dms_node_aspect`
--

CREATE TABLE IF NOT EXISTS `dms_node_aspect` (
  `id` int(11) NOT NULL auto_increment,
  `node_id` int(11) default NULL,
  `aspect_id` int(11) default NULL,
  `created_by` int(11) default NULL,
  `updated_by` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `FI_dms_node_has_dms_aspect_dms_node1` (`node_id`),
  KEY `FI_dms_node_has_dms_aspect_dms_aspect1` (`aspect_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dms_node_property`
--

CREATE TABLE IF NOT EXISTS `dms_node_property` (
  `id` int(11) NOT NULL auto_increment,
  `node_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `boolean_value` int(11) default NULL,
  `int_value` int(11) default NULL,
  `float_value` double default NULL,
  `string_value` varchar(255) default NULL,
  `text_value` text,
  `created_by` int(11) default NULL,
  `updated_by` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`,`node_id`,`type_id`),
  KEY `FI_tt_node_property_tt_node_property_type` (`type_id`),
  KEY `FI_tt_node_property_tt_node1` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dms_object_node_ref`
--

CREATE TABLE IF NOT EXISTS `dms_object_node_ref` (
  `id` int(11) NOT NULL auto_increment,
  `node_id` int(11) NOT NULL,
  `object_class` varchar(45) default NULL,
  `object_id` int(11) default NULL,
  `created_by` int(11) default NULL,
  `updated_by` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `FI_dms_object_node_ref_dms_node1` (`node_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dms_property_type`
--

CREATE TABLE IF NOT EXISTS `dms_property_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(45) default NULL,
  `data_type` varchar(20) default NULL,
  `created_by` int(11) default NULL,
  `updated_by` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dms_store`
--

CREATE TABLE IF NOT EXISTS `dms_store` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(45) default NULL,
  `uri` varchar(255) default NULL,
  `created_by` int(11) default NULL,
  `updated_by` int(11) default NULL,
  `created_at` datetime default NULL,
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;