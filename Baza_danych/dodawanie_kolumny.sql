DELIMITER $$
DROP PROCEDURE IF EXISTS dodaj_kolumne $$
CREATE PROCEDURE dodaj_kolumne( IN tabela VARCHAR(30),  IN kolumna VARCHAR(30))
BEGIN
IF NOT EXISTS( (SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE()
        AND COLUMN_NAME=kolumna AND TABLE_NAME=tabela) )
THEN
SET @sql = CONCAT('ALTER TABLE `database`.',tabela,' ADD COLUMN ',kolumna,' INT NULL DEFAULT 0;'); 
    PREPARE s1 from @sql;
    EXECUTE s1;
END IF;
END $$
CALL dodaj_kolumne('ulubione_gatunki', 'gat1') $$
DELIMITER ;

