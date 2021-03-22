CREATE TABLE `authors`
(
    `author_id` INT UNSIGNED                                           NOT NULL AUTO_INCREMENT,
    `author`    VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    PRIMARY KEY (`author_id`),
    UNIQUE (`author`)
) ENGINE = InnoDB;
