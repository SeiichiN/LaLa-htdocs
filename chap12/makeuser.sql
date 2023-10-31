-- inventoryuser

CREATE USER 'inventoryuser'@'localhost'
IDENTIFIED BY 'inventoryuser';

GRANT ALL ON inventory.* TO 'inventoryuser'@'localhost';


-- testdbuser

CREATE USER 'testdbuser'@'localhost'
IDENTIFIED BY 'testdbuser';

GRANT ALL ON testdb.* TO 'testdbuser'@'localhost';

