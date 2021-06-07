CREATE TABLE IF NOT EXISTS `mc_geoip2` (
    `id_gip` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_gip` varchar(150) DEFAULT NULL,
    `key_gip` varchar(125) DEFAULT NULL,
    `ip_gip` varchar(50) DEFAULT NULL,
    `ws_gip` smallint(1) UNSIGNED NOT NULL DEFAULT '0',
    PRIMARY KEY (`id_gip`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `mc_admin_access` (`id_role`, `id_module`, `view`, `append`, `edit`, `del`, `action`)
  SELECT 1, m.id_module, 1, 1, 1, 1, 1 FROM mc_module as m WHERE name = 'geoip2';