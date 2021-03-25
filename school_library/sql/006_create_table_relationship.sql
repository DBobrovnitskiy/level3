CREATE TABLE `relation`
(
    `relation_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `book_id`     INT UNSIGNED NOT NULL,
    `author_id`   INT UNSIGNED NOT NULL,
    PRIMARY KEY (`relation_id`)
) ENGINE = InnoDB;
