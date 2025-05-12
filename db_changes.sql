ALTER TABLE `af_proforma_invoice` DROP `billing_address`; 

ALTER TABLE `af_estimate` DROP `billing_address`; 

ALTER TABLE `af_delivery_slip` DROP `billing_address`; 

ALTER TABLE `af_estimate` ADD `proforma_invoice_id` MEDIUMTEXT NULL DEFAULT NULL AFTER `delivery_slip_date`; 

ALTER TABLE `af_product` ADD `raw_material_group_id` MEDIUMTEXT NULL DEFAULT NULL AFTER `finished_group_id`; 

ALTER TABLE `af_supplier` ADD `raw_material_group_id` MEDIUMTEXT NULL DEFAULT NULL AFTER `email`; 

ALTER TABLE `af_product` ADD `semi_finished_group_id` MEDIUMTEXT NULL DEFAULT NULL AFTER `raw_material_group_id`;