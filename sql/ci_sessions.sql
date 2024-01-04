CREATE TABLE IF NOT EXISTS `ci_sessions` (
    `id` VARCHAR(40) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `timestamp` INT(10) UNSIGNED NOT NULL DEFAULT 0,
    `data` MEDIUMBLOB NOT NULL,
    KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE = InnoDB;