

CREATE TABLE IF NOT EXISTS links (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	link_name VARCHAR(255) NOT NULL,
	alias VARCHAR(30) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS clicks (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	link_id INTEGER NOT NULL,
	click_date DATETIME NOT NULL,
	FOREIGN KEY (link_id) REFERENCES links(id) ON DELETE CASCADE
);

CREATE TABLE `queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel` varchar(255) NOT NULL,
  `job` blob NOT NULL,
  `pushed_at` int(11) NOT NULL,
  `ttr` int(11) NOT NULL,
  `delay` int(11) NOT NULL DEFAULT 0,
  `priority` int(11) unsigned NOT NULL DEFAULT 1024,
  `reserved_at` int(11) DEFAULT NULL,
  `attempt` int(11) DEFAULT NULL,
  `done_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `channel` (`channel`),
  KEY `reserved_at` (`reserved_at`),
  KEY `priority` (`priority`)
) ENGINE=InnoDB
