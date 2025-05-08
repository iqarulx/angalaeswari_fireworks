ALTER TABLE `af_proforma_invoice` ADD `billing_address` MEDIUMTEXT NULL DEFAULT NULL AFTER `address`; 

ALTER TABLE `af_delivery_slip` ADD `billing_address` MEDIUMTEXT NULL DEFAULT NULL AFTER `address`; 

ALTER TABLE `af_estimate` ADD `billing_address` MEDIUMTEXT NULL DEFAULT NULL AFTER `address`; 