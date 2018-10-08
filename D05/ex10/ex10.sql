SELECT `title` AS `Title`, `summary` AS `Summary`, `prod_year`
FROM `db_jwolf`.`film` INNER JOIN `db_jwolf`.`genre` ON `db_jwolf`.`film`.`id_genre` = `db_jwolf`.`genre`.`id_genre`
WHERE `db_jwolf`.`genre`.`name` = 'erotic' ORDER BY `prod_year` DESC;