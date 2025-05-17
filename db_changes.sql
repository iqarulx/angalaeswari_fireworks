ALTER TABLE `af_expense` ADD `expense_party_id` MEDIUMTEXT NULL DEFAULT NULL AFTER `bank_name`; 

CREATE TABLE `af_expense_party` (
  `id` int(100) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `creator` mediumtext NOT NULL,
  `creator_name` mediumtext NOT NULL,
  `expense_party_id` mediumtext NOT NULL,
  `expense_party_name` mediumtext NOT NULL,
  `lower_case_name` mediumtext NOT NULL,
  `mobile_number` mediumtext NOT NULL,
  `opening_balance` mediumtext NOT NULL,
  `opening_balance_type` mediumtext NOT NULL,
  `expense_party_details` mediumtext NOT NULL,
  `expense_category_id` mediumtext DEFAULT NULL,
  `deleted` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `af_expense_party`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `af_expense_party`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;