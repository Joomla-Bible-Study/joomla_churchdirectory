CREATE TABLE `#__churchdirectory_update` (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  version VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__churchdirectory_details` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `lname` text NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `con_position` text,
  `address` text,
  `suburb` text,
  `state` text,
  `country` text,
  `postcode` varchar(255) DEFAULT NULL,
  `postcodeaddon` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `spouse` text,
  `children` text,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(60) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  `sortname1` varchar(255) NOT NULL,
  `sortname2` varchar(255) NOT NULL,
  `sortname3` varchar(255) NOT NULL,
  `language` char(7) NOT NULL DEFAULT '*',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `xreference` varchar(50) NOT NULL,
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `skype` varchar(255) NOT NULL DEFAULT '',
  `yahoo_msg` varchar(255) NOT NULL DEFAULT '',
  `lat` float(10,6) NOT NULL DEFAULT '36.131973',
  `lng` float(10,6) NOT NULL DEFAULT '-86.812370',
  `team` varchar(2) DEFAULT NULL,
  `teamicon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_catid` (`catid`),
  KEY `idx_access` (`access`),
  KEY `Idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=408 ;

CREATE TABLE IF NOT EXISTS `#__churchdirectory_config` (
`id` INT(11) UNSIGNED NOT NULL auto_increment,
`params` TEXT NOT NULL,
PRIMARY KEY  (`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__churchdirectory_kmloptions` (
  `id` int(11) UNSIGNED NOT NULL auto_increment,
  `name` text NOT NULL,
  `alias` varchar(255) NOT NULL default '',
  `disc` tinytext NOT NULL,
  `addressgp` text NOT NULL,
  `published` tinyint(1) unsigned NOT NULL default '0',
  `checked_out` int(11) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL default '0',
  `params` text NOT NULL,
  `linestyle` varchar(8) NOT NULL default '00000000',
  `polystyle` varchar(8) NOT NULL default '00000000',
  `user_id` int(11) NOT NULL default '0',
  `access` tinyint(3) unsigned NOT NULL default '0',
  `lat` float(10,6) NOT NULL default '36.131973',
  `lng` float(10,6) NOT NULL default '-86.812370',
  `icon` varchar(1) NOT NULL default 'b',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

CREATE TABLE IF NOT EXISTS `#__churchdirectory_admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `drop_tables` int(3) DEFAULT '0',
  `params` text,
  `asset_id` int(10) DEFAULT NULL,
  `access` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;