CREATE TABLE `seshat` (
`type` varchar(100) NOT NULL,
`updated_at` datetime NOT NULL DEFAULT current_timestamp(),
`reference` TEXT COLLATE utf8_general_ci DEFAULT NULL,
KEY `idx_type` (`type`),
KEY `idx_updated` (`updated_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




