<?php
/**
 * Find replace using phpMyadmin
 *
 */
?>

SQL Query

UPDATE `feedsync`
 SET `xml` = replace(xml, 'OLD_URL', 'NEW_URL');