TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`%` TRIGGER trg_catalog_product_entity_datetime_after_insert AFTER INSERT ON catalog_product_entity_datetime FOR EACH ROW\nBEGIN\nINSERT IGNORE INTO `scconnector_google_feed_cl` (`entity_id`) VALUES (NEW.`entity_id`);\nEND' 'CREATE DEFINER=`root`@`%` TRIGGER trg_catalog_product_entity_datetime_after_update AFTER UPDATE ON catalog_product_entity_datetime FOR EACH ROW\nBEGIN\nIF (NEW.`value_id` <=> OLD.`value_id` OR NEW.`attribute_id` <=> OLD.`attribute_id` OR NEW.`store_id` <=> OLD.`store_id` OR NEW.`entity_id` <=> OLD.`entity_id` OR NEW.`value` <=> OLD.`value`) THEN INSERT IGNORE INTO `scconnector_google_feed_cl` (`entity_id`) VALUES (NEW.`entity_id`); END IF;\nEND' 'CREATE DEFINER=`root`@`%` TRIGGER trg_catalog_product_entity_datetime_after_delete AFTER DELETE ON catalog_product_entity_datetime FOR EACH ROW\nBEGIN\nINSERT IGNORE INTO `scconnector_google_feed_cl` (`entity_id`) VALUES (OLD.`entity_id`);\nEND'
sql_modes=0 0 0
definers='root@%' 'root@%' 'root@%'
client_cs_names='utf8' 'utf8' 'utf8'
connection_cl_names='utf8_general_ci' 'utf8_general_ci' 'utf8_general_ci'
db_cl_names='latin1_swedish_ci' 'latin1_swedish_ci' 'latin1_swedish_ci'
created=157425500074 157425500105 157425500109
