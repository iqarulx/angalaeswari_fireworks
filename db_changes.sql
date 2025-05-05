-- ALTER TABLE `af_product` ADD `description` MEDIUMTEXT NULL DEFAULT NULL AFTER `rate_per_piece`; 

-- ALTER TABLE `af_product` ADD `finished_group_id` MEDIUMTEXT NULL DEFAULT NULL AFTER `rate_per_piece`; 

-- ALTER TABLE `af_consumption_entry` CHANGE `contractor_id` `contractor_id` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 

-- ALTER TABLE `af_consumption_entry` CHANGE `contractor_details` `contractor_details` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `contractor_mobile_city` `contractor_mobile_city` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 

-- ALTER TABLE `af_daily_production` CHANGE `contractor_id` `contractor_id` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `contractor_name_mobile_city` `contractor_name_mobile_city` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `contractor_details` `contractor_details` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL; 

-- ALTER TABLE `af_semifinished_inward` CHANGE `contractor_id` `contractor_id` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `contractor_name_mobile_city` `contractor_name_mobile_city` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL, CHANGE `contractor_details` `contractor_details` MEDIUMTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

ALTER TABLE `af_payment` CHANGE `bill_date` `bill_date` DATETIME NOT NULL; 