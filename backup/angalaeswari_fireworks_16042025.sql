

CREATE TABLE `af_agent` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `agent_details` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `commission` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_agent (id, created_date_time, creator, creator_name, agent_id, agent_name, lower_case_name, address, city, district, state, mobile_number, others_city, agent_details, name_mobile_city, commission, opening_balance, opening_balance_type, deleted) VALUES ('1','2025-05-07 18:14:59','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45304e546c664d44453d','566d6c756233526f','646d6c756233526f','NULL','51577868626d523163673d3d','5132686c626d356861513d3d','5647467461577767546d466b64513d3d','4d54497a4e4455324e7a67354d413d3d','','566d6c756233526f50474a79506b46735957356b64584938596e492b5132686c626d35686153684561584e304c696b38596e492b5647467461577767546d466b64547869636a3467545739696157786c49446f674d54497a4e4455324e7a67354d413d3d','566d6c756233526f494367784d6a4d304e5459334f446b774b534174494546735957356b6458493d','20%','','','0');


CREATE TABLE `af_bank` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `account_name` mediumtext NOT NULL,
  `account_number` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `ifsc_code` mediumtext NOT NULL,
  `account_type` mediumtext NOT NULL,
  `bank_name_account_number` mediumtext NOT NULL,
  `branch` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `estimate_balance_date` mediumtext NOT NULL,
  `invoice_balance_date` mediumtext NOT NULL,
  `estimate_opening_balance` mediumtext NOT NULL,
  `invoice_opening_balance` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_bank (id, created_date_time, creator, creator_name, bill_company_id, bank_id, account_name, account_number, bank_name, ifsc_code, account_type, bank_name_account_number, branch, payment_mode_id, estimate_balance_date, invoice_balance_date, estimate_opening_balance, invoice_opening_balance, opening_balance, opening_balance_type, deleted) VALUES ('1','2025-05-07 18:18:49','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','51584a3162413d3d','4d54497a4e4455324e7a67354d44413d','55304a4a','NULL','NULL','55304a4a494367784d6a4d304e5459334f446b774d436b3d','55326c325957746863326b3d','4d4463774e5449774d6a55774e6a45344d6a64664d444d3d,4d4463774e5449774d6a55774e6a45344d6a64664d44493d','','','','','','','0');


CREATE TABLE `af_charges` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `charges_id` mediumtext NOT NULL,
  `charges_name` mediumtext NOT NULL,
  `action` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_charges (id, created_date_time, creator, creator_name, charges_id, charges_name, action, lower_case_name, deleted) VALUES ('1','2025-05-07 18:19:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45354d544e664d44453d','51326868636d646c63773d3d','minus','59326868636d646c63773d3d','0');

INSERT INTO af_charges (id, created_date_time, creator, creator_name, charges_id, charges_name, action, lower_case_name, deleted) VALUES ('2','2025-05-07 18:19:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45354d544e664d44493d','52476c7a59323931626e513d','plus','5a476c7a59323931626e513d','0');


CREATE TABLE `af_company` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `company_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `pincode` mediumtext NOT NULL,
  `gst_number` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `company_details` mediumtext NOT NULL,
  `logo` mediumtext NOT NULL,
  `primary_company` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_company (id, created_date_time, creator, creator_name, company_id, name, lower_case_name, address, state, district, city, others_city, pincode, gst_number, mobile_number, company_details, logo, primary_company, deleted) VALUES ('1','2025-04-29 17:18:35','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d6a6b774e4449774d6a55774e5445344d7a56664d44453d','5157356e595778685a584e3359584a7049455a70636d563362334a7263794242626d64686247466c63336468636d6b67526d6c795a586476636d747a','5957356e595778685a584e3359584a7049475a70636d563362334a7263794268626d64686247466c63336468636d6b675a6d6c795a586476636d747a','4d6938314e544d74565377674d6938314e544d745669776755326c325957746863326b6754574670626942536232466b','5647467461577767546d466b64513d3d','566d6c796457526f645735685a324679','5532463064485679','NULL','4e6a49324d6a417a','4d6a4a4251554642515441774d4442424d566f31','4f5441354d446b774f5441354d413d3d','5157356e595778685a584e3359584a7049455a70636d563362334a7263794242626d64686247466c63336468636d6b67526d6c795a586476636d747a4a43516b4d6938314e544d74565377674d6938314e544d745669776755326c325957746863326b6754574670626942536232466b4a43516b5532463064485679494330674e6a49324d6a417a4a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6a6b774f5441354d446b774f54416b4a43516752314e5549456c4f49446f794d6b4642515546424d4441774d454578576a553d','logo_29_04_2025_05_18_34.png','1','0');


CREATE TABLE `af_consumption_entry` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `company_details` mediumtext NOT NULL,
  `consumption_id` mediumtext NOT NULL,
  `entry_date` mediumtext NOT NULL,
  `consumption_entry_number` mediumtext NOT NULL,
  `contractor_id` mediumtext DEFAULT NULL,
  `contractor_details` mediumtext DEFAULT NULL,
  `contractor_mobile_city` mediumtext DEFAULT NULL,
  `godown_type` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `unit_type` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL DEFAULT '',
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_consumption_entry (id, created_date_time, creator, creator_name, bill_company_id, company_details, consumption_id, entry_date, consumption_entry_number, contractor_id, contractor_details, contractor_mobile_city, godown_type, godown_id, product_id, quantity, content, unit_type, total_quantity, cancelled, deleted) VALUES ('1','2025-05-07 20:56:15','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','5157356e595778685a584e3359584a7049455a70636d563362334a7263794242626d64686247466c63336468636d6b67526d6c795a586476636d747a4a43516b4d6938314e544d74565377674d6938314e544d745669776755326c325957746863326b6754574670626942536232466b4a43516b5532463064485679494330674e6a49324d6a417a4a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6a6b774f5441354d446b774f54416b4a43516752314e5549456c4f49446f794d6b4642515546424d4441774d454578576a553d','4d4463774e5449774d6a55774f4455324d5456664d44453d','2025-05-07','CON001/25-26','','','','1','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d,4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d4459774e5449774d6a55774e7a41314d7a52664d44513d,4d4459774e5449774d6a55774e7a41794d6a4a664d44493d','10,10','10,NULL','1,1','20','0','0');

INSERT INTO af_consumption_entry (id, created_date_time, creator, creator_name, bill_company_id, company_details, consumption_id, entry_date, consumption_entry_number, contractor_id, contractor_details, contractor_mobile_city, godown_type, godown_id, product_id, quantity, content, unit_type, total_quantity, cancelled, deleted) VALUES ('2','2025-05-07 23:02:29','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','5157356e595778685a584e3359584a7049455a70636d563362334a7263794242626d64686247466c63336468636d6b67526d6c795a586476636d747a4a43516b4d6938314e544d74565377674d6938314e544d745669776755326c325957746863326b6754574670626942536232466b4a43516b5532463064485679494330674e6a49324d6a417a4a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6a6b774f5441354d446b774f54416b4a43516752314e5549456c4f49446f794d6b4642515546424d4441774d454578576a553d','4d4463774e5449774d6a55784d5441794d6a6c664d44493d','2025-05-07','CON002/25-26','','','','1','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d4463774e5449774d6a55784d5441784e5464664d44633d','1','NULL','1','1','0','0');


CREATE TABLE `af_contractor` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `contractor_id` mediumtext NOT NULL,
  `contractor_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `location` mediumtext NOT NULL,
  `mobile` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `lowercase_name_location` mediumtext NOT NULL,
  `contractor_details` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_contractor (id, created_date_time, creator, creator_name, bill_company_id, contractor_id, contractor_name, lower_case_name, location, mobile, name_mobile_city, lowercase_name_location, contractor_details, opening_balance, opening_balance_type, deleted) VALUES ('1','2025-05-04 13:23:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4451774e5449774d6a55774d54497a4d6a4a664d44453d','5157356e5957786c63336468636d6b67526d6c795a586476636d747a','5957356e5957786c63336468636d6b675a6d6c795a586476636d747a','55326c325957746863326b3d','4f5441774d4441354d4441774d413d3d','5157356e5957786c63336468636d6b67526d6c795a586476636d747a494367354d4441774d446b774d4441774b53416f55326c325957746863326b70','5957356e5957786c63336468636d6b675a6d6c795a586476636d747a4943306763326c325957746863326b3d','','NULL','Credit','0');


CREATE TABLE `af_contractor_product` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `contractor_id` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `subunit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `subunit_name` mediumtext NOT NULL,
  `unit_type` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `rate_per_unit` mediumtext NOT NULL,
  `rate_per_subunit` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `af_customer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `customer_id` mediumtext NOT NULL,
  `customer_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name` mediumtext NOT NULL,
  `customer_details` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_customer (id, created_date_time, creator, creator_name, customer_id, customer_name, lower_case_name, address, city, district, state, identification, mobile_number, others_city, agent_id, agent_name, customer_details, opening_balance, opening_balance_type, name_mobile_city, deleted) VALUES ('1','2025-05-07 18:15:27','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45314d6a64664d44453d','5457466f5a584e6f','6257466f5a584e6f','NULL','5132686c626d64686248426864485231','5132686c626d64686248426864485231','5647467461577767546d466b64513d3d','NULL','4e5459334f446b774e4455324e773d3d','','4d4463774e5449774d6a55774e6a45304e546c664d44453d','566d6c756233526f','5457466f5a584e6f4a43516b5132686c626d646862484268644852314a43516b5132686c626d646862484268644852314b455270633351754b53516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f674e5459334f446b774e4455324e773d3d','','','5457466f5a584e6f494367314e6a63344f5441304e5459334b53417449454e6f5a57356e595778775958523064513d3d','0');

