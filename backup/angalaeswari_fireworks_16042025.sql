

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_agent (id, created_date_time, creator, creator_name, agent_id, agent_name, lower_case_name, address, city, district, state, mobile_number, others_city, agent_details, name_mobile_city, commission, opening_balance, opening_balance_type, deleted) VALUES ('1','2025-05-10 16:29:41','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e4449354e4446664d44453d','553356696147453d','633356696147453d','NULL','51577868626d523163673d3d','5132686c626d356861513d3d','5647467461577767546d466b64513d3d','4f4451354e4467354d7a41774d773d3d','','5533566961474538596e492b51577868626d5231636a7869636a354461475675626d46704b455270633351754b547869636a3555595731706243424f5957523150474a795069424e62324a70624755674f6941344e446b304f446b7a4d44417a','55335669614745674b4467304f5451344f544d774d444d704943306751577868626d523163673d3d','20%','30000','Credit','0');

INSERT INTO af_agent (id, created_date_time, creator, creator_name, agent_id, agent_name, lower_case_name, address, city, district, state, mobile_number, others_city, agent_details, name_mobile_city, commission, opening_balance, opening_balance_type, deleted) VALUES ('2','2025-05-10 16:30:15','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','6257466f5a584e6f4948427959574a6f64513d3d','NULL','5347397959513d3d','515778705a32467961413d3d','565852305958496755484a685a47567a61413d3d','4f4451774e4441774d7a41774d773d3d','','5457466f5a584e6f4946427959574a6f64547869636a354962334a6850474a79506b467361576468636d676f52476c7a6443347050474a79506c563064474679494642795957526c63326738596e492b49453176596d6c735a534136494467304d4451774d444d774d444d3d','5457466f5a584e6f4946427959574a6f6453416f4f4451774e4441774d7a41774d796b674c53424962334a68','3.5%','7000','Debit','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_bank (id, created_date_time, creator, creator_name, bill_company_id, bank_id, account_name, account_number, bank_name, ifsc_code, account_type, bank_name_account_number, branch, payment_mode_id, estimate_balance_date, invoice_balance_date, estimate_opening_balance, invoice_opening_balance, opening_balance, opening_balance_type, deleted) VALUES ('1','2025-05-07 18:18:49','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d4463774e5449774d6a55774e6a45344e446c664d44453d','51584a3162413d3d','4d54497a4e4455324e7a67354d44413d','55304a4a','NULL','NULL','55304a4a494367784d6a4d304e5459334f446b774d436b3d','55326c325957746863326b3d','4d4463774e5449774d6a55774e6a45344d6a64664d444d3d,4d4463774e5449774d6a55774e6a45344d6a64664d44493d','','','','','','','0');

INSERT INTO af_bank (id, created_date_time, creator, creator_name, bill_company_id, bank_id, account_name, account_number, bank_name, ifsc_code, account_type, bank_name_account_number, branch, payment_mode_id, estimate_balance_date, invoice_balance_date, estimate_opening_balance, invoice_opening_balance, opening_balance, opening_balance_type, deleted) VALUES ('2','2025-05-10 16:33:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','5155593d','4e7a4d794f544d794f44417a4f54413d','56453143','NULL','NULL','56453143494367334d7a49354d7a49344d444d354d436b3d','55326c325957746863326b3d','4d4463774e5449774d6a55774e6a45344d6a64664d444d3d,4d4463774e5449774d6a55774e6a45344d6a64664d44493d','','','','','','','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_charges (id, created_date_time, creator, creator_name, charges_id, charges_name, action, lower_case_name, deleted) VALUES ('1','2025-05-07 18:19:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45354d544e664d44453d','516d6c736243425559586767566d46736457553d','plus','596d6c736243423059586767646d46736457553d','0');

INSERT INTO af_charges (id, created_date_time, creator, creator_name, charges_id, charges_name, action, lower_case_name, deleted) VALUES ('2','2025-05-07 18:19:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45354d544e664d44493d','52476c7a59323931626e513d','minus','5a476c7a59323931626e513d','0');

INSERT INTO af_charges (id, created_date_time, creator, creator_name, charges_id, charges_name, action, lower_case_name, deleted) VALUES ('3','2025-05-10 17:48:54','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e5451344e5452664d444d3d','64484a68626e4e7762334a3049454e6f59584a6e5a513d3d','plus','64484a68626e4e7762334a3049474e6f59584a6e5a513d3d','0');


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


INSERT INTO af_company (id, created_date_time, creator, creator_name, company_id, name, lower_case_name, address, state, district, city, others_city, pincode, gst_number, mobile_number, company_details, logo, primary_company, deleted) VALUES ('1','2025-04-29 17:18:35','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d6a6b774e4449774d6a55774e5445344d7a56664d44453d','5157356e595778685a584e3359584a7049455a70636d563362334a7263773d3d','5957356e595778685a584e3359584a7049475a70636d563362334a7263773d3d','4d6938314e544d74565377674d6938314e544d745669776755326c325957746863326b6754574670626942536232466b','5647467461577767546d466b64513d3d','566d6c796457526f645735685a324679','5532463064485679','NULL','4e6a49324d6a417a','4d6a4a4251554642515441774d4442424d566f31','4f5441354d446b774f5441354d413d3d','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','logo_29_04_2025_05_18_34.png','1','0');


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


INSERT INTO af_consumption_entry (id, created_date_time, creator, creator_name, bill_company_id, company_details, consumption_id, entry_date, consumption_entry_number, contractor_id, contractor_details, contractor_mobile_city, godown_type, godown_id, product_id, quantity, content, unit_type, total_quantity, cancelled, deleted) VALUES ('1','2025-05-10 13:08:56','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','4d5441774e5449774d6a55774d5441344e5464664d44453d','2025-05-10','CON001/25-26','','','','1','4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d,4d5441774e5449774d6a55784d6a51344d4442664d44453d','10,1','20,NULL','2,1','11','1','0');

INSERT INTO af_consumption_entry (id, created_date_time, creator, creator_name, bill_company_id, company_details, consumption_id, entry_date, consumption_entry_number, contractor_id, contractor_details, contractor_mobile_city, godown_type, godown_id, product_id, quantity, content, unit_type, total_quantity, cancelled, deleted) VALUES ('2','2025-05-10 13:38:02','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','4d5441774e5449774d6a55774d544d344d444a664d44493d','2025-05-10','CON002/25-26','','','','1','4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d,4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','10,10','20,10','2,1','20','0','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_customer (id, created_date_time, creator, creator_name, customer_id, customer_name, lower_case_name, address, city, district, state, identification, mobile_number, others_city, agent_id, agent_name, customer_details, opening_balance, opening_balance_type, name_mobile_city, deleted) VALUES ('1','2025-05-10 16:30:45','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e444d774e4456664d44453d','545856756157467959576f3d','625856756157467959576f3d','4f544d324c7a45304c57497349464e6f6157527049464231636d45675257467a6443776755474679617942536232466b4c43424c59584a76624342435957646f','51577868626d523163673d3d','5132686c626d356861513d3d','5647467461577767546d466b64513d3d','NULL','4f44517a4f5441304d7a417a4d673d3d','','4d5441774e5449774d6a55774e4449354e4446664d44453d','553356696147453d','545856756157467959576f6b4a4351354d7a59764d54517459697767553268705a476b67554856795953424659584e304c43425159584a7249464a765957517349457468636d397349454a685a32676b4a435242624746755a4856794a43516b5132686c626d35686153684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467304d7a6b774e444d774d7a493d','','','545856756157467959576f674b4467304d7a6b774e444d774d7a49704943306751577868626d523163673d3d','0');

INSERT INTO af_customer (id, created_date_time, creator, creator_name, customer_id, customer_name, lower_case_name, address, city, district, state, identification, mobile_number, others_city, agent_id, agent_name, customer_details, opening_balance, opening_balance_type, name_mobile_city, deleted) VALUES ('2','2025-05-10 16:31:08','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e444d784d4468664d44493d','546d6c795957743162474675','626d6c795957743162474675','4e69424c636d6c7a61473568494535706432467a4c4342516243424f627930794d54416755694242494574705a486468615342535a4377675632466b59577868','5247566f636d453d','5232397459585270','56484a706348567959513d3d','NULL','4f4451774d444d774d7a41774d773d3d','','4d5441774e5449774d6a55774e4449354e4446664d44453d','553356696147453d','546d6c7959577431624746754a43516b4e69424c636d6c7a61473568494535706432467a4c4342516243424f627930794d54416755694242494574705a486468615342535a4377675632466b595778684a43516b5247566f636d456b4a4352486232316864476b6f52476c7a644334704a43516b56484a70634856795953516b4a43424e62324a70624755674f6941344e4441774d7a417a4d44417a','','','546d6c795957743162474675494367344e4441774d7a417a4d44417a4b5341744945526c61484a68','0');

INSERT INTO af_customer (id, created_date_time, creator, creator_name, customer_id, customer_name, lower_case_name, address, city, district, state, identification, mobile_number, others_city, agent_id, agent_name, customer_details, opening_balance, opening_balance_type, name_mobile_city, deleted) VALUES ('3','2025-05-10 16:31:26','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70','5a584e3359584a70','4e6a41784c4341324d444573494546756157746c6443424364576c735a476c755a7977675179424849464a765957517349453568646e4a68626d647764584a68','5132686c65586c3163673d3d','5132686c626d64686248426864485231','5647467461577767546d466b64513d3d','NULL','4f446b774d7a41774d7a49774d413d3d','','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','52584e3359584a704a43516b4e6a41784c4341324d444573494546756157746c6443424364576c735a476c755a7977675179424849464a765957517349453568646e4a68626d647764584a684a43516b5132686c65586c316369516b4a454e6f5a57356e59577877595852306453684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467354d444d774d444d794d44413d','','','52584e3359584a70494367344f54417a4d44417a4d6a41774b53417449454e6f5a586c356458493d','0');

INSERT INTO af_customer (id, created_date_time, creator, creator_name, customer_id, customer_name, lower_case_name, address, city, district, state, identification, mobile_number, others_city, agent_id, agent_name, customer_details, opening_balance, opening_balance_type, name_mobile_city, deleted) VALUES ('4','2025-05-10 16:31:37','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e444d784d7a68664d44513d','51584a686333553d','59584a686333553d','4e437767533246776157526863794244623231775a43347349464e6865574675615342536232466b4c69776755484a68596d68685a47563261513d3d','52326c715957673d','52336c6862484e6f6157356e','55326c7261326c74','NULL','4f444d794f54417a4d6a41774d773d3d','','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','51584a686333556b4a4351304c43424c595842705a47467a49454e766258426b4c697767553246355957357049464a76595751754c434251636d46696147466b5a585a704a43516b52326c715957676b4a4352486557467363326870626d636f52476c7a644334704a43516b55326c7261326c744a43516b49453176596d6c735a5341364944677a4d6a6b774d7a49774d444d3d','','','51584a68633355674b44677a4d6a6b774d7a49774d444d704943306752326c715957673d','0');

INSERT INTO af_customer (id, created_date_time, creator, creator_name, customer_id, customer_name, lower_case_name, address, city, district, state, identification, mobile_number, others_city, agent_id, agent_name, customer_details, opening_balance, opening_balance_type, name_mobile_city, deleted) VALUES ('5','2025-05-10 16:32:19','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e444d794d546c664d44553d','533246326157343d','613246326157343d','4f4338794d53776752476c755957356864476767545746755a476c794c4342425a3246796432467349453168636d746c64437767566d6c735a53425159584a735a53686c4b513d3d','51573169595852306458493d','5132686c626d356861513d3d','5647467461577767546d466b64513d3d','NULL','4e7a4d354d44417a4d4441304f413d3d','','','','533246326157346b4a4351344c7a49784c43424561573568626d46306143424e5957356b615849734945466e59584a335957776754574679613256304c4342576157786c49464268636d786c4b4755704a43516b51573169595852306458496b4a43524461475675626d46704b455270633351754b53516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f674e7a4d354d44417a4d4441304f413d3d','4000','Debit','53324632615734674b44637a4f5441774d7a41774e4467704943306751573169595852306458493d','0');

INSERT INTO af_customer (id, created_date_time, creator, creator_name, customer_id, customer_name, lower_case_name, address, city, district, state, identification, mobile_number, others_city, agent_id, agent_name, customer_details, opening_balance, opening_balance_type, name_mobile_city, deleted) VALUES ('6','2025-05-10 16:32:44','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b6147453d','6333566b6147453d','4d6a41304c43424b49464e6f59573572595849675532686c64476767556d39685a437767546d56686369424859576c33595752704c43424861584a6e59573975','5632567a6443424c6232787259585268','533239736132463059513d3d','5632567a644342435a57356e5957773d','NULL','4f44497a4d44417a4d6a6b774d773d3d','','','','5533566b6147456b4a4351794d44517349456f6755326868626d74686369425461475630614342536232466b4c43424f5a57467949456468615864685a476b7349456470636d64686232346b4a4352585a584e3049457476624774686447456b4a43524c62327872595852684b455270633351754b53516b4a46646c63335167516d56755a3246734a43516b49453176596d6c735a534136494467794d7a41774d7a49354d444d3d','9000','Debit','5533566b614745674b4467794d7a41774d7a49354d444d70494330675632567a6443424c6232787259585268','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_daily_production (id, created_date_time, creator, creator_name, bill_company_id, company_details, daily_production_id, daily_production_number, entry_date, factory_id, factory_name_location, factory_details, magazine_id, magazine_name_location, magazine_details, contractor_id, contractor_name_mobile_city, contractor_details, product_id, product_name, unit_id, unit_name, quantity, subunit_contains, cooly_per_qty, cooly_rate, overall_cooly_total, total_quantity, cancelled, deleted) VALUES ('1','2025-05-10 13:31:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','4d5441774e5449774d6a55774d544d784d6a4a664d44453d','DAP001/25-26','2025-05-10','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270494330675532463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270494330675532463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','','','','4d5441774e5449774d6a55784d6a55354d7a42664d44633d,4d5441774e5449774d6a55774d5441774d4446664d44673d','4d544967553268766443424e64577830615342536157526c63673d3d,4d7a4167553268766443424e6457783061534244623278766458493d','4d4459774e5449774d6a55774e7a41784d446c664d44453d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','516d3934,5132467a5a513d3d','100,3','10,30','','','','103','1','0');

INSERT INTO af_daily_production (id, created_date_time, creator, creator_name, bill_company_id, company_details, daily_production_id, daily_production_number, entry_date, factory_id, factory_name_location, factory_details, magazine_id, magazine_name_location, magazine_details, contractor_id, contractor_name_mobile_city, contractor_details, product_id, product_name, unit_id, unit_name, quantity, subunit_contains, cooly_per_qty, cooly_rate, overall_cooly_total, total_quantity, cancelled, deleted) VALUES ('2','2025-05-10 17:34:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','4d5441774e5449774d6a55774e544d304d4456664d44493d','DAP002/25-26','2025-05-10','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270494330675532463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270494330675532463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','','','','4d5441774e5449774d6a55784d6a55354d7a42664d44633d,4d5441774e5449774d6a55774d5441774d4446664d44673d','4d544967553268766443424e64577830615342536157526c63673d3d,4d7a4167553268766443424e6457783061534244623278766458493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d,5132467a5a513d3d','6,12','10,30','','','','18','0','0');

INSERT INTO af_daily_production (id, created_date_time, creator, creator_name, bill_company_id, company_details, daily_production_id, daily_production_number, entry_date, factory_id, factory_name_location, factory_details, magazine_id, magazine_name_location, magazine_details, contractor_id, contractor_name_mobile_city, contractor_details, product_id, product_name, unit_id, unit_name, quantity, subunit_contains, cooly_per_qty, cooly_rate, overall_cooly_total, total_quantity, cancelled, deleted) VALUES ('3','2025-05-10 17:36:30','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','4d5441774e5449774d6a55774e544d324d7a46664d444d3d','DAP003/25-26','2025-05-10','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270494330675532463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270494330675532463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','','','','4d5441774e5449774d6a55774e544d324d446c664d446b3d','51323973623356794947747664476b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','7','50','','','','7','0','0');

INSERT INTO af_daily_production (id, created_date_time, creator, creator_name, bill_company_id, company_details, daily_production_id, daily_production_number, entry_date, factory_id, factory_name_location, factory_details, magazine_id, magazine_name_location, magazine_details, contractor_id, contractor_name_mobile_city, contractor_details, product_id, product_name, unit_id, unit_name, quantity, subunit_contains, cooly_per_qty, cooly_rate, overall_cooly_total, total_quantity, cancelled, deleted) VALUES ('4','2025-05-12 11:26:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','4d5449774e5449774d6a55784d5449324d5452664d44513d','DAP004/25-26','2025-05-12','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270494330675532463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270494330675532463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','','','','4d5441774e5449774d6a55774e544d354e4464664d54413d,4d5441774e5449774d6a55774e544d324d446c664d446b3d','524756736458686c,51323973623356794947747664476b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d,5132467a5a513d3d','10,10','28,50','','','','20','0','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_delivery_slip (id, created_date_time, creator, creator_name, bill_company_id, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, bill_total, cancelled, deleted) VALUES ('1','2025-05-10 16:53:27','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e44557a4d6a64664d44453d','DS001/25-26','2025-05-10','4d5441774e5449774d6a55774e4451354d446c664d44493d','PI002/25-26','2025-05-10','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b614745674b4467794d7a41774d7a49354d444d70494330675632567a6443424c6232787259585268','5533566b6147456b4a4351794d44517349456f6755326868626d74686369425461475630614342536232466b4c43424f5a57467949456468615864685a476b7349456470636d64686232346b4a4352585a584e3049457476624774686447456b4a43524c62327872595852684b455270633351754b53516b4a46646c63335167516d56755a3246734a43516b49453176596d6c735a534136494467794d7a41774d7a49354d444d3d','NULL','NULL','NULL','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d4463774e5449774d6a55774e6a45344e446c664d44453d','1','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','','','','','NULL','Tamil Nadu','West Bengal','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','','4d544967553268766443424e64577830615342536157526c63673d3d','2','1','10','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','5','20','1','2','NULL','20','100.00','NULL','NULL','NULL','','100.00','0','0');

INSERT INTO af_delivery_slip (id, created_date_time, creator, creator_name, bill_company_id, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, bill_total, cancelled, deleted) VALUES ('2','2025-05-10 16:54:19','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e4455304d546c664d44493d','DS002/25-26','2025-05-10','4d5441774e5449774d6a55774e4451354d446c664d44493d','PI002/25-26','2025-05-10','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b614745674b4467794d7a41774d7a49354d444d70494330675632567a6443424c6232787259585268','5533566b6147456b4a4351794d44517349456f6755326868626d74686369425461475630614342536232466b4c43424f5a57467949456468615864685a476b7349456470636d64686232346b4a4352585a584e3049457476624774686447456b4a43524c62327872595852684b455270633351754b53516b4a46646c63335167516d56755a3246734a43516b49453176596d6c735a534136494467794d7a41774d7a49354d444d3d','NULL','NULL','NULL','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d4463774e5449774d6a55774e6a45344e446c664d44453d','1','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','','','','','NULL','Tamil Nadu','West Bengal','4d5441774e5449774d6a55784d6a55354d7a42664d44633d,4d5441774e5449774d6a55774d5441774d4446664d44673d',',','4d544967553268766443424e64577830615342536157526c63673d3d,4d7a4167553268766443424e6457783061534244623278766458493d','2,1','1,1','10,30','4d4459774e5449774d6a55774e7a41784d446c664d44453d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','516d3934,5132467a5a513d3d','5,5','20,200','1,1','2,1','NULL','20,200','100.00,1000.00','NULL','NULL','NULL','','1100.00','0','0');

INSERT INTO af_delivery_slip (id, created_date_time, creator, creator_name, bill_company_id, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, bill_total, cancelled, deleted) VALUES ('3','2025-05-10 17:09:18','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e5441354d546c664d444d3d','DS003/25-26','2025-05-10','4d5441774e5449774d6a55774e4451354d446c664d44493d','PI002/25-26','2025-05-10','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b614745674b4467794d7a41774d7a49354d444d70494330675632567a6443424c6232787259585268','5533566b6147456b4a4351794d44517349456f6755326868626d74686369425461475630614342536232466b4c43424f5a57467949456468615864685a476b7349456470636d64686232346b4a4352585a584e3049457476624774686447456b4a43524c62327872595852684b455270633351754b53516b4a46646c63335167516d56755a3246734a43516b49453176596d6c735a534136494467794d7a41774d7a49354d444d3d','NULL','NULL','NULL','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d4463774e5449774d6a55774e6a45344e446c664d44453d','1','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','','','','','NULL','Tamil Nadu','West Bengal','4d5441774e5449774d6a55774d5441774d4446664d44673d','','4d7a4167553268766443424e6457783061534244623278766458493d','1','1','30','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','5','200','1','1','NULL','200','1000.00','NULL','NULL','NULL','','1000.00','0','0');

INSERT INTO af_delivery_slip (id, created_date_time, creator, creator_name, bill_company_id, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, bill_total, cancelled, deleted) VALUES ('4','2025-05-10 17:46:33','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e5451324d7a4e664d44513d','DS004/25-26','2025-05-10','4d5441774e5449774d6a55774e5451784d444a664d444d3d','PI003/25-26','2025-05-10','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70494367344f54417a4d44417a4d6a41774b53417449454e6f5a586c356458493d','52584e3359584a704a43516b4e6a41784c4341324d444573494546756157746c6443424364576c735a476c755a7977675179424849464a765957517349453568646e4a68626d647764584a684a43516b5132686c65586c316369516b4a454e6f5a57356e59577877595852306453684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467354d444d774d444d794d44413d','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f6453416f4f4451774e4441774d7a41774d796b674c53424962334a68','5457466f5a584e6f4946427959574a6f64547869636a354962334a6850474a79506b467361576468636d676f52476c7a6443347050474a79506c563064474679494642795957526c63326738596e492b49453176596d6c735a534136494467304d4451774d444d774d444d3d','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','1','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','','601, 601, Aniket Building, C G Road, Navrangpura','','','NULL','Tamil Nadu','Tamil Nadu','4d5441774e5449774d6a55774e544d324d446c664d446b3d','','51323973623356794947747664476b3d','1','1','50','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','5','95','1','2','NULL','4750','23750.00','NULL','NULL','NULL','','23750.00','0','0');

INSERT INTO af_delivery_slip (id, created_date_time, creator, creator_name, bill_company_id, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, bill_total, cancelled, deleted) VALUES ('5','2025-05-10 18:14:52','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e6a45304e544a664d44553d','DS005/25-26','2025-05-10','4d5441774e5449774d6a55774e6a45304d7a52664d44513d','PI004/25-26','2025-05-10','4d5441774e5449774d6a55774e444d774e4456664d44453d','545856756157467959576f674b4467304d7a6b774e444d774d7a49704943306751577868626d523163673d3d','545856756157467959576f6b4a4351354d7a59764d54517459697767553268705a476b67554856795953424659584e304c43425159584a7249464a765957517349457468636d397349454a685a32676b4a435242624746755a4856794a43516b5132686c626d35686153684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467304d7a6b774e444d774d7a493d','4d5441774e5449774d6a55774e4449354e4446664d44453d','55335669614745674b4467304f5451344f544d774d444d704943306751577868626d523163673d3d','5533566961474538596e492b51577868626d5231636a7869636a354461475675626d46704b455270633351754b547869636a3555595731706243424f5957523150474a795069424e62324a70624755674f6941344e446b304f446b7a4d44417a','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','1','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','','936/14-b, Shidi Pura East, Park Road, Karol Bagh','','','NULL','Tamil Nadu','Tamil Nadu','4d5441774e5449774d6a55774e544d324d446c664d446b3d','','51323973623356794947747664476b3d','1','1','50','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','2','95','1','2','NULL','4750','9500.00','NULL','NULL','NULL','','9500.00','0','0');

INSERT INTO af_delivery_slip (id, created_date_time, creator, creator_name, bill_company_id, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, bill_total, cancelled, deleted) VALUES ('6','2025-05-10 19:30:21','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e7a4d774d6a4a664d44593d','DS006/25-26','2025-05-10','4d5441774e5449774d6a55774e4451794d7a52664d44453d','PI001/25-26','2025-05-10','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70494367344f54417a4d44417a4d6a41774b53417449454e6f5a586c356458493d','52584e3359584a704a43516b4e6a41784c4341324d444573494546756157746c6443424364576c735a476c755a7977675179424849464a765957517349453568646e4a68626d647764584a684a43516b5132686c65586c316369516b4a454e6f5a57356e59577877595852306453684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467354d444d774d444d794d44413d','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f6453416f4f4451774e4441774d7a41774d796b674c53424962334a68','5457466f5a584e6f4946427959574a6f64547869636a354962334a6850474a79506b467361576468636d676f52476c7a6443347050474a79506c563064474679494642795957526c63326738596e492b49453176596d6c735a534136494467304d4451774d444d774d444d3d','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','1','4d4463774e5449774d6a55774e6a51774d4456664d44493d','','204, J Shankar Sheth Road, Near Gaiwadi, Girgaon','','','NULL','Tamil Nadu','Tamil Nadu','4d5441774e5449774d6a55784d6a55344e546c664d44593d,4d5441774e5449774d6a55784d6a55344e546c664d44593d',',','516d466b595342515a57466a62324e72,516d466b595342515a57466a62324e72','2,1','1,1','10,10','4d4459774e5449774d6a55774e7a41784d446c664d44493d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','55476c6c5932553d,5132467a5a513d3d','100,10','30,30','1,1','2,2','','30,300','3000.00,3000.00','NULL','NULL','NULL','','6000.00','0','0');


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
  `proforma_invoice_id` mediumtext DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_estimate (id, created_date_time, creator, creator_name, bill_company_id, estimate_id, estimate_number, estimate_date, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('1','2025-05-10 17:20:33','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e5449774d7a4e664d44453d','EST001/25-26','2025-05-10','4d5441774e5449774d6a55774e4455304d546c664d44493d','DS002/25-26','','','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b614745674b4467794d7a41774d7a49354d444d70494330675632567a6443424c6232787259585268','5533566b6147456b4a4351794d44517349456f6755326868626d74686369425461475630614342536232466b4c43424f5a57467949456468615864685a476b7349456470636d64686232346b4a4352585a584e3049457476624774686447456b4a43524c62327872595852684b455270633351754b53516b4a46646c63335167516d56755a3246734a43516b49453176596d6c735a534136494467794d7a41774d7a49354d444d3d','NULL','NULL','NULL','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','1','','1','2','18%','Tamil Nadu','West Bengal','4d5441774e5449774d6a55774d5441774d4446664d44673d,4d5441774e5449774d6a55784d6a55354d7a42664d44633d','','4d7a4167553268766443424e6457783061534244623278766458493d,4d544967553268766443424e64577830615342536157526c63673d3d','1,2','1,1','30,10','4d4459774e5449774d6a55774e7a41784d446c664d444d3d,4d4459774e5449774d6a55774e7a41784d446c664d44453d','5132467a5a513d3d,516d3934','5,5','200,20','1,1','1,2',',','200,20','1000.00,100.00','4d4463774e5449774d6a55774e6a45354d544e664d44493d,4d4463774e5449774d6a55774e6a45354d544e664d44453d','minus,plus','10%,4%','','1100','1029.60','0','0','185.33','185.33','0.07','110.00,39.60','1215','0','0');

INSERT INTO af_estimate (id, created_date_time, creator, creator_name, bill_company_id, estimate_id, estimate_number, estimate_date, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('2','2025-05-10 17:47:56','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e5451334e545a664d44493d','EST002/25-26','2025-05-10','4d5441774e5449774d6a55774e5451324d7a4e664d44513d','DS004/25-26','','','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70494367344f54417a4d44417a4d6a41774b53417449454e6f5a586c356458493d','52584e3359584a704a43516b4e6a41784c4341324d444573494546756157746c6443424364576c735a476c755a7977675179424849464a765957517349453568646e4a68626d647764584a684a43516b5132686c65586c316369516b4a454e6f5a57356e59577877595852306453684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467354d444d774d444d794d44413d','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f6453416f4f4451774e4441774d7a41774d796b674c53424962334a68','5457466f5a584e6f4946427959574a6f64547869636a354962334a6850474a79506b467361576468636d676f52476c7a6443347050474a79506c563064474679494642795957526c63326738596e492b49453176596d6c735a534136494467304d4451774d444d774d444d3d','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','','','','601, 601, Aniket Building, C G Road, Navrangpura','','','NULL','Tamil Nadu','Tamil Nadu','4d5441774e5449774d6a55774e544d324d446c664d446b3d','','51323973623356794947747664476b3d','1','1','50','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','5','95','1','2','','4750','23750.00','4d4463774e5449774d6a55774e6a45354d544e664d44453d','plus','1800','30','23750','18425.00','0','0','0','0','0','1800','18425.00','0','1');

INSERT INTO af_estimate (id, created_date_time, creator, creator_name, bill_company_id, estimate_id, estimate_number, estimate_date, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('3','2025-05-10 17:49:17','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e5451354d5464664d444d3d','EST003/25-26','2025-05-10','4d5441774e5449774d6a55774e5451324d7a4e664d44513d','DS004/25-26','','','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70494367344f54417a4d44417a4d6a41774b53417449454e6f5a586c356458493d','52584e3359584a704a43516b4e6a41784c4341324d444573494546756157746c6443424364576c735a476c755a7977675179424849464a765957517349453568646e4a68626d647764584a684a43516b5132686c65586c316369516b4a454e6f5a57356e59577877595852306453684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467354d444d774d444d794d44413d','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f6453416f4f4451774e4441774d7a41774d796b674c53424962334a68','5457466f5a584e6f4946427959574a6f64547869636a354962334a6850474a79506b467361576468636d676f52476c7a6443347050474a79506c563064474679494642795957526c63326738596e492b49453176596d6c735a534136494467304d4451774d444d774d444d3d','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','','','','601, 601, Aniket Building, C G Road, Navrangpura','','','NULL','Tamil Nadu','Tamil Nadu','4d5441774e5449774d6a55774e544d324d446c664d446b3d','','51323973623356794947747664476b3d','1','1','50','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','5','95','1','2','','4750','23750.00','4d5441774e5449774d6a55774e5451344e5452664d444d3d,4d4463774e5449774d6a55774e6a45354d544e664d44453d','plus,plus','500,1800','3.5','23750','25218.75','0','0','0','0','0.25','500,1800','25219','0','0');

INSERT INTO af_estimate (id, created_date_time, creator, creator_name, bill_company_id, estimate_id, estimate_number, estimate_date, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('4','2025-05-10 18:15:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e6a45314d544e664d44513d','EST004/25-26','2025-05-10','4d5441774e5449774d6a55774e6a45304e544a664d44553d','DS005/25-26','','','4d5441774e5449774d6a55774e444d774e4456664d44453d','545856756157467959576f674b4467304d7a6b774e444d774d7a49704943306751577868626d523163673d3d','545856756157467959576f6b4a4351354d7a59764d54517459697767553268705a476b67554856795953424659584e304c43425159584a7249464a765957517349457468636d397349454a685a32676b4a435242624746755a4856794a43516b5132686c626d35686153684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467304d7a6b774e444d774d7a493d','4d5441774e5449774d6a55774e4449354e4446664d44453d','55335669614745674b4467304f5451344f544d774d444d704943306751577868626d523163673d3d','5533566961474538596e492b51577868626d5231636a7869636a354461475675626d46704b455270633351754b547869636a3555595731706243424f5957523150474a795069424e62324a70624755674f6941344e446b304f446b7a4d44417a','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','','','','936/14-b, Shidi Pura East, Park Road, Karol Bagh','','','NULL','Tamil Nadu','Tamil Nadu','4d5441774e5449774d6a55774e544d324d446c664d446b3d','','51323973623356794947747664476b3d','1','1','50','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','2','105','1','2','','5250','10500.00','4d4463774e5449774d6a55774e6a45354d544e664d44493d,4d5441774e5449774d6a55774e5451344e5452664d444d3d','minus,plus','6%,5%','20','10500','8290.80','0','0','0','0','0.20','504.00,394.80','8291','0','0');

INSERT INTO af_estimate (id, created_date_time, creator, creator_name, bill_company_id, estimate_id, estimate_number, estimate_date, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('5','2025-05-10 19:24:16','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e7a49304d545a664d44553d','EST005/25-26','2025-05-10','4d5441774e5449774d6a55774e44557a4d6a64664d44453d','DS001/25-26','','4d5441774e5449774d6a55774e4451354d446c664d44493d','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b614745674b4467794d7a41774d7a49354d444d70494330675632567a6443424c6232787259585268','5533566b6147456b4a4351794d44517349456f6755326868626d74686369425461475630614342536232466b4c43424f5a57467949456468615864685a476b7349456470636d64686232346b4a4352585a584e3049457476624774686447456b4a43524c62327872595852684b455270633351754b53516b4a46646c63335167516d56755a3246734a43516b49453176596d6c735a534136494467794d7a41774d7a49354d444d3d','NULL','NULL','NULL','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','','','','','NULL','Tamil Nadu','West Bengal','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','','4d544967553268766443424e64577830615342536157526c63673d3d','2','1','10','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','5','20','1','2','','20','100.00','NULL','NULL','NULL','','100','100.00','0','0','0','0','0','NULL','100.00','0','0');

INSERT INTO af_estimate (id, created_date_time, creator, creator_name, bill_company_id, estimate_id, estimate_number, estimate_date, delivery_slip_id, delivery_slip_number, delivery_slip_date, proforma_invoice_id, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, magazine_type, magazine_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('6','2025-05-10 19:30:31','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e7a4d774d7a46664d44593d','EST006/25-26','2025-05-10','4d5441774e5449774d6a55774e7a4d774d6a4a664d44593d','DS006/25-26','','4d5441774e5449774d6a55774e4451794d7a52664d44453d','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70494367344f54417a4d44417a4d6a41774b53417449454e6f5a586c356458493d','52584e3359584a704a43516b4e6a41784c4341324d444573494546756157746c6443424364576c735a476c755a7977675179424849464a765957517349453568646e4a68626d647764584a684a43516b5132686c65586c316369516b4a454e6f5a57356e59577877595852306453684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467354d444d774d444d794d44413d','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f6453416f4f4451774e4441774d7a41774d796b674c53424962334a68','5457466f5a584e6f4946427959574a6f64547869636a354962334a6850474a79506b467361576468636d676f52476c7a6443347050474a79506c563064474679494642795957526c63326738596e492b49453176596d6c735a534136494467304d4451774d444d774d444d3d','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','','','','204, J Shankar Sheth Road, Near Gaiwadi, Girgaon','','','NULL','Tamil Nadu','Tamil Nadu','4d5441774e5449774d6a55784d6a55344e546c664d44593d,4d5441774e5449774d6a55784d6a55344e546c664d44593d','','516d466b595342515a57466a62324e72,516d466b595342515a57466a62324e72','1,2','1,1','10,10','4d4459774e5449774d6a55774e7a41784d446c664d444d3d,4d4459774e5449774d6a55774e7a41784d446c664d44493d','5132467a5a513d3d,55476c6c5932553d','10,100','30,30','1,1','2,2',',','300,30','3000.00,3000.00','NULL','NULL','NULL','3.5','6000','5790.00','0','0','0','0','0','NULL','5790.00','0','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_factory (id, created_date_time, creator, creator_name, factory_id, factory_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, factory_details, deleted) VALUES ('1','2025-05-06 18:28:36','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','63326c325957746863326b3d','55326c325957746863326b3d','51584a3162413d3d','59584a3162413d3d','4f4459784d4441324d5467304e413d3d','51584a3162413d3d','51575274615734784d6a4e41','55326c325957746863326b674c53425461585a686132467a61513d3d','63326c325957746863326b674c53427a61585a686132467a61513d3d','55326c325957746863326b6b4a43525461585a686132467a6153516b4a456c7559326868636d646c4943306751584a316243416f4f4459784d4441324d5467304e436b3d','0');

INSERT INTO af_factory (id, created_date_time, creator, creator_name, factory_id, factory_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, factory_details, deleted) VALUES ('2','2025-05-07 18:40:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b3d','63334a70646d6b3d','55334a70646d6c7362476c77645852306458493d','55326868626d31315a324674','63326868626d31315a324674','4f446b334e6a67344f546b334e773d3d','63326868626d31315a324674','51575274615734784d6a4e41','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','63334a70646d6b674c53427a636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','0');

INSERT INTO af_factory (id, created_date_time, creator, creator_name, factory_id, factory_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, factory_details, deleted) VALUES ('3','2025-05-08 14:45:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270','634746795958426864485270','5532463064485679','51584a3162413d3d','59584a3162413d3d','4f4459784d4441334d7a59334e773d3d','6158453d','51575274615734784d6a4e41','554746795958426864485270494330675532463064485679','634746795958426864485270494330676332463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_finished_group (id, created_date_time, creator, creator_name, finished_group_id, finished_group_name, lower_case_name, deleted) VALUES ('1','2025-05-10 12:57:21','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55784d6a55334d6a46664d44453d','5458567364476b67556d6c6b5a5849675532687664413d3d','6258567364476b67636d6c6b5a5849676332687664413d3d','0');

INSERT INTO af_finished_group (id, created_date_time, creator, creator_name, finished_group_id, finished_group_name, lower_case_name, deleted) VALUES ('2','2025-05-10 12:57:21','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55784d6a55334d6a46664d44493d','5458567364476b675132397362335679','6258567364476b675932397362335679','0');

INSERT INTO af_finished_group (id, created_date_time, creator, creator_name, finished_group_id, finished_group_name, lower_case_name, deleted) VALUES ('3','2025-05-10 12:57:21','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55784d6a55334d6a46664d444d3d','554756685932396a61794247623356756447467062673d3d','634756685932396a6179426d623356756447467062673d3d','0');

INSERT INTO af_finished_group (id, created_date_time, creator, creator_name, finished_group_id, finished_group_name, lower_case_name, deleted) VALUES ('4','2025-05-10 17:34:55','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e544d304e5456664d44513d','636d396a61325630','636d396a61325630','0');

INSERT INTO af_finished_group (id, created_date_time, creator, creator_name, finished_group_id, finished_group_name, lower_case_name, deleted) VALUES ('5','2025-05-10 17:34:55','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e544d304e5456664d44553d','596d397459673d3d','596d397459673d3d','0');

INSERT INTO af_finished_group (id, created_date_time, creator, creator_name, finished_group_id, finished_group_name, lower_case_name, deleted) VALUES ('6','2025-05-10 17:34:55','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e544d304e5456664d44593d','593268686132746863673d3d','593268686132746863673d3d','0');

INSERT INTO af_finished_group (id, created_date_time, creator, creator_name, finished_group_id, finished_group_name, lower_case_name, deleted) VALUES ('7','2025-05-10 17:34:55','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e544d304e5456664d44633d','5a6d7876643256794948427664413d3d','5a6d7876643256794948427664413d3d','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_godown (id, created_date_time, creator, creator_name, godown_id, godown_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, godown_details, factory_id, deleted) VALUES ('1','2025-05-06 18:28:36','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','63326c325957746863326b3d','55326c325957746863326b3d','51584a3162413d3d','59584a3162413d3d','4f4459784d4441324d5467304e413d3d','51584a3162413d3d','51575274615734784d6a4e41','55326c325957746863326b674c53425461585a686132467a61513d3d','63326c325957746863326b674c53427a61585a686132467a61513d3d','55326c325957746863326b6b4a43525461585a686132467a6153516b4a456c7559326868636d646c4943306751584a316243416f4f4459784d4441324d5467304e436b3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','0');

INSERT INTO af_godown (id, created_date_time, creator, creator_name, godown_id, godown_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, godown_details, factory_id, deleted) VALUES ('2','2025-05-07 18:40:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b3d','63334a70646d6b3d','55334a70646d6c7362476c77645852306458493d','55326868626d31315a324674','63326868626d31315a324674','4f446b334e6a67344f546b334e773d3d','63326868626d31315a324674','51575274615734784d6a4e41','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','63334a70646d6b674c53427a636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','0');

INSERT INTO af_godown (id, created_date_time, creator, creator_name, godown_id, godown_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, godown_details, factory_id, deleted) VALUES ('3','2025-05-08 14:45:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270','634746795958426864485270','5532463064485679','51584a3162413d3d','59584a3162413d3d','4f4459784d4441334d7a59334e773d3d','6158453d','51575274615734784d6a4e41','554746795958426864485270494330675532463064485679','634746795958426864485270494330676332463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('1','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-06 18:22:04','2025-05-06 18:22:04','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('2','51584a316243416f4f4459784d4441324d5467304e436b3d','2025-05-06 18:37:27','2025-05-06 18:37:44','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Factory Incharge','4d4459774e5449774d6a55774e6a49344d7a5a664d44493d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('3','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-06 19:00:43','2025-05-06 19:00:43','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('4','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-07 13:58:30','2025-05-07 13:58:30','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('5','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-07 18:11:08','2025-05-07 18:11:08','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('6','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-08 00:03:14','2025-05-08 00:03:14','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('7','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-08 06:47:50','2025-05-08 06:47:50','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('8','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-08 09:19:35','2025-05-08 09:19:35','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('9','545856756157467959576f674b4451314e6a63344f5441354f446370','2025-05-08 10:12:32','2025-05-08 10:12:32','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Staff','4d4463774e5449774d6a55774e6a45794d5446664d444d3d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('10','545856756157467959576f674b4451314e6a63344f5441354f446370','2025-05-08 10:18:24','2025-05-08 11:19:08','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Staff','4d4463774e5449774d6a55774e6a45794d5446664d444d3d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('11','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-08 14:44:23','2025-05-08 14:44:23','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('12','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-09 15:37:59','2025-05-09 15:37:59','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('13','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-09 16:10:09','2025-05-09 16:10:09','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('14','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-09 21:21:26','2025-05-09 21:21:26','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('15','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-10 00:00:23','2025-05-10 00:00:23','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('16','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-10 09:41:03','2025-05-10 17:30:17','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('17','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-10 17:30:46','2025-05-10 17:30:46','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('18','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-11 07:56:36','2025-05-11 07:56:36','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('19','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-11 16:51:16','2025-05-11 16:51:16','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('20','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-12 09:19:04','2025-05-12 09:29:54','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('21','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','2025-05-12 10:16:17','2025-05-12 10:16:17','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Super Admin','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','0');

INSERT INTO af_login (id, loginer_name, login_date_time, logout_date_time, ip_address, browser, os_detail, type, user_id, deleted) VALUES ('22','545856756157467959576f674b4451314e6a63344f5441354f446370','2025-05-12 14:45:19','2025-05-12 14:45:19','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:139.0) Gecko/20100101 Firefox/139.0','Windows NT DESKTOP-467MIBS 10.0 build 22631 (Windows 11) AMD64','Staff','4d4463774e5449774d6a55774e6a45794d5446664d444d3d','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_magazine (id, created_date_time, creator, creator_name, magazine_id, magazine_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, magazine_details, factory_id, godown_id, deleted) VALUES ('1','2025-05-06 18:28:36','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','55326c325957746863326b3d','63326c325957746863326b3d','55326c325957746863326b3d','51584a3162413d3d','59584a3162413d3d','4f4459784d4441324d5467304e413d3d','51584a3162413d3d','51575274615734784d6a4e41','55326c325957746863326b674c53425461585a686132467a61513d3d','63326c325957746863326b674c53427a61585a686132467a61513d3d','55326c325957746863326b6b4a43525461585a686132467a6153516b4a456c7559326868636d646c4943306751584a316243416f4f4459784d4441324d5467304e436b3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','','0');

INSERT INTO af_magazine (id, created_date_time, creator, creator_name, magazine_id, magazine_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, magazine_details, factory_id, godown_id, deleted) VALUES ('2','2025-05-07 18:40:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','55334a70646d6b3d','63334a70646d6b3d','55334a70646d6c7362476c77645852306458493d','55326868626d31315a324674','63326868626d31315a324674','4f446b334e6a67344f546b334e773d3d','63326868626d31315a324674','51575274615734784d6a4e41','55334a70646d6b674c534254636d6c3261577873615842316448523163673d3d','63334a70646d6b674c53427a636d6c3261577873615842316448523163673d3d','55334a70646d6b6b4a435254636d6c326157787361584231644852316369516b4a456c7559326868636d646c4943306755326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','','0');

INSERT INTO af_magazine (id, created_date_time, creator, creator_name, magazine_id, magazine_name, lower_case_name, location, incharge_name, lowercase_incharge_name, mobile_number, user_id, password, name_location, lowercase_name_location, magazine_details, factory_id, godown_id, deleted) VALUES ('3','2025-05-08 14:45:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270','634746795958426864485270','5532463064485679','51584a3162413d3d','59584a3162413d3d','4f4459784d4441334d7a59334e773d3d','6158453d','51575274615734784d6a4e41','554746795958426864485270494330675532463064485679','634746795958426864485270494330676332463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_material_transfer (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, material_transfer_id, material_transfer_date, material_transfer_number, location, from_location, to_location, product_id, product_name, unit_type, unit_id, unit_name, subunit_id, subunit_name, negative, content, quantity, quantity_limit, deleted, cancelled) VALUES ('1','2025-05-10 16:00:35','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','','4d5441774e5449774d6a55774e4441774d7a5a664d44453d','2025-05-10','MAT001/25-26','1','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5441774e5449774d6a55784d6a51344d4442664d44453d','554739306447467a61585674','1','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','5332633d','<br />
<b>Warning</b>:  Undefined array key 0 in <b>D:xampphtdocsworksangalaeswari_fireworksmaterial_transfer_changes.php</b> on line <b>259</b><br />','<br />
<b>Warning</b>:  Undefined array key 0 in <b>D:xampphtdocsworksangalaeswari_fireworksmaterial_transfer_changes.php</b> on line <b>260</b><br />','0','NULL','10','50','1','0');

INSERT INTO af_material_transfer (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, material_transfer_id, material_transfer_date, material_transfer_number, location, from_location, to_location, product_id, product_name, unit_type, unit_id, unit_name, subunit_id, subunit_name, negative, content, quantity, quantity_limit, deleted, cancelled) VALUES ('2','2025-05-10 16:14:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','','4d5441774e5449774d6a55774e4445304d7a4a664d44493d','2025-05-10','MAT002/25-26','2','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5441774e5449774d6a55774d5441774d4446664d44673d,4d5441774e5449774d6a55774d5441774d4446664d44673d','4d7a4167553268766443424e6457783061534244623278766458493d,4d7a4167553268766443424e6457783061534244623278766458493d','1,2','4d4459774e5449774d6a55774e7a41784d446c664d444d3d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d,5132467a5a513d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d,4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934,516d3934','0,0','30,30','1,100','13.33,400','0','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('1','2025-05-10 13:01:29','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774d5441784d6a6c664d44453d','001','2025-05-10 00:00:00','Purchase Bill','NULL','NULL','4d5441774e5449774d6a55784d6a51304d5452664d44493d','5533567961586c68','Supplier','NULL','NULL','NULL','NULL','Credit','4592','0','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('2','2025-05-10 13:03:35','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774d54417a4d7a56664d44493d','002','2025-05-10 00:00:00','Purchase Bill','NULL','NULL','4d5441774e5449774d6a55784d6a51304d5452664d44493d','5533567961586c68','Supplier','NULL','NULL','NULL','NULL','Credit','2466','0','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('3','2025-05-10 13:05:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774d5441314d7a4a664d444d3d','003','2025-05-10 00:00:00','Purchase Bill','NULL','NULL','4d5441774e5449774d6a55784d6a517a4d544a664d44453d','55326868626d31315a324674','Supplier','NULL','NULL','NULL','NULL','Credit','9000.00','0','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('4','2025-05-10 15:10:49','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774d7a45774e446c664d44513d','004','2025-05-10 00:00:00','Purchase Bill','NULL','NULL','4d5441774e5449774d6a55784d6a51304d5452664d44493d','5533567961586c68','Supplier','NULL','NULL','NULL','NULL','Credit','1','0','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('5','2025-05-10 16:29:41','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e4449354e4446664d44453d','NULL','2025-05-10 00:00:00','Agent Opening Balance','4d5441774e5449774d6a55774e4449354e4446664d44453d','553356696147453d','NULL','NULL','Agent','NULL','NULL','NULL','NULL','Credit','30000','0','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('6','2025-05-10 16:30:15','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e444d774d5456664d44493d','NULL','2025-05-10 00:00:00','Agent Opening Balance','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','NULL','NULL','Agent','NULL','NULL','NULL','NULL','Debit','0','7000','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('7','2025-05-10 16:32:19','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e444d794d546c664d44553d','NULL','2025-05-10 00:00:00','Customer Opening Balance','NULL','NULL','4d5441774e5449774d6a55774e444d794d546c664d44553d','533246326157343d','Customer','NULL','NULL','NULL','NULL','Debit','0','4000','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('8','2025-05-10 16:32:44','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e444d794e4452664d44593d','NULL','2025-05-10 00:00:00','Customer Opening Balance','NULL','NULL','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b6147453d','Customer','NULL','NULL','NULL','NULL','Debit','0','9000','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('9','2025-05-10 16:56:47','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e4455324e4468664d44553d','005','2025-05-10 00:00:00','Purchase Bill','NULL','NULL','4d5441774e5449774d6a55784d6a517a4d544a664d44453d','55326868626d31315a324674','Supplier','NULL','NULL','NULL','NULL','Credit','1000.00','0','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('10','2025-05-10 17:09:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e5441354d544e664d44593d','007','2025-05-10 00:00:00','Purchase Bill','NULL','NULL','4d5441774e5449774d6a55784d6a51304d5452664d44493d','5533567961586c68','Supplier','NULL','NULL','NULL','NULL','Credit','1000.00','0','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('11','2025-05-10 17:20:33','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e5449774d7a4e664d44453d','EST001/25-26','2025-05-10 00:00:00','Estimate','NULL','','NULL','NULL','Agent','NULL','NULL','NULL','NULL','Debit','0','1215','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('12','2025-05-10 17:47:56','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e5451334e545a664d44493d','EST002/25-26','2025-05-10 00:00:00','Estimate','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','NULL','NULL','Agent','NULL','NULL','NULL','NULL','Debit','0','18425.00','1');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('13','2025-05-10 17:49:17','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e5451354d5464664d444d3d','EST003/25-26','2025-05-10 00:00:00','Estimate','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','NULL','NULL','Agent','NULL','NULL','NULL','NULL','Debit','0','25219','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('14','2025-05-10 17:51:28','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e5455784d6a68664d44453d','RC001/25-26','2025-05-10 00:00:00','Receipt','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','Agent','4d4463774e5449774d6a55774e6a45344d6a64664d44453d','5132467a61413d3d','NULL','NULL','Credit','18000','0','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('15','2025-05-10 17:51:28','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e5455784d6a68664d44453d','RC001/25-26','2025-05-10 00:00:00','Receipt','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','Agent','4d4463774e5449774d6a55774e6a45344d6a64664d44493d','55476876626d56775a513d3d','4d4463774e5449774d6a55774e6a45344e446c664d44453d','55304a4a','Credit','3000','0','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('16','2025-05-10 18:15:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e6a45314d544e664d44513d','EST004/25-26','2025-05-10 00:00:00','Estimate','4d5441774e5449774d6a55774e4449354e4446664d44453d','553356696147453d','NULL','NULL','Agent','NULL','NULL','NULL','NULL','Debit','0','8291','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('17','2025-05-10 19:24:16','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e7a49304d545a664d44553d','EST005/25-26','2025-05-10 00:00:00','Estimate','NULL','','NULL','NULL','Agent','NULL','NULL','NULL','NULL','Debit','0','100.00','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('18','2025-05-10 19:30:31','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55774e7a4d774d7a46664d44593d','EST006/25-26','2025-05-10 00:00:00','Estimate','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','NULL','NULL','Agent','NULL','NULL','NULL','NULL','Debit','0','5790.00','0');

INSERT INTO af_payment (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, agent_id, agent_name, party_id, party_name, party_type, payment_mode_id, payment_mode_name, bank_id, bank_name, open_balance_type, credit, debit, deleted) VALUES ('19','2025-05-11 18:45:19','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','4d5441774e5449774d6a55784d6a51304d5452664d44493d','NULL','2025-05-11 00:00:00','Supplier Opening Balance','NULL','NULL','4d5441774e5449774d6a55784d6a51304d5452664d44493d','5533567961586c68','Supplier','NULL','NULL','NULL','NULL','Credit','30000','0','0');


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
  `raw_material_group_id` mediumtext DEFAULT NULL,
  `semi_finished_group_id` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, raw_material_group_id, semi_finished_group_id, description, deleted) VALUES ('1','2025-05-10 12:48:00','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','556d4633494531686447567961574673','4d5441774e5449774d6a55784d6a51344d4442664d44453d','554739306447467a61585674','634739306447467a61585674','3306','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','5332633d','0','NULL','NULL',',,','NULL','NULL','NULL','0','50,50,50','1,1,1','2025-05-10,2025-05-10,2025-05-10','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d,4d4463774e5449774d6a55774e6a51774d4456664d44493d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d','55326c325957746863326b3d,55334a70646d6b3d,554746795958426864485270','NULL','NULL','NULL','4d5445774e5449774d6a55774e5449304d546c664d44493d','','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, raw_material_group_id, semi_finished_group_id, description, deleted) VALUES ('2','2025-05-10 12:49:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','556d4633494531686447567961574673','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','553356735a6e5679','633356735a6e5679','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','20,20,10,10','NULL','NULL','NULL','0','1000,10,1000,100','2,1,2,1','2025-05-10,2025-05-10,2025-05-10,2025-05-10','4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270,554746795958426864485270,554746795958426864485270,554746795958426864485270','NULL','NULL','NULL','4d5445774e5449774d6a55774e5449304d546c664d44493d','','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, raw_material_group_id, semi_finished_group_id, description, deleted) VALUES ('3','2025-05-10 12:52:46','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794e4464664d44493d','5532567461534247615735706332686c5a413d3d','4d5441774e5449774d6a55784d6a55794e445a664d444d3d','54575630595777676332467364484d3d','62575630595777676332467364484d3d','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','0','NULL','NULL',',,','NULL','NULL','NULL','0','5,10,100','1,1,1','2025-05-10,2025-05-10,2025-05-10','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d,4d4463774e5449774d6a55774e6a51774d4456664d44493d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d','55326c325957746863326b3d,55334a70646d6b3d,554746795958426864485270','NULL','NULL','NULL','','4d5445774e5449774d6a55774e6a557a4e445a664d446b3d','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, raw_material_group_id, semi_finished_group_id, description, deleted) VALUES ('4','2025-05-10 12:54:06','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794e4464664d44493d','5532567461534247615735706332686c5a413d3d','4d5441774e5449774d6a55784d6a55304d445a664d44513d','5433526f5a5849675932686c62576c6a5957787a','6233526f5a5849675932686c62576c6a5957787a','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','20,20,10,10','NULL','NULL','NULL','0','800,50,1000,100','2,1,2,1','2025-05-10,2025-05-10,2025-05-10,2025-05-10','4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270,554746795958426864485270,554746795958426864485270,554746795958426864485270','NULL','NULL','NULL','','4d5445774e5449774d6a55774e6a557a4e445a664d44673d','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, raw_material_group_id, semi_finished_group_id, description, deleted) VALUES ('5','2025-05-10 12:58:34','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','4d5441774e5449774d6a55784d6a55344d7a52664d44553d','5457566e595342515a57466a62324e72','6257566e595342775a57466a62324e72','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44493d','55476c6c5932553d','NULL','200','1','2','0','NULL','NULL','NULL','NULL','NULL','NULL','NULL','4d5441774e5449774d6a55784d6a55334d6a46664d444d3d','','','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, raw_material_group_id, semi_finished_group_id, description, deleted) VALUES ('6','2025-05-10 12:58:59','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','4d5441774e5449774d6a55784d6a55344e546c664d44593d','516d466b595342515a57466a62324e72','596d466b595342775a57466a62324e72','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44493d','55476c6c5932553d','NULL','3000','1','1','0','NULL','NULL','NULL','NULL','NULL','NULL','NULL','4d5441774e5449774d6a55784d6a55334d6a46664d444d3d','','','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, raw_material_group_id, semi_finished_group_id, description, deleted) VALUES ('7','2025-05-10 12:59:30','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d544967553268766443424e64577830615342536157526c63673d3d','4d544967633268766443427464577830615342796157526c63673d3d','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','NULL','200','1','2','0','NULL','NULL','NULL','NULL','NULL','NULL','NULL','4d5441774e5449774d6a55784d6a55334d6a46664d44493d','','','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, raw_material_group_id, semi_finished_group_id, description, deleted) VALUES ('8','2025-05-10 13:00:01','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d7a4167553268766443424e6457783061534244623278766458493d','4d7a41676332687664434274645778306153426a623278766458493d','3306','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','NULL','2000','1','1','0','NULL','NULL','NULL','NULL','NULL','NULL','NULL','4d5441774e5449774d6a55784d6a55334d6a46664d44453d','','','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, raw_material_group_id, semi_finished_group_id, description, deleted) VALUES ('9','2025-05-10 17:36:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','4d5441774e5449774d6a55774e544d324d446c664d446b3d','51323973623356794947747664476b3d','59323973623356794947747664476b3d','3604','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','50','95','1','2','0','0','1','2025-05-10','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270','NULL','NULL','4d5441774e5449774d6a55774e544d304e5456664d44633d','','','NULL','0');

INSERT INTO af_product (id, created_date_time, creator, bill_company_id, creator_name, group_id, group_name, product_id, product_name, lower_case_name, hsn_code, unit_id, unit_name, subunit_need, subunit_id, subunit_name, subunit_contains, sales_rate, per, per_type, negative_stock, opening_stock, unit_type, stock_date, location_id, location_name, rate_per_case, rate_per_piece, finished_group_id, raw_material_group_id, semi_finished_group_id, description, deleted) VALUES ('10','2025-05-10 17:39:47','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','NULL','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','4d5441774e5449774d6a55774e544d354e4464664d54413d','524756736458686c','5a4756736458686c','3604','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','28','160','1','2','0','0','1','2025-05-10','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270','NULL','NULL','4d5441774e5449774d6a55774e544d304e5456664d44633d','','','NULL','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('1','2025-05-10 16:42:34','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e4451794d7a52664d44453d','PI001/25-26','2025-05-10','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70494367344f54417a4d44417a4d6a41774b53417449454e6f5a586c356458493d','52584e3359584a704a43516b4e6a41784c4341324d444573494546756157746c6443424364576c735a476c755a7977675179424849464a765957517349453568646e4a68626d647764584a684a43516b5132686c65586c316369516b4a454e6f5a57356e59577877595852306453684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467354d444d774d444d794d44413d','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f6453416f4f4451774e4441774d7a41774d796b674c53424962334a68','5457466f5a584e6f4946427959574a6f64547869636a354962334a6850474a79506b467361576468636d676f52476c7a6443347050474a79506c563064474679494642795957526c63326738596e492b49453176596d6c735a534136494467304d4451774d444d774d444d3d','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','','204, J Shankar Sheth Road, Near Gaiwadi, Girgaon','','','NULL','Tamil Nadu','Tamil Nadu','4d5441774e5449774d6a55784d6a55344e546c664d44593d,4d5441774e5449774d6a55784d6a55344e546c664d44593d','','516d466b595342515a57466a62324e72,516d466b595342515a57466a62324e72','1,2','1,1','10,10','4d4459774e5449774d6a55774e7a41784d446c664d444d3d,4d4459774e5449774d6a55774e7a41784d446c664d44493d','5132467a5a513d3d,55476c6c5932553d','10,100','30,30','1,1','2,2','NULL','300,30','3000.00,3000.00','4d4463774e5449774d6a55774e6a45354d544e664d44493d,4d4463774e5449774d6a55774e6a45354d544e664d44453d','minus,plus','10%,250','','6000','5650.00','0','0','0','0','0','600.00,250','5650.00','0','0');

INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('2','2025-05-10 16:49:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e4451354d446c664d44493d','PI002/25-26','2025-05-10','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b614745674b4467794d7a41774d7a49354d444d70494330675632567a6443424c6232787259585268','5533566b6147456b4a4351794d44517349456f6755326868626d74686369425461475630614342536232466b4c43424f5a57467949456468615864685a476b7349456470636d64686232346b4a4352585a584e3049457476624774686447456b4a43524c62327872595852684b455270633351754b53516b4a46646c63335167516d56755a3246734a43516b49453176596d6c735a534136494467794d7a41774d7a49354d444d3d','NULL','NULL','NULL','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d4463774e5449774d6a55774e6a45344e446c664d44453d','','','','','NULL','Tamil Nadu','West Bengal','4d5441774e5449774d6a55784d6a55354d7a42664d44633d,4d5441774e5449774d6a55774d5441774d4446664d44673d','','4d544967553268766443424e64577830615342536157526c63673d3d,4d7a4167553268766443424e6457783061534244623278766458493d','2,1','1,1','10,30','4d4459774e5449774d6a55774e7a41784d446c664d44453d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','516d3934,5132467a5a513d3d','10,10','20,200','1,1','2,1','NULL','20,200','200.00,2000.00','4d4463774e5449774d6a55774e6a45354d544e664d44493d','minus','5%','','2200','2090.00','0','0','0','0','0','110','2090.00','0','0');

INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('3','2025-05-10 17:41:02','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e5451784d444a664d444d3d','PI003/25-26','2025-05-10','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70494367344f54417a4d44417a4d6a41774b53417449454e6f5a586c356458493d','52584e3359584a704a43516b4e6a41784c4341324d444573494546756157746c6443424364576c735a476c755a7977675179424849464a765957517349453568646e4a68626d647764584a684a43516b5132686c65586c316369516b4a454e6f5a57356e59577877595852306453684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467354d444d774d444d794d44413d','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f6453416f4f4451774e4441774d7a41774d796b674c53424962334a68','5457466f5a584e6f4946427959574a6f64547869636a354962334a6850474a79506b467361576468636d676f52476c7a6443347050474a79506c563064474679494642795957526c63326738596e492b49453176596d6c735a534136494467304d4451774d444d774d444d3d','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','','601, 601, Aniket Building, C G Road, Navrangpura','','','NULL','Tamil Nadu','Tamil Nadu','4d5441774e5449774d6a55774e544d354e4464664d54413d,4d5441774e5449774d6a55774e544d324d446c664d446b3d','','524756736458686c,51323973623356794947747664476b3d','1,1','1,1','28,50','4d4459774e5449774d6a55774e7a41784d446c664d444d3d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d,5132467a5a513d3d','8,5','160,95','1,1','2,2','','4480,4750','35840.00,23750.00','4d4463774e5449774d6a55774e6a45354d544e664d44493d','minus','5%','','59590','56610.50','0','0','0','0','0.50','2979.5','56611','0','0');

INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('4','2025-05-10 18:14:34','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e6a45304d7a52664d44513d','PI004/25-26','2025-05-10','4d5441774e5449774d6a55774e444d774e4456664d44453d','545856756157467959576f674b4467304d7a6b774e444d774d7a49704943306751577868626d523163673d3d','545856756157467959576f6b4a4351354d7a59764d54517459697767553268705a476b67554856795953424659584e304c43425159584a7249464a765957517349457468636d397349454a685a32676b4a435242624746755a4856794a43516b5132686c626d35686153684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467304d7a6b774e444d774d7a493d','4d5441774e5449774d6a55774e4449354e4446664d44453d','55335669614745674b4467304f5451344f544d774d444d704943306751577868626d523163673d3d','5533566961474538596e492b51577868626d5231636a7869636a354461475675626d46704b455270633351754b547869636a3555595731706243424f5957523150474a795069424e62324a70624755674f6941344e446b304f446b7a4d44417a','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','','936/14-b, Shidi Pura East, Park Road, Karol Bagh','','','NULL','Tamil Nadu','Tamil Nadu','4d5441774e5449774d6a55774e544d324d446c664d446b3d','','51323973623356794947747664476b3d','1','1','50','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','10','95','1','2','','4750','47500.00','NULL','NULL','NULL','','47500','47500.00','0','0','0','0','0','0','47500.00','0','0');

INSERT INTO af_proforma_invoice (id, created_date_time, creator, creator_name, bill_company_id, proforma_invoice_id, proforma_invoice_number, proforma_invoice_date, customer_id, customer_name_mobile_city, customer_details, agent_id, agent_name_mobile_city, agent_details, transport_id, bank_id, gst_option, address, tax_option, tax_type, overall_tax, company_state, party_state, product_id, indv_magazine_id, product_name, unit_type, subunit_need, content, unit_id, unit_name, quantity, rate, per, per_type, product_tax, final_rate, amount, other_charges_id, charges_type, other_charges_value, agent_commission, sub_total, grand_total, cgst_value, sgst_value, igst_value, total_tax_value, round_off, other_charges_total, bill_total, cancelled, deleted) VALUES ('5','2025-05-10 19:04:39','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','4d5441774e5449774d6a55774e7a41304d7a6c664d44553d','PI005/25-26','2025-05-10','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70494367344f54417a4d44417a4d6a41774b53417449454e6f5a586c356458493d','52584e3359584a704a43516b4e6a41784c4341324d444573494546756157746c6443424364576c735a476c755a7977675179424849464a765957517349453568646e4a68626d647764584a684a43516b5132686c65586c316369516b4a454e6f5a57356e59577877595852306453684561584e304c696b6b4a435255595731706243424f595752314a43516b49453176596d6c735a534136494467354d444d774d444d794d44413d','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f6453416f4f4451774e4441774d7a41774d796b674c53424962334a68','5457466f5a584e6f4946427959574a6f64547869636a354962334a6850474a79506b467361576468636d676f52476c7a6443347050474a79506c563064474679494642795957526c63326738596e492b49453176596d6c735a534136494467304d4451774d444d774d444d3d','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','4d5441774e5449774d6a55774e444d7a4d446c664d44493d','','','','','NULL','Tamil Nadu','Tamil Nadu','4d5441774e5449774d6a55774e544d354e4464664d54413d','','524756736458686c','1','1','28','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','5','160','1','2','','4480','22400.00','4d4463774e5449774d6a55774e6a45354d544e664d44493d,4d5441774e5449774d6a55774e5451344e5452664d444d3d','minus,plus','5%,2%','','22400','21705.60','0','0','0','0','0.40','1120.00,425.60','21706','0','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_purchase_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, purchase_entry_id, purchase_entry_date, purchase_entry_number, supplier_id, supplier_name_mobile_city, supplier_details, vehicle, company_state, supplier_state, gst_option, tax_type, tax_option, godown_id, godown_name, product_id, product_name, quantity, unit_type, content, total_qty, rate, per, per_type, final_rate, overall_tax, product_amount, sub_total, other_charges_id, charges_type, other_charges_value, other_charges_total, cgst_value, sgst_value, igst_value, total_tax_value, product_tax, round_off, total_amount, stockupdate, received_slip_id, unit_id, unit_name, rate_per_unit, cancelled, deleted, location_id, location_name, location_type, product_group) VALUES ('1','2025-05-10 13:01:29','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','','4d5441774e5449774d6a55774d5441784d6a6c664d44453d','2025-05-10','001','4d5441774e5449774d6a55784d6a51304d5452664d44493d','5533567961586c68494367344f5451354e4441774d546b774b53417449454673595842776458706f5953426c59584e30','5533567961586c684a43516b4e794255614342476248497349454a6f59585a6c633268335958496751584a6a5957526c4c43424d5969425449453168636d636b4a4352426247467763485636614745675a57467a6443516b4a454673595842776458706f5953684561584e304c696b6b4a43524c5a584a686247456b4a435167545739696157786c49446f674f446b304f5451774d4445354d413d3d','TN95K2002','Tamil Nadu','Tamil Nadu','1','2','1','','','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d544967553268766443424e64577830615342536157526c63673d3d','1','1','10','10','4000','1','1','4000','12%','4000','4000','4d4463774e5449774d6a55774e6a45354d544e664d44493d,4d4463774e5449774d6a55774e6a45354d544e664d44453d','plus,minus','10%,300','400.00,300','246.00','246.00','0','492.00','','0','4592','1','NULL','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','4000','1','0','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270','1','4d5449774e4449774d6a55784d4455794d7a4e664d44453d');

INSERT INTO af_purchase_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, purchase_entry_id, purchase_entry_date, purchase_entry_number, supplier_id, supplier_name_mobile_city, supplier_details, vehicle, company_state, supplier_state, gst_option, tax_type, tax_option, godown_id, godown_name, product_id, product_name, quantity, unit_type, content, total_qty, rate, per, per_type, final_rate, overall_tax, product_amount, sub_total, other_charges_id, charges_type, other_charges_value, other_charges_total, cgst_value, sgst_value, igst_value, total_tax_value, product_tax, round_off, total_amount, stockupdate, received_slip_id, unit_id, unit_name, rate_per_unit, cancelled, deleted, location_id, location_name, location_type, product_group) VALUES ('2','2025-05-10 13:03:35','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','','4d5441774e5449774d6a55774d54417a4d7a56664d44493d','2025-05-10','002','4d5441774e5449774d6a55784d6a51304d5452664d44493d','5533567961586c68494367344f5451354e4441774d546b774b53417449454673595842776458706f5953426c59584e30','5533567961586c684a43516b4e794255614342476248497349454a6f59585a6c633268335958496751584a6a5957526c4c43424d5969425449453168636d636b4a4352426247467763485636614745675a57467a6443516b4a454673595842776458706f5953684561584e304c696b6b4a43524c5a584a686247456b4a435167545739696157786c49446f674f446b304f5451774d4445354d413d3d','TN95K2002','Tamil Nadu','Kerala','1','2','1','','','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d544967553268766443424e64577830615342536157526c63673d3d','10','1','10','100','200','1','1','200','18%','2000','2000','4d4463774e5449774d6a55774e6a45354d544e664d44493d,4d4463774e5449774d6a55774e6a45354d544e664d44453d','plus,minus','10%,5%','200.00,110.00','0','0','376.20','376.20','','-0.20','2466','1','NULL','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','200','0','0','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270','1','4d5449774e4449774d6a55784d4455794d7a4e664d44453d');

INSERT INTO af_purchase_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, purchase_entry_id, purchase_entry_date, purchase_entry_number, supplier_id, supplier_name_mobile_city, supplier_details, vehicle, company_state, supplier_state, gst_option, tax_type, tax_option, godown_id, godown_name, product_id, product_name, quantity, unit_type, content, total_qty, rate, per, per_type, final_rate, overall_tax, product_amount, sub_total, other_charges_id, charges_type, other_charges_value, other_charges_total, cgst_value, sgst_value, igst_value, total_tax_value, product_tax, round_off, total_amount, stockupdate, received_slip_id, unit_id, unit_name, rate_per_unit, cancelled, deleted, location_id, location_name, location_type, product_group) VALUES ('3','2025-05-10 13:05:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','','4d5441774e5449774d6a55774d5441314d7a4a664d444d3d','2025-05-10','003','4d5441774e5449774d6a55784d6a517a4d544a664d44453d','55326868626d31315a324674494367344e6a45774d4459784f4451304b534174494564316157356b65513d3d','55326868626d31315a3246744a43516b4d5377675447463462576b675357356b6243424663335268644755734945356c6479424d6157357249464a7659575173494546755a47686c636d6b6b4a43524864576c755a486b6b4a43524461475675626d46704b455270633351754b53516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f674f4459784d4441324d5467304e413d3d','','Tamil Nadu','Tamil Nadu','','','','','','4d5441774e5449774d6a55774d5441774d4446664d44673d,4d5441774e5449774d6a55784d6a55344e546c664d44593d','4d7a4167553268766443424e6457783061534244623278766458493d,516d466b595342515a57466a62324e72','10,3000','1,2','30,10','300,3000','300,20','1,1','1,1','300,2','NULL','3000,6000','9000','NULL','NULL','NULL','NULL','0','0','0','0',',','0','9000.00','1','NULL','4d4459774e5449774d6a55774e7a41784d446c664d444d3d,4d4459774e5449774d6a55774e7a41784d446c664d44493d','5132467a5a513d3d,55476c6c5932553d','300,2','0','0','4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4463774e5449774d6a55774e6a51774d4456664d44493d','554746795958426864485270,55334a70646d6b3d','2','4d5449774e4449774d6a55784d4455794d7a4e664d44453d');

INSERT INTO af_purchase_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, purchase_entry_id, purchase_entry_date, purchase_entry_number, supplier_id, supplier_name_mobile_city, supplier_details, vehicle, company_state, supplier_state, gst_option, tax_type, tax_option, godown_id, godown_name, product_id, product_name, quantity, unit_type, content, total_qty, rate, per, per_type, final_rate, overall_tax, product_amount, sub_total, other_charges_id, charges_type, other_charges_value, other_charges_total, cgst_value, sgst_value, igst_value, total_tax_value, product_tax, round_off, total_amount, stockupdate, received_slip_id, unit_id, unit_name, rate_per_unit, cancelled, deleted, location_id, location_name, location_type, product_group) VALUES ('4','2025-05-10 15:10:49','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','','4d5441774e5449774d6a55774d7a45774e446c664d44513d','2025-05-10','004','4d5441774e5449774d6a55784d6a51304d5452664d44493d','5533567961586c68494367344f5451354e4441774d546b774b53417449454673595842776458706f5953426c59584e30','5533567961586c684a43516b4e794255614342476248497349454a6f59585a6c633268335958496751584a6a5957526c4c43424d5969425449453168636d636b4a4352426247467763485636614745675a57467a6443516b4a454673595842776458706f5953684561584e304c696b6b4a43524c5a584a686247456b4a435167545739696157786c49446f674f446b304f5451774d4445354d413d3d','','Tamil Nadu','Tamil Nadu','','','','','','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','553356735a6e5679','1','1','1','1','1','1','1','1','NULL','1','1','4d4463774e5449774d6a55774e6a45354d544e664d44493d','plus','10%','0.10','0','0','0','0','','-0.10','1','1','NULL','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','0','0','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270','1','4d5449774e4449774d6a55784d44557a4d444a664d444d3d');

INSERT INTO af_purchase_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, purchase_entry_id, purchase_entry_date, purchase_entry_number, supplier_id, supplier_name_mobile_city, supplier_details, vehicle, company_state, supplier_state, gst_option, tax_type, tax_option, godown_id, godown_name, product_id, product_name, quantity, unit_type, content, total_qty, rate, per, per_type, final_rate, overall_tax, product_amount, sub_total, other_charges_id, charges_type, other_charges_value, other_charges_total, cgst_value, sgst_value, igst_value, total_tax_value, product_tax, round_off, total_amount, stockupdate, received_slip_id, unit_id, unit_name, rate_per_unit, cancelled, deleted, location_id, location_name, location_type, product_group) VALUES ('5','2025-05-10 16:56:47','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','','4d5441774e5449774d6a55774e4455324e4468664d44553d','2025-05-10','005','4d5441774e5449774d6a55784d6a517a4d544a664d44453d','55326868626d31315a324674494367344e6a45774d4459784f4451304b534174494564316157356b65513d3d','55326868626d31315a3246744a43516b4d5377675447463462576b675357356b6243424663335268644755734945356c6479424d6157357249464a7659575173494546755a47686c636d6b6b4a43524864576c755a486b6b4a43524461475675626d46704b455270633351754b53516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f674f4459784d4441324d5467304e413d3d','','Tamil Nadu','Tamil Nadu','','','','','','4d5441774e5449774d6a55784d6a55344e546c664d44593d','516d466b595342515a57466a62324e72','10','1','30','300','100','1','1','100','NULL','1000','1000','NULL','NULL','NULL','NULL','0','0','0','0','','0','1000.00','1','NULL','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','100','0','0','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270','1','4d5449774e4449774d6a55784d4455794d7a4e664d44453d');

INSERT INTO af_purchase_entry (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, purchase_entry_id, purchase_entry_date, purchase_entry_number, supplier_id, supplier_name_mobile_city, supplier_details, vehicle, company_state, supplier_state, gst_option, tax_type, tax_option, godown_id, godown_name, product_id, product_name, quantity, unit_type, content, total_qty, rate, per, per_type, final_rate, overall_tax, product_amount, sub_total, other_charges_id, charges_type, other_charges_value, other_charges_total, cgst_value, sgst_value, igst_value, total_tax_value, product_tax, round_off, total_amount, stockupdate, received_slip_id, unit_id, unit_name, rate_per_unit, cancelled, deleted, location_id, location_name, location_type, product_group) VALUES ('6','2025-05-10 17:09:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','','4d5441774e5449774d6a55774e5441354d544e664d44593d','2025-05-10','007','4d5441774e5449774d6a55784d6a51304d5452664d44493d','5533567961586c68494367344f5451354e4441774d546b774b53417449454673595842776458706f5953426c59584e30','5533567961586c684a43516b4e794255614342476248497349454a6f59585a6c633268335958496751584a6a5957526c4c43424d5969425449453168636d636b4a4352426247467763485636614745675a57467a6443516b4a454673595842776458706f5953684561584e304c696b6b4a43524c5a584a686247456b4a435167545739696157786c49446f674f446b304f5451774d4445354d413d3d','','Tamil Nadu','Kerala','','','','','','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d7a4167553268766443424e6457783061534244623278766458493d','10','1','30','300','100','1','1','100','NULL','1000','1000','NULL','NULL','NULL','NULL','0','0','0','0','','0','1000.00','1','NULL','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','100','0','0','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270','1','4d5449774e4449774d6a55784d4455794d7a4e664d44453d');


CREATE TABLE `af_raw_material_group` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `raw_material_group_id` mediumtext NOT NULL,
  `raw_material_group_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_raw_material_group (id, created_date_time, creator, creator_name, raw_material_group_id, raw_material_group_name, lower_case_name, deleted) VALUES ('1','2025-05-11 17:24:19','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5445774e5449774d6a55774e5449304d546c664d44453d','5433526f5a584a7a','6233526f5a584a7a','0');

INSERT INTO af_raw_material_group (id, created_date_time, creator, creator_name, raw_material_group_id, raw_material_group_name, lower_case_name, deleted) VALUES ('2','2025-05-11 17:24:19','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5445774e5449774d6a55774e5449304d546c664d44493d','5132686c62576c6a5957773d','5932686c62576c6a5957773d','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_receipt (id, created_date_time, creator, creator_name, receipt_id, receipt_number, receipt_date, party_id, party_name, name_mobile_city, amount, narration, payment_mode_id, payment_mode_name, bank_id, bank_name, total_amount, deleted) VALUES ('1','2025-05-10 17:51:28','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e5455784d6a68664d44453d','RC001/25-26','2025-05-10','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','5457466f5a584e6f4946427959574a6f6453416f4f4451774e4441774d7a41774d796b674c53424962334a68','3000,18000','634746705a413d3d','4d4463774e5449774d6a55774e6a45344d6a64664d44493d,4d4463774e5449774d6a55774e6a45344d6a64664d44453d','55476876626d56775a513d3d,5132467a61413d3d','4d4463774e5449774d6a55774e6a45344e446c664d44453d,','55304a4a,','21000','0');


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


CREATE TABLE `af_semi_finished_group` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `semi_finished_group_id` mediumtext NOT NULL,
  `semi_finished_group_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_semi_finished_group (id, created_date_time, creator, creator_name, semi_finished_group_id, semi_finished_group_name, lower_case_name, deleted) VALUES ('8','2025-05-11 18:53:46','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5445774e5449774d6a55774e6a557a4e445a664d44673d','513268686132746863694243623352306232303d','593268686132746863694269623352306232303d','0');

INSERT INTO af_semi_finished_group (id, created_date_time, creator, creator_name, semi_finished_group_id, semi_finished_group_name, lower_case_name, deleted) VALUES ('9','2025-05-11 18:53:46','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5445774e5449774d6a55774e6a557a4e445a664d446b3d','556d396a6132563049454e76626d553d','636d396a6132563049474e76626d553d','0');


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


INSERT INTO af_semifinished_inward (id, created_date_time, creator, creator_name, bill_company_id, company_details, semifinished_inward_id, semifinished_inward_number, entry_date, factory_id, factory_name_location, factory_details, godown_id, godown_name_location, godown_details, contractor_id, contractor_name_mobile_city, contractor_details, product_id, product_name, unit_id, unit_name, quantity, subunit_contains, cooly_per_qty, cooly_rate, overall_cooly_total, total_quantity, cancelled, deleted) VALUES ('1','2025-05-10 15:35:24','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','4d5441774e5449774d6a55774d7a4d314d6a52664d44453d','SMI001/25-26','2025-05-10','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270494330675532463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270494330675532463064485679','5547467959584268644852704a43516b55324630644856794a43516b5357356a614746795a3255674c534242636e5673494367344e6a45774d44637a4e6a63334b513d3d','','','','4d5441774e5449774d6a55784d6a55304d445a664d44513d,4d5441774e5449774d6a55784d6a55304d445a664d44513d','5433526f5a5849675932686c62576c6a5957787a,5433526f5a5849675932686c62576c6a5957787a','4d4459774e5449774d6a55774e7a41784d446c664d44453d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','516d3934,5132467a5a513d3d','20,10','20,20','','','','30','1','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('1','2025-05-10 12:48:00','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51344d4442664d44453d','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','NULL','50','NULL','0','NULL','Opening Stock','4d5441774e5449774d6a55784d6a51344d4442664d44453d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('2','2025-05-10 12:48:00','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51344d4442664d44453d','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','NULL','50','NULL','0','NULL','Opening Stock','4d5441774e5449774d6a55784d6a51344d4442664d44453d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('3','2025-05-10 12:48:00','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51344d4442664d44453d','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','NULL','50','NULL','0','NULL','Opening Stock','4d5441774e5449774d6a55784d6a51344d4442664d44453d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('4','2025-05-10 12:49:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','20','50.00','1000','0','0','Opening Stock','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('5','2025-05-10 12:49:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','20','10','200.00','0','0','Opening Stock','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('6','2025-05-10 12:49:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','100.00','1000','0','0','Opening Stock','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('7','2025-05-10 12:49:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','100','1000.00','0','0','Opening Stock','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('8','2025-05-10 12:52:46','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55794e445a664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','5','NULL','0','NULL','Opening Stock','4d5441774e5449774d6a55784d6a55794e445a664d444d3d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('9','2025-05-10 12:52:46','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55794e445a664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','10','NULL','0','NULL','Opening Stock','4d5441774e5449774d6a55784d6a55794e445a664d444d3d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('10','2025-05-10 12:52:46','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55794e445a664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','100','NULL','0','NULL','Opening Stock','4d5441774e5449774d6a55784d6a55794e445a664d444d3d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('11','2025-05-10 12:54:06','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55304d445a664d44513d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','20','40.00','800','0','0','Opening Stock','4d5441774e5449774d6a55784d6a55304d445a664d44513d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('12','2025-05-10 12:54:06','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55304d445a664d44513d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','20','50','1000.00','0','0','Opening Stock','4d5441774e5449774d6a55784d6a55304d445a664d44513d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('13','2025-05-10 12:54:06','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55304d445a664d44513d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','100.00','1000','0','0','Opening Stock','4d5441774e5449774d6a55784d6a55304d445a664d44513d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('14','2025-05-10 12:54:06','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55304d445a664d44513d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','100','1000.00','0','0','Opening Stock','4d5441774e5449774d6a55784d6a55304d445a664d44513d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('15','2025-05-10 13:01:29','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','4d5441774e5449774d6a55784d6a51304d5452664d44493d','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','1','10.00','0','0','Purchase Entry','4d5441774e5449774d6a55774d5441784d6a6c664d44453d','NULL','4d444178','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('16','2025-05-10 13:02:27','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','4d5441774e5449774d6a55784d6a51304d5452664d44493d','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','1','10.00','0','0','Purchase Entry','4d5441774e5449774d6a55774d5441784d6a6c664d44453d','NULL','4d444178','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('17','2025-05-10 13:03:35','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','4d5441774e5449774d6a55784d6a51304d5452664d44493d','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','10','100.00','0','0','Purchase Entry','4d5441774e5449774d6a55774d54417a4d7a56664d44493d','NULL','4d444179','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('18','2025-05-10 13:05:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','4d5441774e5449774d6a55784d6a517a4d544a664d44453d','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','30','10','300.00','0','0','Purchase Entry','4d5441774e5449774d6a55774d5441314d7a4a664d444d3d','NULL','4d44417a','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('19','2025-05-10 13:05:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','4d5441774e5449774d6a55784d6a517a4d544a664d44453d','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55344e546c664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d44493d','10','300.00','3000','0','0','Purchase Entry','4d5441774e5449774d6a55774d5441314d7a4a664d444d3d','NULL','4d44417a','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('20','2025-05-10 13:08:56','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','20','0','0','0.50','10','Consumption Entry','4d5441774e5449774d6a55774d5441344e5464664d44453d','CON001/25-26','5130394f4d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('21','2025-05-10 13:08:56','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51344d4442664d44453d','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','NULL','0','NULL','1','NULL','Consumption Entry','4d5441774e5449774d6a55774d5441344e5464664d44453d','CON001/25-26','5130394f4d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('22','2025-05-10 13:31:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','10.00','100','0','0','Daily Production','4d5441774e5449774d6a55774d544d784d6a4a664d44453d','DAP001/25-26','524546514d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('23','2025-05-10 13:31:22','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','30','3','90.00','0','0','Daily Production','4d5441774e5449774d6a55774d544d784d6a4a664d44453d','DAP001/25-26','524546514d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('24','2025-05-10 13:38:02','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','20','0','0','0.50','10','Consumption Entry','4d5441774e5449774d6a55774d544d344d444a664d44493d','CON002/25-26','5130394f4d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('25','2025-05-10 13:38:02','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','0','0','10','100.00','Consumption Entry','4d5441774e5449774d6a55774d544d344d444a664d44493d','CON002/25-26','5130394f4d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('26','2025-05-10 15:03:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','50.00','500','0','0','Stock Adjustment','4d5441774e5449774d6a55774d7a417a4d7a4a664d44453d','STA001/25-26','553152424d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('27','2025-05-10 15:03:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','30','10','300.00','0','0','Stock Adjustment','4d5441774e5449774d6a55774d7a417a4d7a4a664d44453d','STA001/25-26','553152424d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('28','2025-05-10 15:10:49','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','4d5441774e5449774d6a55784d6a51304d5452664d44493d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','1','1','1.00','0','0','Purchase Entry','4d5441774e5449774d6a55774d7a45774e446c664d44513d','NULL','4d444130','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('29','2025-05-10 15:30:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','0','0','1','10.00','Stock Adjustment','4d5441774e5449774d6a55774d7a417a4d7a4a664d44453d','STA001/25-26','553152424d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('30','2025-05-10 15:35:24','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55304d445a664d44513d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','20','1.00','20','0','0','Semifinished Inward','4d5441774e5449774d6a55774d7a4d314d6a52664d44453d','SMI001/25-26','5530314a4d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('31','2025-05-10 15:35:24','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55304d445a664d44513d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','20','10','200.00','0','0','Semifinished Inward','4d5441774e5449774d6a55774d7a4d314d6a52664d44453d','SMI001/25-26','5530314a4d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('32','2025-05-10 15:42:17','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','1','10.00','0','0','Stock Adjustment','4d5441774e5449774d6a55774d7a51794d5468664d44493d','STA002/25-26','553152424d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('33','2025-05-10 15:42:17','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','30','3.33','100','0','0','Stock Adjustment','4d5441774e5449774d6a55774d7a51794d5468664d44493d','STA002/25-26','553152424d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('34','2025-05-10 15:47:03','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','20','0','0','1','20.00','Stock Adjustment','4d5441774e5449774d6a55774d7a51334d444e664d444d3d','STA003/25-26','553152424d44417a4c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('35','2025-05-10 15:47:39','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','20','0','0','5.00','100','Stock Adjustment','4d5441774e5449774d6a55774d7a51334d444e664d444d3d','STA003/25-26','553152424d44417a4c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('36','2025-05-10 15:48:07','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','0','0','1','10.00','Stock Adjustment','4d5441774e5449774d6a55774d7a51344d4464664d44513d','STA004/25-26','553152424d4441304c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('37','2025-05-10 16:00:35','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51344d4442664d44453d','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','NULL','0','NULL','10','NULL','Material Transfer','4d5441774e5449774d6a55774e4441774d7a5a664d44453d','MAT001/25-26','545546554d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('38','2025-05-10 16:00:35','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51344d4442664d44453d','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','NULL','10','NULL','0','NULL','Material Transfer','4d5441774e5449774d6a55774e4441774d7a5a664d44453d','MAT001/25-26','545546554d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('39','2025-05-10 16:01:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','0','0','10.00','100','Material Transfer','4d5441774e5449774d6a55774e4441774d7a5a664d44453d','MAT001/25-26','545546554d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('40','2025-05-10 16:01:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','NULL','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','10.00','100','0','0','Material Transfer','4d5441774e5449774d6a55774e4441774d7a5a664d44453d','MAT001/25-26','545546554d4441784c7a49314c544932','1');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('41','2025-05-10 16:14:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','30','0','0','1','30.00','Material Transfer','4d5441774e5449774d6a55774e4445304d7a4a664d44493d','MAT002/25-26','545546554d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('42','2025-05-10 16:14:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','30','1','30.00','0','0','Material Transfer','4d5441774e5449774d6a55774e4445304d7a4a664d44493d','MAT002/25-26','545546554d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('43','2025-05-10 16:14:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','30','0','0','3.33','100','Material Transfer','4d5441774e5449774d6a55774e4445304d7a4a664d44493d','MAT002/25-26','545546554d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('44','2025-05-10 16:14:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','30','3.33','100','0','0','Material Transfer','4d5441774e5449774d6a55774e4445304d7a4a664d44493d','MAT002/25-26','545546554d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('45','2025-05-10 16:53:27','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','0','0','0.50','5','Delivery Slip','4d5441774e5449774d6a55774e44557a4d6a64664d44453d','NULL','52464d774d4445764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('46','2025-05-10 16:54:19','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','0','0','0.50','5','Delivery Slip','4d5441774e5449774d6a55774e4455304d546c664d44493d','NULL','52464d774d4449764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('47','2025-05-10 16:54:19','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','30','0','0','5','150.00','Delivery Slip','4d5441774e5449774d6a55774e4455304d546c664d44493d','NULL','52464d774d4449764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('48','2025-05-10 16:56:47','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','4d5441774e5449774d6a55784d6a517a4d544a664d44453d','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55344e546c664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','30','10','300.00','0','0','Purchase Entry','4d5441774e5449774d6a55774e4455324e4468664d44553d','NULL','4d444131','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('49','2025-05-10 17:09:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','4d5441774e5449774d6a55784d6a51304d5452664d44493d','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','30','10','300.00','0','0','Purchase Entry','4d5441774e5449774d6a55774e5441354d544e664d44593d','NULL','4d444133','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('50','2025-05-10 17:09:18','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','30','0','0','5','150.00','Delivery Slip','4d5441774e5449774d6a55774e5441354d546c664d444d3d','NULL','52464d774d444d764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('51','2025-05-10 17:34:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','6','60.00','0','0','Daily Production','4d5441774e5449774d6a55774e544d304d4456664d44493d','DAP002/25-26','524546514d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('52','2025-05-10 17:34:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','30','12','360.00','0','0','Daily Production','4d5441774e5449774d6a55774e544d304d4456664d44493d','DAP002/25-26','524546514d4441794c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('53','2025-05-10 17:36:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774e544d324d446c664d446b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','50','0','0.00','0','0','Opening Stock','4d5441774e5449774d6a55774e544d324d446c664d446b3d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('54','2025-05-10 17:36:30','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774e544d324d446c664d446b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','50','7','350.00','0','0','Daily Production','4d5441774e5449774d6a55774e544d324d7a46664d444d3d','DAP003/25-26','524546514d44417a4c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('55','2025-05-10 17:39:47','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774e544d354e4464664d54413d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','28','0','0.00','0','0','Opening Stock','4d5441774e5449774d6a55774e544d354e4464664d54413d','NULL','5433426c626d6c755a7942546447396a61773d3d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('56','2025-05-10 17:46:33','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774e544d324d446c664d446b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','50','0','0','5','250.00','Delivery Slip','4d5441774e5449774d6a55774e5451324d7a4e664d44513d','NULL','52464d774d4451764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('57','2025-05-10 18:14:52','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774e544d324d446c664d446b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','50','0','0','2','100.00','Delivery Slip','4d5441774e5449774d6a55774e6a45304e544a664d44553d','NULL','52464d774d4455764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('58','2025-05-10 19:30:21','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55344e546c664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d44493d','10','0','0','10.00','100','Delivery Slip','4d5441774e5449774d6a55774e7a4d774d6a4a664d44593d','NULL','52464d774d4459764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('59','2025-05-10 19:30:21','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-10','NULL','NULL','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55344e546c664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','10','0','0','10','100.00','Delivery Slip','4d5441774e5449774d6a55774e7a4d774d6a4a664d44593d','NULL','52464d774d4459764d6a55744d6a593d','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('60','2025-05-12 11:26:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-12','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774e544d354e4464664d54413d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','28','10','280.00','0','0','Daily Production','4d5449774e5449774d6a55784d5449324d5452664d44513d','DAP004/25-26','524546514d4441304c7a49314c544932','0');

INSERT INTO af_stock (id, created_date_time, creator, creator_name, stock_date, party_id, godown_id, magazine_id, group_id, product_id, unit_id, case_contains, inward_unit, inward_subunit, outward_unit, outward_subunit, stock_type, bill_unique_id, bill_unique_number, remarks, deleted) VALUES ('61','2025-05-12 11:26:13','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','2025-05-12','NULL','NULL','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774e544d324d446c664d446b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','50','10','500.00','0','0','Daily Production','4d5449774e5449774d6a55784d5449324d5452664d44513d','DAP004/25-26','524546514d4441304c7a49314c544932','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_stock_adjustment (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, stock_adjustment_id, stock_adjustment_number, entry_date, location_type, product_group, group_name, location_id, location_name, content, group_id, product_id, product_name, unit_type, unit_id, unit_name, quantity, stock_action, remarks, total_quantity, cancelled, deleted) VALUES ('1','2025-05-10 15:03:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','4d5441774e5449774d6a55774d7a417a4d7a4a664d44453d','STA001/25-26','2025-05-10','1','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d,526d6c7561584e6f5a57513d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270,554746795958426864485270','10,10','4d5449774e4449774d6a55784d4455794d7a4e664d44453d,4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d,4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d544967553268766443424e64577830615342536157526c63673d3d,4d544967553268766443424e64577830615342536157526c63673d3d','1,2','4d4459774e5449774d6a55774e7a41784d446c664d444d3d,4d4459774e5449774d6a55774e7a41784d446c664d44453d','5132467a5a513d3d,516d3934','1,500','2,1','5647567a64413d3d','501','1','0');

INSERT INTO af_stock_adjustment (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, stock_adjustment_id, stock_adjustment_number, entry_date, location_type, product_group, group_name, location_id, location_name, content, group_id, product_id, product_name, unit_type, unit_id, unit_name, quantity, stock_action, remarks, total_quantity, cancelled, deleted) VALUES ('2','2025-05-10 15:42:17','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','4d5441774e5449774d6a55774d7a51794d5468664d44493d','STA002/25-26','2025-05-10','2','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d,526d6c7561584e6f5a57513d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270,554746795958426864485270','10,30','4d5449774e4449774d6a55784d4455794d7a4e664d44453d,4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d,4d5441774e5449774d6a55774d5441774d4446664d44673d','4d544967553268766443424e64577830615342536157526c63673d3d,4d7a4167553268766443424e6457783061534244623278766458493d','1,2','4d4459774e5449774d6a55774e7a41784d446c664d444d3d,4d4459774e5449774d6a55774e7a41784d446c664d44453d','5132467a5a513d3d,516d3934','1,100','1,1','5647567a64413d3d','101','0','0');

INSERT INTO af_stock_adjustment (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, stock_adjustment_id, stock_adjustment_number, entry_date, location_type, product_group, group_name, location_id, location_name, content, group_id, product_id, product_name, unit_type, unit_id, unit_name, quantity, stock_action, remarks, total_quantity, cancelled, deleted) VALUES ('3','2025-05-10 15:47:03','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','4d5441774e5449774d6a55774d7a51334d444e664d444d3d','STA003/25-26','2025-05-10','1','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','556d4633494531686447567961574673,556d4633494531686447567961574673','4d4467774e5449774d6a55774d6a51314d446c664d444d3d,4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270,554746795958426864485270','20,20','4d5449774e4449774d6a55784d44557a4d444a664d444d3d,4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d,4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','553356735a6e5679,553356735a6e5679','2,1','4d4459774e5449774d6a55774e7a41784d446c664d44453d,4d4459774e5449774d6a55774e7a41784d446c664d444d3d','516d3934,5132467a5a513d3d','100,1','2,2','5647567a64413d3d','101','0','0');

INSERT INTO af_stock_adjustment (id, created_date_time, creator, creator_name, bill_company_id, bill_company_details, stock_adjustment_id, stock_adjustment_number, entry_date, location_type, product_group, group_name, location_id, location_name, content, group_id, product_id, product_name, unit_type, unit_id, unit_name, quantity, stock_action, remarks, total_quantity, cancelled, deleted) VALUES ('4','2025-05-10 15:48:07','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','NULL','5157356e595778685a584e3359584a7049455a70636d563362334a726379516b4a4449764e54557a4c565573494449764e54557a4c56597349464e70646d467259584e704945316861573467556d39685a43516b4a464e686448523163694174494459794e6a49774d79516b4a465a70636e566b61485675595764686369516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f354d446b774f5441354d446b774a43516b494564545643424a546941364d6a4a4251554642515441774d4442424d566f31','4d5441774e5449774d6a55774d7a51344d4464664d44513d','STA004/25-26','2025-05-10','1','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','526d6c7561584e6f5a57513d','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','554746795958426864485270','10','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d544967553268766443424e64577830615342536157526c63673d3d','1','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','1','2','64413d3d','1','0','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('1','2025-05-10 12:48:00','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51344d4442664d44453d','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','NULL','NULL','50.00','NULL','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('2','2025-05-10 12:48:00','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51344d4442664d44453d','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','NULL','NULL','50.00','NULL','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('3','2025-05-10 12:48:00','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51344d4442664d44453d','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','NULL','NULL','50.00','NULL','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('4','2025-05-10 12:49:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','20','53.50','1070.00','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('5','2025-05-10 12:49:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','190.00','1900.00','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('6','2025-05-10 12:52:46','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55794e445a664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','NULL','5.00','NULL','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('7','2025-05-10 12:52:46','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55794e445a664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','NULL','10.00','NULL','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('8','2025-05-10 12:52:46','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55794e445a664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','NULL','NULL','100.00','NULL','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('9','2025-05-10 12:54:06','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55304d445a664d44513d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','20','90.00','1800.00','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('10','2025-05-10 12:54:06','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794e4464664d44493d','4d5441774e5449774d6a55784d6a55304d445a664d44513d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','200.00','2000.00','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('11','2025-05-10 15:10:49','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','1','1.00','1.00','0');

INSERT INTO af_stock_by_godown (id, created_date_time, creator, creator_name, godown_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('12','2025-05-10 16:01:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d44557a4d444a664d444d3d','4d5441774e5449774d6a55784d6a51354d7a4a664d44493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','0','0','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('1','2025-05-10 13:01:29','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','1.00','10.00','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('2','2025-05-10 13:02:27','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','10','15.00','150.00','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('3','2025-05-10 13:05:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','30','21.00','630.00','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('4','2025-05-10 13:05:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55344e546c664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44493d','10','280.00','2800.00','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('5','2025-05-10 16:14:32','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4463774e5449774d6a55774e6a51774d4456664d44493d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','30','4.33','129.90','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('6','2025-05-10 16:56:47','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55784d6a55344e546c664d44593d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44493d','30','10.00','300.00','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('7','2025-05-10 17:36:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774e544d324d446c664d446b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','50','10.00','500.00','0');

INSERT INTO af_stock_by_magazine (id, created_date_time, creator, creator_name, magazine_id, group_id, product_id, unit_id, subunit_id, case_contains, current_stock_unit, current_stock_subunit, deleted) VALUES ('8','2025-05-10 17:39:47','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','4d5449774e4449774d6a55784d4455794d7a4e664d44453d','4d5441774e5449774d6a55774e544d354e4464664d54413d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','28','10.00','280.00','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('1','2025-05-10 16:42:34','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e4451794d7a52664d44453d','PI001/25-26','2025-05-10','Proforma Invoice','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','4d5441774e5449774d6a55784d6a55344e546c664d44593d','516d466b595342515a57466a62324e72','4d4459774e5449774d6a55774e7a41784d446c664d44493d','55476c6c5932553d','10','NULL','100','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('2','2025-05-10 16:42:34','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e4451794d7a52664d44453d','PI001/25-26','2025-05-10','Proforma Invoice','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b6147453d','NULL','','4d5441774e5449774d6a55784d6a55344e546c664d44593d','516d466b595342515a57466a62324e72','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','10','10','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('3','2025-05-10 16:49:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e4451354d446c664d44493d','PI002/25-26','2025-05-10','Proforma Invoice','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b6147453d','NULL','','4d5441774e5449774d6a55784d6a55344e546c664d44593d','516d466b595342515a57466a62324e72','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','10','1','NULL','NULL','NULL','1');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('4','2025-05-10 16:49:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e4451354d446c664d44493d','PI002/25-26','2025-05-10','Proforma Invoice','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b6147453d','NULL','','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d544967553268766443424e64577830615342536157526c63673d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','10','NULL','10','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('5','2025-05-10 16:49:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e4451354d446c664d44493d','PI002/25-26','2025-05-10','Proforma Invoice','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b6147453d','NULL','','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d7a4167553268766443424e6457783061534244623278766458493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','30','10','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('6','2025-05-10 16:53:27','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e44557a4d6a64664d44453d','DS001/25-26','2025-05-10','Delivery Slip','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b6147453d','NULL','','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d544967553268766443424e64577830615342536157526c63673d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','10','NULL','NULL','NULL','5','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('7','2025-05-10 16:54:19','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e4455304d546c664d44493d','DS002/25-26','2025-05-10','Delivery Slip','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b6147453d','NULL','','4d5441774e5449774d6a55784d6a55354d7a42664d44633d','4d544967553268766443424e64577830615342536157526c63673d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','10','NULL','NULL','NULL','5','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('8','2025-05-10 16:54:19','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e4455304d546c664d44493d','DS002/25-26','2025-05-10','Delivery Slip','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b6147453d','NULL','','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d7a4167553268766443424e6457783061534244623278766458493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','30','NULL','NULL','5','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('9','2025-05-10 17:09:18','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e5441354d546c664d444d3d','DS003/25-26','2025-05-10','Delivery Slip','4d5441774e5449774d6a55774e444d794e4452664d44593d','5533566b6147453d','NULL','','4d5441774e5449774d6a55774d5441774d4446664d44673d','4d7a4167553268766443424e6457783061534244623278766458493d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','30','NULL','NULL','5','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('10','2025-05-10 17:41:02','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e5451784d444a664d444d3d','PI003/25-26','2025-05-10','Proforma Invoice','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','4d5441774e5449774d6a55774e544d354e4464664d54413d','524756736458686c','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','28','8','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('11','2025-05-10 17:41:02','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e5451784d444a664d444d3d','PI003/25-26','2025-05-10','Proforma Invoice','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','4d5441774e5449774d6a55774e544d324d446c664d446b3d','51323973623356794947747664476b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','50','5','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('12','2025-05-10 17:46:33','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e5451324d7a4e664d44513d','DS004/25-26','2025-05-10','Delivery Slip','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','4d5441774e5449774d6a55774e544d324d446c664d446b3d','51323973623356794947747664476b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','50','NULL','NULL','5','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('13','2025-05-10 18:14:34','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e6a45304d7a52664d44513d','PI004/25-26','2025-05-10','Proforma Invoice','4d5441774e5449774d6a55774e444d774e4456664d44453d','545856756157467959576f3d','4d5441774e5449774d6a55774e4449354e4446664d44453d','553356696147453d','4d5441774e5449774d6a55774e544d324d446c664d446b3d','51323973623356794947747664476b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','50','10','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('14','2025-05-10 18:14:52','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e6a45304e544a664d44553d','DS005/25-26','2025-05-10','Delivery Slip','4d5441774e5449774d6a55774e444d774e4456664d44453d','545856756157467959576f3d','4d5441774e5449774d6a55774e4449354e4446664d44453d','553356696147453d','4d5441774e5449774d6a55774e544d324d446c664d446b3d','51323973623356794947747664476b3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','50','NULL','NULL','2','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('15','2025-05-10 19:04:39','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e7a41304d7a6c664d44553d','PI005/25-26','2025-05-10','Proforma Invoice','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','4d5441774e5449774d6a55774e544d354e4464664d54413d','524756736458686c','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','28','5','NULL','NULL','NULL','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('16','2025-05-10 19:30:21','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e7a4d774d6a4a664d44593d','DS006/25-26','2025-05-10','Delivery Slip','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','4d5441774e5449774d6a55784d6a55344e546c664d44593d','516d466b595342515a57466a62324e72','4d4459774e5449774d6a55774e7a41784d446c664d44493d','55476c6c5932553d','10','NULL','NULL','NULL','100','0');

INSERT INTO af_stock_conversion (id, created_date_time, creator, creator_name, bill_company_id, bill_id, bill_number, bill_date, bill_type, party_id, party_name, agent_id, agent_name, product_id, product_name, unit_id, unit_name, case_contains, inward_unit, inward_sub_unit, outward_unit, outward_sub_unit, deleted) VALUES ('17','2025-05-10 19:30:21','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','4e54557a4d7a52684e7a41324d7a4d794d7a6b325a4459304e4467324e4459344e6a4d325a4455324d7a59304f54517a4e6a637a4e54526c4e6d45304f544d314e4759314e4455314e7a63305a4451304e4445334f4452694e54457a5a444e6b','NULL','4d5441774e5449774d6a55774e7a4d774d6a4a664d44593d','DS006/25-26','2025-05-10','Delivery Slip','4d5441774e5449774d6a55774e444d784d6a5a664d444d3d','52584e3359584a70','4d5441774e5449774d6a55774e444d774d5456664d44493d','5457466f5a584e6f4946427959574a6f64513d3d','4d5441774e5449774d6a55784d6a55344e546c664d44593d','516d466b595342515a57466a62324e72','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','10','NULL','NULL','10','NULL','0');


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
  `raw_material_group_id` mediumtext DEFAULT NULL,
  `deleted` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_supplier (id, created_date_time, creator, creator_name, supplier_id, supplier_name, lower_case_name, address, city, district, state, identification, mobile_number, others_city, opening_balance, opening_balance_type, supplier_details, gst_number, name_mobile_city, email, raw_material_group_id, deleted) VALUES ('1','2025-05-10 12:43:12','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55784d6a517a4d544a664d44453d','55326868626d31315a324674','63326868626d31315a324674','4d5377675447463462576b675357356b6243424663335268644755734945356c6479424d6157357249464a7659575173494546755a47686c636d6b3d','52335670626d5235','5132686c626d356861513d3d','5647467461577767546d466b64513d3d','','4f4459784d4441324d5467304e413d3d','','30000','Debit','55326868626d31315a3246744a43516b4d5377675447463462576b675357356b6243424663335268644755734945356c6479424d6157357249464a7659575173494546755a47686c636d6b6b4a43524864576c755a486b6b4a43524461475675626d46704b455270633351754b53516b4a46526862576c73494535685a48556b4a435167545739696157786c49446f674f4459784d4441324d5467304e413d3d','','55326868626d31315a324674494367344e6a45774d4459784f4451304b534174494564316157356b65513d3d','','','0');

INSERT INTO af_supplier (id, created_date_time, creator, creator_name, supplier_id, supplier_name, lower_case_name, address, city, district, state, identification, mobile_number, others_city, opening_balance, opening_balance_type, supplier_details, gst_number, name_mobile_city, email, raw_material_group_id, deleted) VALUES ('2','2025-05-10 12:44:14','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55784d6a51304d5452664d44493d','5533567961586c68','6333567961586c68','4e794255614342476248497349454a6f59585a6c633268335958496751584a6a5957526c4c43424d5969425449453168636d633d','5157786863484231656d6868494756686333513d','5157786863484231656d6868','5332567959577868','','4f446b304f5451774d4445354d413d3d','','30000','Credit','5533567961586c684a43516b4e794255614342476248497349454a6f59585a6c633268335958496751584a6a5957526c4c43424d5969425449453168636d636b4a4352426247467763485636614745675a57467a6443516b4a454673595842776458706f5953684561584e304c696b6b4a43524c5a584a686247456b4a435167545739696157786c49446f674f446b304f5451774d4445354d413d3d','','5533567961586c68494367344f5451354e4441774d546b774b53417449454673595842776458706f5953426c59584e30','','4d5445774e5449774d6a55774e5449304d546c664d44493d','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_transport (id, created_date_time, creator, creator_name, transport_id, transport_name, mobile_number, gst_number, location, transport_details, lower_case_name, name_location, lower_case_name_location, deleted) VALUES ('1','2025-05-10 16:33:30','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55774e444d7a4d7a42664d44453d','5457396f5957346756484a68626e4e7762334a30','8320099200','','55326c325957746863326b3d','5457396f5957346756484a68626e4e7762334a3050474a795069424e62324a70624755674f6941344d7a49774d446b354d6a417750474a79506c4e70646d467259584e70','6257396f5957346764484a68626e4e7762334a30','5457396f5957346756484a68626e4e7762334a304943306755326c325957746863326b3d','6257396f5957346764484a68626e4e7762334a304943306763326c325957746863326b3d','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_unit (id, created_date_time, creator, creator_name, unit_id, unit_name, lower_case_name, deleted) VALUES ('1','2025-05-06 19:01:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e7a41784d446c664d44453d','516d3934','596d3934','0');

INSERT INTO af_unit (id, created_date_time, creator, creator_name, unit_id, unit_name, lower_case_name, deleted) VALUES ('2','2025-05-06 19:01:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e7a41784d446c664d44493d','55476c6c5932553d','63476c6c5932553d','0');

INSERT INTO af_unit (id, created_date_time, creator, creator_name, unit_id, unit_name, lower_case_name, deleted) VALUES ('3','2025-05-06 19:01:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e7a41784d446c664d444d3d','5132467a5a513d3d','5932467a5a513d3d','0');

INSERT INTO af_unit (id, created_date_time, creator, creator_name, unit_id, unit_name, lower_case_name, deleted) VALUES ('4','2025-05-10 12:47:27','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d5441774e5449774d6a55784d6a51334d6a64664d44513d','5332633d','6132633d','0');


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO af_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, factory_id, godown_id, magazine_id, deleted) VALUES ('1','2025-04-29 17:16:03','4d6a67774e4449774d6a55774d5441344e5464664d44453d','55334a706332396d64486468636d5636','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','','55334a706332396d64486468636d5636','63334a706332396d64486468636d5636','55334a706332396d64486468636d5636','4f5459794f546b314d4441774d513d3d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','51575274615734784d6a4e41','1','Super Admin','NULL','NULL','NULL','0');

INSERT INTO af_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, factory_id, godown_id, magazine_id, deleted) VALUES ('2','2025-05-06 18:28:36','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4459774e5449774d6a55774e6a49344d7a5a664d44493d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','51584a3162413d3d','59584a3162413d3d','51584a3162413d3d','4f4459784d4441324d5467304e413d3d','51584a316243416f4f4459784d4441324d5467304e436b3d','51575274615734784d6a4e41','0','Factory Incharge','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','NULL','NULL','0');

INSERT INTO af_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, factory_id, godown_id, magazine_id, deleted) VALUES ('3','2025-05-07 18:12:11','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a45794d5446664d444d3d','4d4463774e5449774d6a55774e6a45784d7a64664d44493d','6258567561513d3d','6258567561513d3d','545856756157467959576f3d','4e4455324e7a67354d446b344e773d3d','545856756157467959576f674b4451314e6a63344f5441354f446370','51575274615734784d6a4e41','0','Staff','NULL','NULL','NULL','0');

INSERT INTO af_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, factory_id, godown_id, magazine_id, deleted) VALUES ('4','2025-05-07 18:40:05','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4463774e5449774d6a55774e6a51774d4456664d44513d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','63326868626d31315a324674','63326868626d31315a324674','55326868626d31315a324674','4f446b334e6a67344f546b334e773d3d','55326868626d31315a324674494367344f5463324f4467354f5463334b513d3d','51575274615734784d6a4e41','0','Factory Incharge','4d4463774e5449774d6a55774e6a51774d4456664d44493d','NULL','NULL','0');

INSERT INTO af_user (id, created_date_time, creator, creator_name, user_id, role_id, login_id, lower_case_login_id, name, mobile_number, name_mobile, password, admin, type, factory_id, godown_id, magazine_id, deleted) VALUES ('5','2025-05-08 14:45:09','4d6a6b774e4449774d6a55774e5445324d444e664d44453d','55334a706332396d64486468636d5636494367354e6a49354f5455774d4441784b513d3d','4d4467774e5449774d6a55774d6a51314d446c664d44553d','4d4459774e5449774d6a55774e6a49344d7a5a664d44453d','6158453d','6158453d','51584a3162413d3d','4f4459784d4441334d7a59334e773d3d','51584a316243416f4f4459784d4441334d7a59334e796b3d','51575274615734784d6a4e41','0','Factory Incharge','4d4467774e5449774d6a55774d6a51314d446c664d444d3d','NULL','NULL','0');


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

