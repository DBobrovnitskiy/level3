CREATE TABLE `books`
(
    `book_id` INT UNSIGNED                                           NOT NULL AUTO_INCREMENT,
    `book`    VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `pages`   SMALLINT UNSIGNED                                      NULL DEFAULT NULL,
    `year`    SMALLINT UNSIGNED                                      NOT NULL,
    `about`   TEXT CHARACTER SET utf8 COLLATE utf8_general_ci        NULL DEFAULT NULL,
    `author`  VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    PRIMARY KEY (`book_id`)
) ENGINE = InnoDB;