INSERT INTO af_customer (id, created_date_time, creator, creator_name, customer_id, customer_name, lower_case_name, address, city, district, state, identification, mobile_number, others_city, agent_id, agent_name, customer_details, opening_balance, opening_balance_type, name_mobile_city, deleted) VALUES ('2','2025-05-07 18:17:37','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','6333566b6147453d','NULL','5132686c626d64686248426864485231','5132686c626d64686248426864485231','5647467461577767546d466b64513d3d','NULL','4f446b774f5467334d7a67354d773d3d','','','','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','','','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','0');


CREATE TABLE `af_daily_production` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL DEFAULT '',
  `company_details` mediumtext NOT NULL,
  `daily_production_id` mediumtext NOT NULL,
  `daily_production_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name_location` mediumtext NOT NULL,
  `factory_details` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `magazine_name_location` mediumtext NOT NULL,
  `magazine_details` mediumtext NOT NULL,
  `contractor_id` mediumtext DEFAULT NULL,
  `contractor_name_mobile_city` mediumtext DEFAULT NULL,
  `contractor_details` mediumtext DEFAULT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `subunit_contains` mediumtext NOT NULL,
  `cooly_per_qty` mediumtext NOT NULL,
  `cooly_rate` mediumtext NOT NULL,
  `overall_cooly_total` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_daily_production (id, created_date_time, creator, creator_name, bill_company_id, company_details, daily_production_id, daily_production_number, entry_date, factory_id, factory_name_location, factory_details, magazine_id, magazine_name_location, magazine_details, contractor_id, contractor_name_mobile_city, contractor_details, product_id, product_name, unit_id, unit_name, quantity, subunit_contains, cooly_per_qty, cooly_rate, overall_cooly_total, total_quantity, cancelled, deleted) VALUES ('1','2025-05-07 23:02:56','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','5157356e595778685a584e3359584a7049455a70636d563362334a7263794242626d64686247466c63336468636d6b67526d6c795a586476636d747a4a43516b4d6938314e544d74565377674d6938314e544d745669776755326c325957746863326b6754574670626942536232466b4a43516b5532463064485679494330674e6a49324d6a417a4a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6a6b774f5441354d446b774f54416b4a43516752314e5549456c4f49446f794d6b4642515546424d4441774d454578576a553d','4d4463774e5449774d6a55784d5441794e545a664d44453d','DAP001/25-26','2025-05-07','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','','','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','526d7876643256794946427664484d6751584e6f62327468','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','10','45','','','','10','0','0');

INSERT INTO af_daily_production (id, created_date_time, creator, creator_name, bill_company_id, company_details, daily_production_id, daily_production_number, entry_date, factory_id, factory_name_location, factory_details, magazine_id, magazine_name_location, magazine_details, contractor_id, contractor_name_mobile_city, contractor_details, product_id, product_name, unit_id, unit_name, quantity, subunit_contains, cooly_per_qty, cooly_rate, overall_cooly_total, total_quantity, cancelled, deleted) VALUES ('2','2025-05-07 23:03:43','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','5157356e595778685a584e3359584a7049455a70636d563362334a7263794242626d64686247466c63336468636d6b67526d6c795a586476636d747a4a43516b4d6938314e544d74565377674d6938314e544d745669776755326c325957746863326b6754574670626942536232466b4a43516b5532463064485679494330674e6a49324d6a417a4a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6a6b774f5441354d446b774f54416b4a43516752314e5549456c4f49446f794d6b4642515546424d4441774d454578576a553d','4d4463774e5449774d6a55784d54417a4e444e664d44493d','DAP002/25-26','2025-05-07','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','','','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','526d7876643256794946427664484d6751584e6f6232746849455a736233646c636942516233527a4945467a6147397259513d3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','10','45','','','','10','0','0');


CREATE TABLE `af_delivery_slip` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `delivery_slip_id` mediumtext NOT NULL,
  `delivery_slip_number` mediumtext NOT NULL,
  `delivery_slip_date` mediumtext NOT NULL,
  `proforma_invoice_id` mediumtext NOT NULL,
  `proforma_invoice_number` mediumtext NOT NULL,
  `proforma_invoice_date` mediumtext NOT NULL,
  `customer_id` mediumtext NOT NULL,
  `customer_name_mobile_city` mediumtext NOT NULL,
  `customer_details` mediumtext NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name_mobile_city` mediumtext NOT NULL,
  `agent_details` mediumtext NOT NULL,
  `transport_id` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `magazine_type` mediumtext DEFAULT NULL,
  `magazine_id` mediumtext DEFAULT NULL,
  `gst_option` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `billing_address` mediumtext DEFAULT NULL,
  `tax_option` mediumtext NOT NULL,
  `tax_type` mediumtext NOT NULL,
  `overall_tax` mediumtext NOT NULL,
  `company_state` mediumtext NOT NULL,
  `party_state` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `indv_magazine_id` mediumtext DEFAULT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_type` mediumtext NOT NULL,
  `subunit_need` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `per` mediumtext NOT NULL,
  `per_type` mediumtext NOT NULL,
  `product_tax` mediumtext NOT NULL,
  `final_rate` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `other_charges_id` mediumtext NOT NULL,
  `charges_type` mediumtext NOT NULL,
  `other_charges_value` mediumtext NOT NULL,
  `agent_commission` mediumtext NOT NULL,
  `bill_total` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_delivery_slip (id, created_date_time, creator, creator_name, bill_company_id, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, bill_total, cancelled, deleted) VALUES ('1','2025-05-07 18:26:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774e6a49324d6a4a664d44453d','DS001/25-26','2025-05-07','4d4463774e5449774d6a55774e6a49324d4468664d44493d','PI002/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','1','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','','','','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','526d7876643256794946427664484d6751584e6f62327468','1','1','45','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','2','2000','1','1','NULL','2000','4000.00','NULL','NULL','NULL','','4000.00','0','0');

INSERT INTO af_delivery_slip (id, created_date_time, creator, creator_name, bill_company_id, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, bill_total, cancelled, deleted) VALUES ('2','2025-05-07 18:27:03','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774e6a49334d444e664d44493d','DS002/25-26','2025-05-07','4d4463774e5449774d6a55774e6a49324d7a6c664d444d3d','PI003/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','1','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','','','','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','526d7876643256794946427664484d6751584e6f62327468','1','1','45','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','2','2000','1','1','NULL','2000','4000.00','NULL','NULL','NULL','','4000.00','0','0');

INSERT INTO af_delivery_slip (id, created_date_time, creator, creator_name, bill_company_id, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, bill_total, cancelled, deleted) VALUES ('3','2025-05-07 21:20:26','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774f5449774d6a5a664d444d3d','DS003/25-26','2025-05-07','4d4463774e5449774d6a55774f5445334e4456664d44553d','PI005/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','1','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','','','','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','','515852766253424362323169','1','1','50','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','20','1','2','NULL','1000','1000.00','NULL','NULL','NULL','','1000.00','0','0');

INSERT INTO af_delivery_slip (id, created_date_time, creator, creator_name, bill_company_id, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, bill_total, cancelled, deleted) VALUES ('4','2025-05-07 21:51:17','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774f5455784d5464664d44513d','DS004/25-26','2025-05-07','4d4463774e5449774d6a55774f5451324d6a4a664d44593d','PI006/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','1','4d4463774e5449774d6a55774e6a51774d4456664d44493d','','Test','Test','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','','515852766253424362323169','1','1','60','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','20','1','2','NULL','1200','1200.00','NULL','NULL','NULL','','1200.00','0','0');

INSERT INTO af_delivery_slip (id, created_date_time, creator, creator_name, bill_company_id, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, bill_total, cancelled, deleted) VALUES ('5','2025-05-07 21:58:02','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774f5455344d444a664d44553d','DS005/25-26','2025-05-07','4d4463774e5449774d6a55774f5455334e5442664d44633d','PI007/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45314d6a64664d44453d','5457466f5a584e6f494367314e6a63344f5441304e5459334b534174494546746157357161577468636d4670','5457466f5a584e6f4a43516b51573170626d70706132467959576b6b4a43524461475675626d46704b455270633351754b53516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f674e5459334f446b774e4455324e773d3d','4d4463774e5449774d6a55774e6a45304e546c664d44453d','566d6c756233526f494367784d6a4d304e5459334f446b774b534174494546735957356b6458493d','566d6c756233526f50474a79506b46735957356b64584938596e492b5132686c626d35686153684561584e304c696b38596e492b5647467461577767546d466b64547869636a3467545739696157786c49446f674d54497a4e4455324e7a67354d413d3d','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','1','4d4463774e5449774d6a55774e6a51774d4456664d44493d','','','','','','NULL','Tamil Nadu','Tamil Nadu','4d4463774e5449774d6a55774e6a49314d446c664d44553d','','526d7876643256794946427664484d6751584e6f62327468','1','1','45','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','2000','1','1','NULL','2000','2000.00','NULL','NULL','NULL','','2000.00','0','0');


