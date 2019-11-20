TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`%` TRIGGER trg_catalog_product_website_after_insert AFTER INSERT ON catalog_product_website FOR EACH ROW\nBEGIN\nINSERT IGNORE INTO `scconnector_google_remove_cl` (`entity_id`) VALUES (NEW.`product_id`);\nEND' 'CREATE DEFINER=`root`@`%` TRIGGER trg_catalog_product_website_after_update AFTER UPDATE ON catalog_product_website FOR EACH ROW\nBEGIN\nIF (NEW.`product_id` <=> OLD.`product_id` OR NEW.`website_id` <=> OLD.`website_id`) THEN INSERT IGNORE INTO `scconnector_google_remove_cl` (`entity_id`) VALUES (NEW.`product_id`); END IF;\nEND' 'CREATE DEFINER=`root`@`%` TRIGGER trg_catalog_product_website_after_delete AFTER DELETE ON catalog_product_website FOR EACH ROW\nBEGIN\nINSERT IGNORE INTO `scconnector_google_remove_cl` (`entity_id`) VALUES (OLD.`product_id`);\nEND'
sql_modes=0 0 0
definers='root@%' 'root@%' 'root@%'
client_cs_names='utf8' 'utf8' 'utf8'
connection_cl_names='utf8_general_ci' 'utf8_general_ci' 'utf8_general_ci'
db_cl_names='latin1_swedish_ci' 'latin1_swedish_ci' 'latin1_swedish_ci'
created=157425498721 157425498776 157425498777
