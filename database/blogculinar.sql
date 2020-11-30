CREATE SCHEMA `blogculinar` DEFAULT CHARACTER SET utf8 ;
USE blogculinar;
CREATE TABLE `blogculinar.utilizatori` (
  `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `rol` ENUM('Author','Admin') DEFAULT NULL,
  `parola` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ENGINE=InnoDB;

ALTER TABLE `blogculinar`.`utilizatori` 
ADD UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE,
ADD UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE;

CREATE TABLE `blogculinar.postari` (
 `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `user_id` INT DEFAULT NULL,
 `title` VARCHAR(255) NOT NULL,
 `slug` VARCHAR(255) NOT NULL UNIQUE,
 `views` INT NOT NULL DEFAULT '0',
 `poza` VARCHAR(255) NOT NULL,
 `body` TEXT NOT NULL,
 `published` TINYINT(1) NOT NULL,
 `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES `utilizatori` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE `topic` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nume` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL UNIQUE
) ENGINE=InnoDB;

  CREATE TABLE `topic_postari` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `post_id` INT(11)  NOT NULL UNIQUE,
    `topic_id` INT(11) NOT NULL
) ENGINE=InnoDB;

ALTER TABLE `blogculinar`.`topic_postari` 
ADD INDEX `topic_id_idx` (`topic_id` ASC) VISIBLE;
;
ALTER TABLE `blogculinar`.`topic_postari` 
ADD CONSTRAINT `post_id`
  FOREIGN KEY (`post_id`)
  REFERENCES `blogculinar`.`postari` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,
ADD CONSTRAINT `topic_id`
  FOREIGN KEY (`topic_id`)
  REFERENCES `blogculinar`.`topic` (`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
  
CREATE TABLE `blogculinar`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `post_id` INT NOT NULL,
  `cbody` TEXT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
  ENGINE=InnoDB;

INSERT INTO blogculinar.utilizatori(`username`,`email`,`rol`, `parola`) 
VALUES 
('Bogdan','rosu.bogdan@gmail.com','Admin','12345');

INSERT INTO blogculinar.postari(`user_id`,`title`,`slug`, `views`,`poza`,`body`,`published`) 
VALUES 
(1,'LASAGNA','lasagna',0,'lasagna.jpg','Cand nu mai stii ce sa gatesti (fie ca ai copii mofturosi fie ca nu sunt moftuosi) n-ai cum, dar chiar n-ai cum s-o dai in bara cu orice fel de paste: 
						penne, spaghete, lasagna, tortellini, cannelloni…Orisice fel de paste.
						Hai sa va zic acum cum fac eu lasagna, iar in alte postari voi povesti pe rand si despre celelelte retete cu paste.
						Din capul locului va spun ca eu prefer de departe pastele Barilla. Am incercat de-a lungul timpului si alte “modele” iar 
						acum spun doar atat:',1);



INSERT INTO blogculinar.topic(`id`,`name`,`slug`) 
VALUES 
(1,'Aperitiv','aperitiv'),
(2,'Supe','supe');
INSERT INTO blogculinar.topic_postari(`post_id`,`topic_id`) 
VALUES 
(1,1);





-- SELECT * FROM postari ps 
-- 			WHERE ps.id IN 
-- 			(SELECT pt.post_id FROM topic_postari pt 
-- 				WHERE pt.topic_id= 1 GROUP BY pt.post_id 
-- 				HAVING COUNT(1) = 1);
