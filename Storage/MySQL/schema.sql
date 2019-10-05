
CREATE TABLE `users_visitors` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `owner_id` INT NOT NULL,
    `visitor_id` INT NOT NULL,
    `datetime` DATETIME NOT NULL,
    `viewed` BOOLEAN NOT NULL,

    FOREIGN KEY (owner_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (visitor_id) REFERENCES users(id) ON DELETE CASCADE
);