CREATE TABLE `af_estimate` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `estimate_id` mediumtext NOT NULL,
  `estimate_number` mediumtext NOT NULL,
  `estimate_date` mediumtext NOT NULL,
  `delivery_slip_id` mediumtext NOT NULL,
  `delivery_slip_number` mediumtext NOT NULL,
  `delivery_slip_date` mediumtext NOT NULL,
  `customer_id` mediumtext NOT NULL,
  `customer_name_mobile_city` mediumtext NOT NULL,
  `customer_details` mediumtext NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name_mobile_city` mediumtext NOT NULL,
  `agent_details` mediumtext NOT NULL,
  `transport_id` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `magazine_type` mediumtext DEFAULT NULL,
  `magazine_id` mediumtext DEFAULT NULL,
  `gst_option` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `billing_address` mediumtext DEFAULT NULL,
  `tax_option` mediumtext NOT NULL,
  `tax_type` mediumtext NOT NULL,
  `overall_tax` mediumtext NOT NULL,
  `company_state` mediumtext NOT NULL,
  `party_state` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `indv_magazine_id` mediumtext DEFAULT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_type` mediumtext NOT NULL,
  `subunit_need` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `per` mediumtext NOT NULL,
  `per_type` mediumtext NOT NULL,
  `product_tax` mediumtext NOT NULL,
  `final_rate` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `other_charges_id` mediumtext NOT NULL,
  `charges_type` mediumtext NOT NULL,
  `other_charges_value` mediumtext NOT NULL,
  `agent_commission` mediumtext NOT NULL,
  `sub_total` mediumtext DEFAULT NULL,
  `grand_total` mediumtext DEFAULT NULL,
  `cgst_value` mediumtext DEFAULT NULL,
  `sgst_value` mediumtext DEFAULT NULL,
  `igst_value` mediumtext DEFAULT NULL,
  `total_tax_value` mediumtext DEFAULT NULL,
  `round_off` mediumtext DEFAULT NULL,
  `other_charges_total` mediumtext DEFAULT NULL,
  `bill_total` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_estimate (id, created_date_time, creator, creator_name, bill_company_id, estimate_id, estimate_number, estimate_date, delivery_slip_id, delivery_slip_number, delivery_slip_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('1','2025-05-07 21:53:59','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774f54557a4e546c664d44453d','EST001/25-26','2025-05-07','4d4463774e5449774d6a55774f5455784d5464664d44513d','DS004/25-26','','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','','Test','Test','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','','515852766253424362323169','1','1','60','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','20','1','2','','1200','1200.00','NULL','NULL','NULL','','1200','1200.00','0','0','0','0','0','NULL','1200.00','0','0');

INSERT INTO af_estimate (id, created_date_time, creator, creator_name, bill_company_id, estimate_id, estimate_number, estimate_date, delivery_slip_id, delivery_slip_number, delivery_slip_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('2','2025-05-07 21:54:39','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774f5455304d7a6c664d44493d','EST002/25-26','2025-05-07','4d4463774e5449774d6a55774f5455784d5464664d44513d','DS004/25-26','','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','','Test','Test','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','','515852766253424362323169','1','1','60','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','20','1','2','','1200','1200.00','NULL','NULL','NULL','','1200','1200.00','0','0','0','0','0','NULL','1200.00','0','0');

INSERT INTO af_estimate (id, created_date_time, creator, creator_name, bill_company_id, estimate_id, estimate_number, estimate_date, delivery_slip_id, delivery_slip_number, delivery_slip_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('3','2025-05-07 21:58:18','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774f5455344d5468664d444d3d','EST003/25-26','2025-05-07','4d4463774e5449774d6a55774f5455344d444a664d44553d','DS005/25-26','','4d4463774e5449774d6a55774e6a45314d6a64664d44453d','5457466f5a584e6f494367314e6a63344f5441304e5459334b534174494546746157357161577468636d4670','5457466f5a584e6f4a43516b51573170626d70706132467959576b6b4a43524461475675626d46704b455270633351754b53516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f674e5459334f446b774e4455324e773d3d','4d4463774e5449774d6a55774e6a45304e546c664d44453d','566d6c756233526f494367784d6a4d304e5459334f446b774b534174494546735957356b6458493d','566d6c756233526f50474a79506b46735957356b64584938596e492b5132686c626d35686153684561584e304c696b38596e492b5647467461577767546d466b64547869636a3467545739696157786c49446f674d54497a4e4455324e7a67354d413d3d','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','1','','','1','2','12%','Tamil Nadu','Tamil Nadu','4d4463774e5449774d6a55774e6a49314d446c664d44553d','','526d7876643256794946427664484d6751584e6f6232746849455a736233646c636942516233527a4945467a6147397259513d3d','1','1','45','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','2000','1','1','','2000','2000.00','NULL','NULL','NULL','20','2000','1600.00','96.00','96.00','0','192.00','0','NULL','1792','0','0');


CREATE TABLE `af_expense` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `expense_id` mediumtext NOT NULL,
  `expense_number` mediumtext NOT NULL,
  `expense_date` date NOT NULL,
  `expense_category_id` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `af_expense_category` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `expense_category_id` mediumtext NOT NULL,
  `expense_category_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `af_factory` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `location` mediumtext NOT NULL,
  `incharge_name` mediumtext NOT NULL,
  `lowercase_incharge_name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `name_location` mediumtext NOT NULL,
  `lowercase_name_location` mediumtext NOT NULL,
  `factory_details` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_factory (id, created_date_time, creator, creator_name, factory_id, factory_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, factory_details, deleted) VALUES ('1','2025-05-06 18:28:36','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','63326c325957746863326b3d','55326c325957746863326b3d','51584a3162413d3d','59584a3162413d3d','4f4459784d4441324d5467304e413d3d','51584a3162413d3d','51575274615734784d6a4e41','55326c325957746863326b674c53425461585a686132467a61513d3d','63326c325957746863326b674c53427a61585a686132467a61513d3d','55326c325957746863326b6b4a43525461585a686132467a6153516b4a456c7559326868636d646c4943306751584a316243416f4f4459784d4441324d5467304e436b3d','0');

INSERT INTO af_factory (id, created_date_time, creator, creator_name, factory_id, factory_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, factory_details, deleted) VALUES ('2','2025-05-07 18:40:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b3d','63334a70646d6b3d','55334a70646d6c7362476c77645852306458493d','55326868626d31315a324674','63326868626d31315a324674','4f446b334e6a67344f546b334e773d3d','63326868626d31315a324674','51575274615734784d6a4e41','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','63334a70646d6b674c53427a636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','0');


CREATE TABLE `af_finished_group` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `finished_group_id` mediumtext NOT NULL,
  `finished_group_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `af_godown` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `location` mediumtext NOT NULL,
  `incharge_name` mediumtext NOT NULL,
  `lowercase_incharge_name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `name_location` mediumtext NOT NULL,
  `lowercase_name_location` mediumtext NOT NULL,
  `godown_details` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_godown (id, created_date_time, creator, creator_name, godown_id, godown_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, godown_details, factory_id, deleted) VALUES ('1','2025-05-06 18:28:36','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','63326c325957746863326b3d','55326c325957746863326b3d','51584a3162413d3d','59584a3162413d3d','4f4459784d4441324d5467304e413d3d','51584a3162413d3d','51575274615734784d6a4e41','55326c325957746863326b674c53425461585a686132467a61513d3d','63326c325957746863326b674c53427a61585a686132467a61513d3d','55326c325957746863326b6b4a43525461585a686132467a6153516b4a456c7559326868636d646c4943306751584a316243416f4f4459784d4441324d5467304e436b3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','0');

INSERT INTO af_godown (id, created_date_time, creator, creator_name, godown_id, godown_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, godown_details, factory_id, deleted) VALUES ('2','2025-05-07 18:40:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b3d','63334a70646d6b3d','55334a70646d6c7362476c77645852306458493d','55326868626d31315a324674','63326868626d31315a324674','4f446b334e6a67344f546b334e773d3d','63326868626d31315a324674','51575274615734784d6a4e41','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','63334a70646d6b674c53427a636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','0');


CREATE TABLE `af_group` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `group_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_group (id, created_date_time, creator, creator_name, group_id, group_name, lower_case_name, deleted) VALUES ('1','2025-04-12 10:52:32','4d446b784d6a49774d6a51774d544d324d6a68664d44513d','55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','5a6d6c7561584e6f5a57513d','0');

INSERT INTO af_group (id, created_date_time, creator, creator_name, group_id, group_name, lower_case_name, deleted) VALUES ('2','2025-04-12 10:52:47','4d446b784d6a49774d6a51774d544d324d6a68664d44513d','55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d','4d5449774e4449774d6a55784d4455794e4464664d44493d','5532567461534247615735706332686c5a413d3d','633256746153426d615735706332686c5a413d3d','0');

INSERT INTO af_group (id, created_date_time, creator, creator_name, group_id, group_name, lower_case_name, deleted) VALUES ('3','2025-04-12 10:53:02','4d446b784d6a49774d6a51774d544d324d6a68664d44513d','55334a706332396d64486468636d5636494367324d7a67794d7a4d784e4441344b513d3d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','556d4633494531686447567961574673','636d4633494731686447567961574673','0');


CREATE TABLE `af_login` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `loginer_name` mediumtext NOT NULL,
  `login_date_time` datetime NOT NULL,
  `logout_date_time` datetime NOT NULL,
  `ip_address` mediumtext NOT NULL,
  `browser` mediumtext NOT NULL,
  `os_detail` mediumtext NOT NULL,
  `type` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('1','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-06 18:22:04','2025-05-06 18:22:04','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('2','51584a316243416f4f4459784d4441324d5467304e436b3d','2025-05-06 18:37:27','2025-05-06 18:37:44','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Factory Incharge','4d4459774e5449774d6a55774e6a49344d7a5a664d44493d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('3','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-06 19:00:43','2025-05-06 19:00:43','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('4','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-07 13:58:30','2025-05-07 13:58:30','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('5','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-07 18:11:08','2025-05-07 18:11:08','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('6','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-08 00:03:14','2025-05-08 00:03:14','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('7','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-08 06:47:50','2025-05-08 06:47:50','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('8','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-08 09:19:35','2025-05-08 09:19:35','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('9','545856756157467959576f674b4451314e6a63344f5441354f446370','2025-05-08 10:12:32','2025-05-08 10:12:32','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Staff','4d4463774e5449774d6a55774e6a45794d5446664d444d3d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('10','545856756157467959576f674b4451314e6a63344f5441354f446370','2025-05-08 10:18:24','2025-05-08 10:18:24','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Staff','4d4463774e5449774d6a55774e6a45794d5446664d444d3d','0');


CREATE TABLE `af_magazine` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `magazine_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `location` mediumtext NOT NULL,
  `incharge_name` mediumtext NOT NULL,
  `lowercase_incharge_name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `name_location` mediumtext NOT NULL,
  `lowercase_name_location` mediumtext NOT NULL,
  `magazine_details` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_magazine (id, created_date_time, creator, creator_name, magazine_id, magazine_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, magazine_details, factory_id, godown_id, deleted) VALUES ('1','2025-05-06 18:28:36','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','63326c325957746863326b3d','55326c325957746863326b3d','51584a3162413d3d','59584a3162413d3d','4f4459784d4441324d5467304e413d3d','51584a3162413d3d','51575274615734784d6a4e41','55326c325957746863326b674c53425461585a686132467a61513d3d','63326c325957746863326b674c53427a61585a686132467a61513d3d','55326c325957746863326b6b4a43525461585a686132467a6153516b4a456c7559326868636d646c4943306751584a316243416f4f4459784d4441324d5467304e436b3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','','0');

INSERT INTO af_magazine (id, created_date_time, creator, creator_name, magazine_id, magazine_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, magazine_details, factory_id, godown_id, deleted) VALUES ('2','2025-05-07 18:40:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b3d','63334a70646d6b3d','55334a70646d6c7362476c77645852306458493d','55326868626d31315a324674','63326868626d31315a324674','4f446b334e6a67344f546b334e773d3d','63326868626d31315a324674','51575274615734784d6a4e41','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','63334a70646d6b674c53427a636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','','0');


CREATE TABLE `af_material_transfer` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `material_transfer_id` mediumtext NOT NULL,
  `material_transfer_date` date NOT NULL,
  `material_transfer_number` mediumtext NOT NULL,
  `location` mediumtext NOT NULL,
  `from_location` mediumtext NOT NULL,
  `to_location` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_type` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `subunit_id` mediumtext NOT NULL,
  `subunit_name` mediumtext NOT NULL,
  `negative` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `quantity_limit` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  `cancelled` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `af_payment` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL DEFAULT '',
  `bill_id` mediumtext NOT NULL,
  `bill_number` mediumtext NOT NULL,
  `bill_date` datetime NOT NULL,
  `bill_type` mediumtext NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `open_balance_type` mediumtext NOT NULL,
  `credit` mediumtext NOT NULL,
  `debit` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('1','2025-05-07 21:53:59','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d4463774e5449774d6a55774f54557a4e546c664d44453d','EST001/25-26','2025-05-07 00:00:00','Estimate','NULL','','NULL','NULL','Agent','NULL','NULL','NULL','NULL','Debit','0','1200.00','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('2','2025-05-07 21:54:39','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d4463774e5449774d6a55774f5455304d7a6c664d44493d','EST002/25-26','2025-05-07 00:00:00','Estimate','NULL','','NULL','NULL','Agent','NULL','NULL','NULL','NULL','Debit','0','1200.00','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('3','2025-05-07 21:58:18','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d4463774e5449774d6a55774f5455344d5468664d444d3d','EST003/25-26','2025-05-08 00:00:00','Estimate','4d4463774e5449774d6a55774e6a45304e546c664d44453d','566d6c756233526f','NULL','NULL','Agent','NULL','NULL','NULL','NULL','Debit','0','1792','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('4','2025-05-07 22:20:44','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d4463774e5449774d6a55784d4449774e4452664d44453d','001','2025-05-07 00:00:00','Purchase Bill','NULL','NULL','4d4463774e5449774d6a55784d4449774d445a664d44453d','556d467449464e68626d746863673d3d','Supplier','NULL','NULL','NULL','NULL','Credit','100.00','0','0');


CREATE TABLE `af_payment_mode` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `lower_case_number` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_payment_mode (id, created_date_time, creator, creator_name, payment_mode_id, payment_mode_name, lower_case_name, lower_case_number, deleted) VALUES ('1','2025-05-07 18:18:27','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45344d6a64664d44453d','5132467a61413d3d','5932467a61413d3d','','0');

INSERT INTO af_payment_mode (id, created_date_time, creator, creator_name, payment_mode_id, payment_mode_name, lower_case_name, lower_case_number, deleted) VALUES ('2','2025-05-07 18:18:27','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45344d6a64664d44493d','55476876626d56775a513d3d','63476876626d56775a513d3d','','0');

INSERT INTO af_payment_mode (id, created_date_time, creator, creator_name, payment_mode_id, payment_mode_name, lower_case_name, lower_case_number, deleted) VALUES ('3','2025-05-07 18:18:27','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45344d6a64664d444d3d','554746356447303d','634746356447303d','','0');


CREATE TABLE `af_product` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL DEFAULT '',
  `creator_name` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `group_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `hsn_code` int(11) NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `subunit_need` mediumtext NOT NULL,
  `subunit_id` mediumtext NOT NULL,
  `subunit_name` mediumtext NOT NULL,
  `subunit_contains` mediumtext NOT NULL,
  `sales_rate` mediumtext NOT NULL,
  `per` mediumtext NOT NULL,
  `per_type` mediumtext NOT NULL,
  `negative_stock` mediumtext NOT NULL,
  `opening_stock` mediumtext NOT NULL,
  `unit_type` mediumtext NOT NULL,
  `stock_date` mediumtext NOT NULL,
  `location_id` mediumtext NOT NULL,
  `location_name` mediumtext NOT NULL,
  `rate_per_case` mediumtext DEFAULT NULL,
  `rate_per_piece` mediumtext DEFAULT NULL,
  `finished_group_id` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, description, deleted) VALUES ('1','2025-05-06 19:01:39','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','4d4459774e5449774d6a55774e7a41784d7a6c664d44453d','55484a765a48566a64434178','63484a765a48566a64434178','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','0','NULL','NULL','','2000','1','1','0','500','1','2025-05-06','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','NULL','NULL','NULL','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, description, deleted) VALUES ('2','2025-05-06 19:02:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','556d4633494531686447567961574673','4d4459774e5449774d6a55774e7a41794d6a4a664d44493d','556d46334944453d','636d46334944453d','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','0','NULL','NULL','','NULL','NULL','NULL','0','500','1','2025-05-06','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','NULL','NULL','NULL','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, description, deleted) VALUES ('3','2025-05-06 19:04:24','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','4d4459774e5449774d6a55774e7a41304d6a52664d444d3d','556d46334944493d','636d46334944493d','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','10','200','1','1','0','500','1','2025-05-06','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','NULL','NULL','NULL','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, description, deleted) VALUES ('4','2025-05-06 19:05:34','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794e4464664d44493d','5532567461534247615735706332686c5a413d3d','4d4459774e5449774d6a55774e7a41314d7a52664d44513d','5532567461534178','6332567461534178','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','10','NULL','NULL','NULL','0','500','1','2025-05-06','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','NULL','NULL','NULL','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, description, deleted) VALUES ('5','2025-05-07 18:25:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','526d7876643256794946427664484d6751584e6f6232746849455a736233646c636942516233527a4945467a6147397259513d3d','5a6d7876643256794948427664484d6759584e6f6232746849475a736233646c636942776233527a4947467a6147397259513d3d','2233','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','45,45','2000','1','1','0','500,10','2,1','2025-05-07,2025-05-07','4d4463774e5449774d6a55774e6a51774d4456664d44493d,4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55334a70646d6b3d,55326c325957746863326b3d','2000','NaN','NULL','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, description, deleted) VALUES ('6','2025-05-07 21:08:20','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','4d4463774e5449774d6a55774f5441344d6a42664d44593d','515852766253424362323169','595852766253426962323169','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44493d','55476c6c5932553d','50,60','20','1','2','0','500,500','1,1','2025-05-07,2025-05-07','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d,4d4463774e5449774d6a55774e6a51774d4456664d44493d','55326c325957746863326b3d,55334a70646d6b3d','NULL','NULL','NULL','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, description, deleted) VALUES ('7','2025-05-07 23:01:57','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794e4464664d44493d','5532567461534247615735706332686c5a413d3d','4d4463774e5449774d6a55784d5441784e5464664d44633d','55484a765a48566a644342336158526f49477876626d6367626d46745a5342755957316c494735686257553d','63484a765a48566a644342336158526f49477876626d6367626d46745a5342755957316c494735686257553d','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','0','NULL','NULL','','NULL','NULL','NULL','0','100','1','2025-05-07','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','NULL','NULL','NULL','NULL','0');


CREATE TABLE `af_proforma_invoice` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `proforma_invoice_id` mediumtext NOT NULL,
  `proforma_invoice_number` mediumtext NOT NULL,
  `proforma_invoice_date` mediumtext NOT NULL,
  `customer_id` mediumtext NOT NULL,
  `customer_name_mobile_city` mediumtext NOT NULL,
  `customer_details` mediumtext NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name_mobile_city` mediumtext NOT NULL,
  `agent_details` mediumtext NOT NULL,
  `transport_id` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `gst_option` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `billing_address` mediumtext DEFAULT NULL,
  `tax_option` mediumtext NOT NULL,
  `tax_type` mediumtext NOT NULL,
  `overall_tax` mediumtext NOT NULL,
  `company_state` mediumtext NOT NULL,
  `party_state` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `indv_magazine_id` mediumtext DEFAULT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_type` mediumtext NOT NULL,
  `subunit_need` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `per` mediumtext NOT NULL,
  `per_type` mediumtext NOT NULL,
  `product_tax` mediumtext NOT NULL,
  `final_rate` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `other_charges_id` mediumtext NOT NULL,
  `charges_type` mediumtext NOT NULL,
  `other_charges_value` mediumtext NOT NULL,
  `agent_commission` mediumtext NOT NULL,
  `sub_total` mediumtext DEFAULT NULL,
  `grand_total` mediumtext DEFAULT NULL,
  `cgst_value` mediumtext DEFAULT NULL,
  `sgst_value` mediumtext DEFAULT NULL,
  `igst_value` mediumtext DEFAULT NULL,
  `total_tax_value` mediumtext DEFAULT NULL,
  `round_off` mediumtext DEFAULT NULL,
  `other_charges_total` mediumtext DEFAULT NULL,
  `bill_total` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('1','2025-05-07 18:20:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774e6a49774d4456664d44453d','PI001/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','4d4463774e5449774d6a55774e6a45304e546c664d44453d','566d6c756233526f494367784d6a4d304e5459334f446b774b534174494546735957356b6458493d','566d6c756233526f50474a79506b46735957356b64584938596e492b5132686c626d35686153684561584e304c696b38596e492b5647467461577767546d466b64547869636a3467545739696157786c49446f674d54497a4e4455324e7a67354d413d3d','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','','','','NULL','Tamil Nadu','Tamil Nadu','4d4459774e5449774d6a55774e7a41304d6a52664d444d3d,4d4459774e5449774d6a55774e7a41784d7a6c664d44453d','','556d46334944493d,55484a765a48566a64434178','1,1','1,','10,','4d4459774e5449774d6a55774e7a41784d446c664d444d3d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d,5132467a5a513d3d','2,5','200,2000','1,1','1,1','','200,2000','400.00,10000.00','NULL','NULL','NULL','','10400','10400.00','0','0','0','0','0','0','10400.00','0','1');

INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('2','2025-05-07 18:26:08','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774e6a49324d4468664d44493d','PI002/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','','526d7876643256794946427664484d6751584e6f62327468','1','1','45','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','2','2000','1','1','','2000','4000.00','NULL','NULL','NULL','','4000','4000.00','0','0','0','0','0','0','4000.00','0','0');

INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('3','2025-05-07 18:26:39','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774e6a49324d7a6c664d444d3d','PI003/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','','526d7876643256794946427664484d6751584e6f62327468','1','1','45','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','2','2000','1','1','','2000','4000.00','NULL','NULL','NULL','','4000','4000.00','0','0','0','0','0','0','4000.00','0','0');

INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('4','2025-05-07 18:27:49','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774e6a49334e446c664d44513d','PI004/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','','526d7876643256794946427664484d6751584e6f62327468','1','1','45','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','5','2000','1','1','','2000','10000.00','NULL','NULL','NULL','','10000','10000.00','0','0','0','0','0','0','10000.00','0','0');

INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('5','2025-05-07 21:17:45','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774f5445334e4456664d44553d','PI005/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','','515852766253424362323169','1','1','50','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','20','1','2','','1000','1000.00','NULL','NULL','NULL','','1000','1000.00','0','0','0','0','0','0','1000.00','0','0');

INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('6','2025-05-07 21:46:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774f5451324d6a4a664d44593d','PI006/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','Test','Test','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','','515852766253424362323169','1','1','60','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','20','1','2','','1200','1200.00','NULL','NULL','NULL','','1200','1200.00','0','0','0','0','0','0','1200.00','0','0');

INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('7','2025-05-07 21:57:50','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4463774e5449774d6a55774f5455334e5442664d44633d','PI007/25-26','2025-05-07','4d4463774e5449774d6a55774e6a45314d6a64664d44453d','5457466f5a584e6f494367314e6a63344f5441304e5459334b534174494546746157357161577468636d4670','5457466f5a584e6f4a43516b51573170626d70706132467959576b6b4a43524461475675626d46704b455270633351754b53516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f674e5459334f446b774e4455324e773d3d','4d4463774e5449774d6a55774e6a45304e546c664d44453d','566d6c756233526f494367784d6a4d304e5459334f446b774b534174494546735957356b6458493d','566d6c756233526f50474a79506b46735957356b64584938596e492b5132686c626d35686153684561584e304c696b38596e492b5647467461577767546d466b64547869636a3467545739696157786c49446f674d54497a4e4455324e7a67354d413d3d','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','','','','NULL','Tamil Nadu','Tamil Nadu','4d4463774e5449774d6a55774e6a49314d446c664d44553d','','526d7876643256794946427664484d6751584e6f62327468','1','1','45','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','2000','1','1','','2000','1200.00','NULL','NULL','NULL','','2000','2000.00','0','0','0','0','0','0','2000.00','0','0');

INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, billing_address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('8','2025-05-08 10:45:17','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d4467774e5449774d6a55784d4451314d5464664d44673d','PI008/25-26','2025-05-08','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b614745674b4467354d446b344e7a4d344f544d70494330675132686c626d64686248426864485231','5533566b6147456b4a435244614756755a324673634746306448556b4a435244614756755a324673634746306448556f52476c7a644334704a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6941344f5441354f44637a4f446b7a','NULL','NULL','NULL','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','','','','NULL','Tamil Nadu','','4d4463774e5449774d6a55774f5441344d6a42664d44593d,4d4463774e5449774d6a55774f5441344d6a42664d44593d','','515852766253424362323169,515852766253424362323169','2,1','1,1','60,60','4d4459774e5449774d6a55774e7a41784d446c664d44493d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','55476c6c5932553d,5132467a5a513d3d','100,1','20,20','1,1','2,2',',','20,1200','2000.00,1200.00','NULL','NULL','NULL','','3200','3200.00','0','0','0','0','0','0','3200.00','0','0');


CREATE TABLE `af_purchase_entry` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `purchase_entry_id` mediumtext NOT NULL,
  `purchase_entry_date` mediumtext NOT NULL,
  `purchase_entry_number` mediumtext NOT NULL,
  `supplier_id` mediumtext NOT NULL,
  `supplier_name_mobile_city` mediumtext NOT NULL,
  `supplier_details` mediumtext NOT NULL,
  `vehicle` mediumtext NOT NULL,
  `company_state` mediumtext NOT NULL,
  `supplier_state` mediumtext NOT NULL,
  `gst_option` mediumtext NOT NULL,
  `tax_type` mediumtext NOT NULL,
  `tax_option` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `unit_type` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `total_qty` mediumtext NOT NULL,
  `rate` mediumtext NOT NULL,
  `per` mediumtext NOT NULL,
  `per_type` mediumtext NOT NULL,
  `final_rate` mediumtext NOT NULL,
  `overall_tax` mediumtext NOT NULL,
  `product_amount` mediumtext NOT NULL,
  `sub_total` mediumtext NOT NULL,
  `other_charges_id` mediumtext NOT NULL,
  `charges_type` mediumtext NOT NULL,
  `other_charges_value` mediumtext NOT NULL,
  `other_charges_total` mediumtext NOT NULL,
  `cgst_value` mediumtext NOT NULL,
  `sgst_value` mediumtext NOT NULL,
  `igst_value` mediumtext NOT NULL,
  `total_tax_value` mediumtext NOT NULL,
  `product_tax` mediumtext NOT NULL,
  `round_off` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `stockupdate` mediumtext NOT NULL,
  `received_slip_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `rate_per_unit` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  `location_id` mediumtext NOT NULL,
  `location_name` mediumtext NOT NULL,
  `location_type` mediumtext NOT NULL,
  `product_group` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_purchase_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, purchase_entry_id, purchase_entry_date, purchase_entry_number, supplier_id, supplier_name_mobile_city, supplier_details, vehicle, company_state, supplier_state, gst_option, tax_type, tax_option, godown_id, godown_name, product_id, product_name, quantity, unit_type, content, total_qty, rate, per, per_type, final_rate, overall_tax, product_amount, sub_total, other_charges_id, charges_type, other_charges_value, other_charges_total, cgst_value, sgst_value, igst_value, total_tax_value, product_tax, round_off, total_amount, stockupdate, received_slip_id, unit_id, unit_name, rate_per_unit, cancelled, deleted, location_id, location_name, location_type, product_group) VALUES ('1','2025-05-07 22:20:44','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','','4d4463774e5449774d6a55784d4449774e4452664d44453d','2025-05-07','001','4d4463774e5449774d6a55784d4449774d445a664d44453d','556d467449464e68626d74686369416f4f44677a4f54417a4d4449774d436b674c53424262574a686448523163673d3d','556d467449464e68626d74686369516b4a454674596d4630644856794a43516b5132686c626d35686153684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467344d7a6b774d7a41794d44413d','','Tamil Nadu','Tamil Nadu','','','','','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','515852766253424362323169','100','1','100','10000','1','1','1','1','NULL','100','100','NULL','NULL','NULL','NULL','0','0','0','0','','0','100.00','1','NULL','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','0','0','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','1','4d5449774e4449774d6a55784d4455794d7a4e664d44453d');


CREATE TABLE `af_receipt` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `receipt_id` mediumtext NOT NULL,
  `receipt_number` mediumtext NOT NULL,
  `receipt_date` date NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `af_role` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `role_id` mediumtext NOT NULL,
  `role_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `access_pages` mediumtext NOT NULL,
  `access_page_actions` mediumtext NOT NULL,
  `incharger` int(11) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_role (id, created_date_time, creator, creator_name, role_id, role_name, lower_case_name, access_pages, access_page_actions, incharger, deleted) VALUES ('1','2025-05-06 18:28:36','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','526d466a644739796553424a626d4e6f59584a6e5a58493d','5a6d466a6447397965534270626d4e6f59584a6e5a58493d','526d466a6447397965513d3d,5232396b62336475,5457466e59587070626d553d,52334a766458413d,5657357064413d3d,526d6c7561584e6f5a57516752334a766458413d,55484a765a48566a64413d3d,55335677634778705a58493d,5157646c626e513d,5133567a644739745a58493d,55474635625756756443424e6232526c,516d467561773d3d,51326868636d646c63773d3d,56484a68626e4e7762334a30,55485679593268686332556752573530636e6b3d,5132397563335674634852706232346752573530636e6b3d,55335276593273675157527164584e306257567564413d3d,5247467062486b6755484a765a48566a64476c7662673d3d,5532567461575a70626d6c7a6147566b4945567564484a35,545746305a584a705957776756484a68626e4e6d5a58493d,55484a765a6d3979625745675357353262326c6a5a513d3d,5247567361585a6c636e6b675532787063413d3d,52584e30615731686447553d,566d39315932686c63673d3d,556d566a5a576c7764413d3d,525868775a57357a5a5342445958526c5a32397965513d3d,525868775a57357a5a513d3d,556d567762334a30','566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$524756735a58526c,566d6c6c64773d3d','1','0');

INSERT INTO af_role (id, created_date_time, creator, creator_name, role_id, role_name, lower_case_name, access_pages, access_page_actions, incharger, deleted) VALUES ('2','2025-05-07 18:11:37','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45784d7a64664d44493d','5547463562575675644342546447466d5a673d3d','63474635625756756443427a6447466d5a673d3d','566d39315932686c63673d3d,556d566a5a576c7764413d3d,525868775a57357a5a5342445958526c5a32397965513d3d,525868775a57357a5a513d3d','566d6c6c64773d3d$$$5157526b$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$5257527064413d3d$$$524756735a58526c,566d6c6c64773d3d$$$5157526b$$$524756735a58526c','0','0');


CREATE TABLE `af_semifinished_inward` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL DEFAULT '',
  `company_details` mediumtext NOT NULL,
  `semifinished_inward_id` mediumtext NOT NULL,
  `semifinished_inward_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `factory_name_location` mediumtext NOT NULL,
  `factory_details` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `godown_name_location` mediumtext NOT NULL,
  `godown_details` mediumtext NOT NULL,
  `contractor_id` mediumtext DEFAULT NULL,
  `contractor_name_mobile_city` mediumtext DEFAULT NULL,
  `contractor_details` mediumtext DEFAULT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `subunit_contains` mediumtext NOT NULL,
  `cooly_per_qty` mediumtext NOT NULL,
  `cooly_rate` mediumtext NOT NULL,
  `overall_cooly_total` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_semifinished_inward (id, created_date_time, creator, creator_name, bill_company_id, company_details, semifinished_inward_id, semifinished_inward_number, entry_date, factory_id, factory_name_location, factory_details, godown_id, godown_name_location, godown_details, contractor_id, contractor_name_mobile_city, contractor_details, product_id, product_name, unit_id, unit_name, quantity, subunit_contains, cooly_per_qty, cooly_rate, overall_cooly_total, total_quantity, cancelled, deleted) VALUES ('1','2025-05-07 23:04:33','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','5157356e595778685a584e3359584a7049455a70636d563362334a7263794242626d64686247466c63336468636d6b67526d6c795a586476636d747a4a43516b4d6938314e544d74565377674d6938314e544d745669776755326c325957746863326b6754574670626942536232466b4a43516b5532463064485679494330674e6a49324d6a417a4a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6a6b774f5441354d446b774f54416b4a43516752314e5549456c4f49446f794d6b4642515546424d4441774d454578576a553d','4d4463774e5449774d6a55784d5441304d7a4e664d44453d','SMI001/25-26','2025-05-07','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','','','','4d4463774e5449774d6a55784d5441784e5464664d44633d','55484a765a48566a644342336158526f49477876626d6367626d46745a5342755957316c494735686257553d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','10','NULL','','','','10','0','0');


CREATE TABLE `af_stock` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` mediumtext NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `stock_date` date NOT NULL,
  `party_id` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `case_contains` mediumtext NOT NULL,
  `inward_unit` mediumtext NOT NULL,
  `inward_subunit` mediumtext NOT NULL,
  `outward_unit` mediumtext NOT NULL,
  `outward_subunit` mediumtext NOT NULL,
  `stock_type` mediumtext NOT NULL,
  `bill_unique_id` mediumtext NOT NULL,
  `bill_unique_number` mediumtext DEFAULT NULL,
  `remarks` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('1','2025-05-06 19:01:39','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-06','NULL','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4459774e5449774d6a55774e7a41784d7a6c664d44453d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','500','NULL','0','NULL','Opening Stock','4d4459774e5449774d6a55774e7a41784d7a6c664d44453d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('2','2025-05-06 19:02:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-06','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d4459774e5449774d6a55774e7a41794d6a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','500','NULL','0','NULL','Opening Stock','4d4459774e5449774d6a55774e7a41794d6a4a664d44493d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('3','2025-05-06 19:04:24','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-06','NULL','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4459774e5449774d6a55774e7a41304d6a52664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','500','5000.00','0','0','Opening Stock','4d4459774e5449774d6a55774e7a41304d6a52664d444d3d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('4','2025-05-06 19:05:34','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-06','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d4459774e5449774d6a55774e7a41314d7a52664d44513d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','500','5000.00','0','0','Opening Stock','4d4459774e5449774d6a55774e7a41314d7a52664d44513d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('5','2025-05-07 18:20:42','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4459774e5449774d6a55774e7a41784d7a6c664d44453d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','0','NULL','10','NULL','Stock Adjustment','4d4463774e5449774d6a55774e6a49774e444a664d44453d','STA001/25-26','553152424d4441784c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('6','2025-05-07 18:25:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','45','10','450.00','0','0','Opening Stock','4d4463774e5449774d6a55774e6a49314d446c664d44553d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('7','2025-05-07 18:26:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','45','0','0','2','90.00','Delivery Slip','4d4463774e5449774d6a55774e6a49324d6a4a664d44453d','NULL','52464d774d4445764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('8','2025-05-07 18:27:03','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','45','0','0','2','90.00','Delivery Slip','4d4463774e5449774d6a55774e6a49334d444e664d44493d','NULL','52464d774d4449764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('9','2025-05-07 18:40:46','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','45','11.11','500','0','0','Opening Stock','4d4463774e5449774d6a55774e6a49314d446c664d44553d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('10','2025-05-07 20:56:15','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d4459774e5449774d6a55774e7a41314d7a52664d44513d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','0','0','10','100.00','Consumption Entry','4d4463774e5449774d6a55774f4455324d5456664d44453d','CON001/25-26','5130394f4d4441784c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('11','2025-05-07 20:56:15','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d4459774e5449774d6a55774e7a41794d6a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','0','NULL','10','NULL','Consumption Entry','4d4463774e5449774d6a55774f4455324d5456664d44453d','CON001/25-26','5130394f4d4441784c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('12','2025-05-07 21:08:20','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774f5441344d6a42664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','50','500','25000.00','0','0','Opening Stock','4d4463774e5449774d6a55774f5441344d6a42664d44593d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('13','2025-05-07 21:08:20','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774f5441344d6a42664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','60','500','30000.00','0','0','Opening Stock','4d4463774e5449774d6a55774f5441344d6a42664d44593d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('14','2025-05-07 21:20:26','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774f5441344d6a42664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','50','0','0','1','50.00','Delivery Slip','4d4463774e5449774d6a55774f5449774d6a5a664d444d3d','NULL','52464d774d444d764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('15','2025-05-07 21:51:17','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774f5441344d6a42664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','60','0','0','1','60.00','Delivery Slip','4d4463774e5449774d6a55774f5455784d5464664d44513d','NULL','52464d774d4451764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('16','2025-05-07 21:58:02','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','45','0','0','1','45.00','Delivery Slip','4d4463774e5449774d6a55774f5455344d444a664d44553d','NULL','52464d774d4455764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('17','2025-05-07 22:20:44','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','4d4463774e5449774d6a55784d4449774d445a664d44453d','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774f5441344d6a42664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','100','100','10000.00','0','0','Purchase Entry','4d4463774e5449774d6a55784d4449774e4452664d44453d','NULL','4d444178','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('18','2025-05-07 23:01:57','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d4463774e5449774d6a55784d5441784e5464664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','100','NULL','0','NULL','Opening Stock','4d4463774e5449774d6a55784d5441784e5464664d44633d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('19','2025-05-07 23:02:29','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d4463774e5449774d6a55784d5441784e5464664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','0','NULL','1','NULL','Consumption Entry','4d4463774e5449774d6a55784d5441794d6a6c664d44493d','CON002/25-26','5130394f4d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('20','2025-05-07 23:02:56','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','45','10','450.00','0','0','Daily Production','4d4463774e5449774d6a55784d5441794e545a664d44453d','DAP001/25-26','524546514d4441784c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('21','2025-05-07 23:03:43','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','45','10','450.00','0','0','Daily Production','4d4463774e5449774d6a55784d54417a4e444e664d44493d','DAP002/25-26','524546514d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('22','2025-05-07 23:04:15','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','45','10','450.00','0','0','Stock Adjustment','4d4463774e5449774d6a55784d5441304d5456664d44493d','STA002/25-26','553152424d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('23','2025-05-07 23:04:33','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-07','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d4463774e5449774d6a55784d5441784e5464664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','10','NULL','0','NULL','Semifinished Inward','4d4463774e5449774d6a55784d5441304d7a4e664d44453d','SMI001/25-26','5530314a4d4441784c7a49314c544932','0');


CREATE TABLE `af_stock_adjustment` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_company_details` mediumtext NOT NULL,
  `stock_adjustment_id` mediumtext NOT NULL,
  `stock_adjustment_number` mediumtext NOT NULL,
  `entry_date` date NOT NULL,
  `location_type` mediumtext NOT NULL,
  `product_group` mediumtext NOT NULL,
  `group_name` mediumtext NOT NULL,
  `location_id` mediumtext NOT NULL,
  `location_name` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_type` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `quantity` mediumtext NOT NULL,
  `stock_action` mediumtext NOT NULL,
  `remarks` mediumtext NOT NULL,
  `total_quantity` mediumtext NOT NULL,
  `cancelled` int(100) NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_stock_adjustment (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, stock_adjustment_id, stock_adjustment_number, entry_date, location_type, product_group, group_name, location_id, location_name, content, group_id, product_id, product_name, unit_type, unit_id, unit_name, quantity, stock_action, remarks, total_quantity, cancelled, deleted) VALUES ('1','2025-05-07 18:20:42','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','5157356e595778685a584e3359584a7049455a70636d563362334a7263794242626d64686247466c63336468636d6b67526d6c795a586476636d747a4a43516b4d6938314e544d74565377674d6938314e544d745669776755326c325957746863326b6754574670626942536232466b4a43516b5532463064485679494330674e6a49324d6a417a4a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6a6b774f5441354d446b774f54416b4a43516752314e5549456c4f49446f794d6b4642515546424d4441774d454578576a553d','4d4463774e5449774d6a55774e6a49774e444a664d44453d','STA001/25-26','2025-05-07','1','2','526d6c7561584e6f5a57513d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','0','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4459774e5449774d6a55774e7a41784d7a6c664d44453d','55484a765a48566a64434178','1','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','10','2','5647567a64413d3d','10','0','0');

INSERT INTO af_stock_adjustment (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, stock_adjustment_id, stock_adjustment_number, entry_date, location_type, product_group, group_name, location_id, location_name, content, group_id, product_id, product_name, unit_type, unit_id, unit_name, quantity, stock_action, remarks, total_quantity, cancelled, deleted) VALUES ('2','2025-05-07 23:04:15','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','5157356e595778685a584e3359584a7049455a70636d563362334a7263794242626d64686247466c63336468636d6b67526d6c795a586476636d747a4a43516b4d6938314e544d74565377674d6938314e544d745669776755326c325957746863326b6754574670626942536232466b4a43516b5532463064485679494330674e6a49324d6a417a4a43516b566d6c796457526f645735685a3246794a43516b5647467461577767546d466b6453516b4a43424e62324a70624755674f6a6b774f5441354d446b774f54416b4a43516752314e5549456c4f49446f794d6b4642515546424d4441774d454578576a553d','4d4463774e5449774d6a55784d5441304d5456664d44493d','STA002/25-26','2025-05-07','1','2','526d6c7561584e6f5a57513d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','45','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','526d7876643256794946427664484d6751584e6f6232746849455a736233646c636942516233527a4945467a6147397259513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','10','1','5647567a64413d3d','10','0','0');


CREATE TABLE `af_stock_by_godown` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` mediumtext NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `subunit_id` mediumtext NOT NULL,
  `case_contains` mediumtext NOT NULL,
  `current_stock_unit` mediumtext NOT NULL,
  `current_stock_subunit` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('1','2025-05-06 19:02:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d4459774e5449774d6a55774e7a41794d6a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','NULL','490.00','NULL','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('2','2025-05-06 19:05:34','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d4459774e5449774d6a55774e7a41314d7a52664d44513d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','490.00','4900.00','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('3','2025-05-07 23:01:57','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d4463774e5449774d6a55784d5441784e5464664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','NULL','99.00','NULL','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('4','2025-05-07 23:04:33','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d4463774e5449774d6a55784d5441784e5464664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','NULL','10.00','NULL','0');


CREATE TABLE `af_stock_by_magazine` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` mediumtext NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `group_id` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `subunit_id` mediumtext NOT NULL,
  `case_contains` mediumtext NOT NULL,
  `current_stock_unit` mediumtext NOT NULL,
  `current_stock_subunit` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('1','2025-05-06 19:01:39','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4459774e5449774d6a55774e7a41784d7a6c664d44453d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','NULL','490.00','NULL','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('2','2025-05-06 19:04:24','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4459774e5449774d6a55774e7a41304d6a52664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','500.00','5000.00','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('3','2025-05-07 18:25:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','45','16.00','720.00','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('4','2025-05-07 18:40:46','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774e6a49314d446c664d44553d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','45','30.11','1354.95','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('5','2025-05-07 21:08:20','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774f5441344d6a42664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44493d','50','499.00','24950.00','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('6','2025-05-07 21:08:20','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774f5441344d6a42664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44493d','60','499.00','29940.00','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('7','2025-05-07 22:20:44','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d4463774e5449774d6a55774f5441344d6a42664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44493d','100','100.00','10000.00','0');


CREATE TABLE `af_stock_conversion` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `bill_company_id` mediumtext NOT NULL,
  `bill_id` mediumtext NOT NULL,
  `bill_number` mediumtext NOT NULL,
  `bill_date` mediumtext NOT NULL,
  `bill_type` mediumtext NOT NULL,
  `party_id` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `agent_id` mediumtext NOT NULL,
  `agent_name` mediumtext NOT NULL,
  `product_id` mediumtext NOT NULL,
  `product_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `case_contains` mediumtext NOT NULL,
  `inward_unit` mediumtext NOT NULL,
  `inward_sub_unit` mediumtext NOT NULL,
  `outward_unit` mediumtext NOT NULL,
  `outward_sub_unit` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('1','2025-05-07 18:20:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774e6a49774d4456664d44453d','PI001/25-26','2025-05-07','Proforma Invoice','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','4d4463774e5449774d6a55774e6a45304e546c664d44453d','566d6c756233526f','4d4459774e5449774d6a55774e7a41784d7a6c664d44453d','55484a765a48566a64434178','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','','5','NULL','NULL','NULL','1');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('2','2025-05-07 18:26:08','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774e6a49324d4468664d44493d','PI002/25-26','2025-05-07','Proforma Invoice','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','NULL','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','526d7876643256794946427664484d6751584e6f62327468','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','45','2','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('3','2025-05-07 18:26:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774e6a49324d6a4a664d44453d','DS001/25-26','2025-05-07','Delivery Slip','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','NULL','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','526d7876643256794946427664484d6751584e6f62327468','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','45','NULL','NULL','2','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('4','2025-05-07 18:26:39','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774e6a49324d7a6c664d444d3d','PI003/25-26','2025-05-07','Proforma Invoice','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','NULL','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','526d7876643256794946427664484d6751584e6f62327468','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','45','2','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('5','2025-05-07 18:27:03','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774e6a49334d444e664d44493d','DS002/25-26','2025-05-07','Delivery Slip','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','NULL','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','526d7876643256794946427664484d6751584e6f62327468','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','45','NULL','NULL','2','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('6','2025-05-07 18:27:49','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774e6a49334e446c664d44513d','PI004/25-26','2025-05-07','Proforma Invoice','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','NULL','','4d4463774e5449774d6a55774e6a49314d446c664d44553d','526d7876643256794946427664484d6751584e6f62327468','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','45','5','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('7','2025-05-07 21:17:45','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774f5445334e4456664d44553d','PI005/25-26','2025-05-07','Proforma Invoice','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','NULL','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','515852766253424362323169','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','50','1','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('8','2025-05-07 21:20:26','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774f5449774d6a5a664d444d3d','DS003/25-26','2025-05-07','Delivery Slip','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','NULL','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','515852766253424362323169','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','50','NULL','NULL','1','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('9','2025-05-07 21:46:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774f5451324d6a4a664d44593d','PI006/25-26','2025-05-07','Proforma Invoice','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','NULL','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','515852766253424362323169','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','60','1','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('10','2025-05-07 21:51:17','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774f5455784d5464664d44513d','DS004/25-26','2025-05-07','Delivery Slip','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','NULL','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','515852766253424362323169','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','60','NULL','NULL','1','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('11','2025-05-07 21:57:50','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774f5455334e5442664d44633d','PI007/25-26','2025-05-07','Proforma Invoice','4d4463774e5449774d6a55774e6a45314d6a64664d44453d','5457466f5a584e6f','4d4463774e5449774d6a55774e6a45304e546c664d44453d','566d6c756233526f','4d4463774e5449774d6a55774e6a49314d446c664d44553d','526d7876643256794946427664484d6751584e6f62327468','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','45','1','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('12','2025-05-07 21:58:02','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4463774e5449774d6a55774f5455344d444a664d44553d','DS005/25-26','2025-05-07','Delivery Slip','4d4463774e5449774d6a55774e6a45314d6a64664d44453d','5457466f5a584e6f','4d4463774e5449774d6a55774e6a45304e546c664d44453d','566d6c756233526f','4d4463774e5449774d6a55774e6a49314d446c664d44553d','526d7876643256794946427664484d6751584e6f62327468','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','45','NULL','NULL','1','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('13','2025-05-08 10:45:17','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4467774e5449774d6a55784d4451314d5464664d44673d','PI008/25-26','2025-05-08','Proforma Invoice','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','NULL','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','515852766253424362323169','4d4459774e5449774d6a55774e7a41784d446c664d44493d','55476c6c5932553d','60','NULL','100','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('14','2025-05-08 10:45:17','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d4467774e5449774d6a55784d4451314d5464664d44673d','PI008/25-26','2025-05-08','Proforma Invoice','4d4463774e5449774d6a55774e6a45334d7a64664d44493d','5533566b6147453d','NULL','','4d4463774e5449774d6a55774f5441344d6a42664d44593d','515852766253424362323169','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','60','1','NULL','NULL','NULL','0');


CREATE TABLE `af_supplier` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `supplier_id` mediumtext NOT NULL,
  `supplier_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `city` mediumtext NOT NULL,
  `district` mediumtext NOT NULL,
  `state` mediumtext NOT NULL,
  `identification` mediumtext NOT NULL DEFAULT '',
  `mobile_number` mediumtext NOT NULL,
  `others_city` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `supplier_details` mediumtext NOT NULL,
  `gst_number` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `email` mediumtext NOT NULL DEFAULT '',
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_supplier (id, created_date_time, creator, creator_name, supplier_id, supplier_name, lower_case_name, address, city, district, state, identification, mobile_number, others_city, opening_balance, opening_balance_type, supplier_details, gst_number, name_mobile_city, email, deleted) VALUES ('1','2025-05-07 22:20:06','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55784d4449774d445a664d44453d','556d467449464e68626d746863673d3d','636d467449484e68626d746863673d3d','NULL','51573169595852306458493d','5132686c626d356861513d3d','5647467461577767546d466b64513d3d','','4f44677a4f54417a4d4449774d413d3d','','','','556d467449464e68626d74686369516b4a454674596d4630644856794a43516b5132686c626d35686153684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467344d7a6b774d7a41794d44413d','','556d467449464e68626d74686369416f4f44677a4f54417a4d4449774d436b674c53424262574a686448523163673d3d','','0');


CREATE TABLE `af_transport` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `transport_id` mediumtext NOT NULL,
  `transport_name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `gst_number` mediumtext NOT NULL,
  `location` mediumtext NOT NULL,
  `transport_details` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `name_location` mediumtext NOT NULL,
  `lower_case_name_location` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `af_unit` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `unit_id` mediumtext NOT NULL,
  `unit_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_unit (id, created_date_time, creator, creator_name, unit_id, unit_name, lower_case_name, deleted) VALUES ('1','2025-05-06 19:01:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','596d3934','0');

INSERT INTO af_unit (id, created_date_time, creator, creator_name, unit_id, unit_name, lower_case_name, deleted) VALUES ('2','2025-05-06 19:01:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e7a41784d446c664d44493d','55476c6c5932553d','63476c6c5932553d','0');

INSERT INTO af_unit (id, created_date_time, creator, creator_name, unit_id, unit_name, lower_case_name, deleted) VALUES ('3','2025-05-06 19:01:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','5932467a5a513d3d','0');


CREATE TABLE `af_user` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `user_id` mediumtext NOT NULL,
  `role_id` mediumtext NOT NULL,
  `login_id` mediumtext NOT NULL,
  `lower_case_login_id` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `name_mobile` mediumtext NOT NULL,
  `password` mediumtext NOT NULL,
  `admin` int(100) NOT NULL,
  `type` mediumtext NOT NULL,
  `factory_id` mediumtext NOT NULL,
  `godown_id` mediumtext NOT NULL,
  `magazine_id` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, factory_id, godown_id, magazine_id, deleted) VALUES ('1','2025-04-29 17:16:03','4d6a67774e4449774d6a55774d5441344e5464664d44453d','55334a706332396d64486468636d5636','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','','55334a706332396d64486468636d5636','63334a706332396d64486468636d5636','55334a706332396d64486468636d5636','4f5459794f546b314d4441774d513d3d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','51575274615734784d6a4e41','1','Super Admin','NULL','NULL','NULL','0');

INSERT INTO af_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, factory_id, godown_id, magazine_id, deleted) VALUES ('2','2025-05-06 18:28:36','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44493d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','51584a3162413d3d','59584a3162413d3d','51584a3162413d3d','4f4459784d4441324d5467304e413d3d','51584a316243416f4f4459784d4441324d5467304e436b3d','51575274615734784d6a4e41','0','Factory Incharge','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','NULL','NULL','0');

INSERT INTO af_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, factory_id, godown_id, magazine_id, deleted) VALUES ('3','2025-05-07 18:12:11','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45794d5446664d444d3d','4d4463774e5449774d6a55774e6a45784d7a64664d44493d','6258567561513d3d','6258567561513d3d','545856756157467959576f3d','4e4455324e7a67354d446b344e773d3d','545856756157467959576f674b4451314e6a63344f5441354f446370','51575274615734784d6a4e41','0','Staff','NULL','NULL','NULL','0');

INSERT INTO af_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, factory_id, godown_id, magazine_id, deleted) VALUES ('4','2025-05-07 18:40:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44513d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','63326868626d31315a324674','63326868626d31315a324674','55326868626d31315a324674','4f446b334e6a67344f546b334e773d3d','55326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','51575274615734784d6a4e41','0','Factory Incharge','4d4463774e5449774d6a55774e6a51774d4456664d44493d','NULL','NULL','0');


CREATE TABLE `af_voucher` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `voucher_id` mediumtext NOT NULL,
  `voucher_number` mediumtext NOT NULL,
  `voucher_date` date NOT NULL,
  `party_id` mediumtext NOT NULL,
  `name_mobile_city` mediumtext NOT NULL,
  `party_type` mediumtext NOT NULL,
  `party_name` mediumtext NOT NULL,
  `amount` mediumtext NOT NULL,
  `narration` mediumtext NOT NULL,
  `payment_mode_id` mediumtext NOT NULL,
  `payment_mode_name` mediumtext NOT NULL,
  `bank_id` mediumtext NOT NULL,
  `bank_name` mediumtext NOT NULL,
  `total_amount` mediumtext NOT NULL,
  `deleted` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

