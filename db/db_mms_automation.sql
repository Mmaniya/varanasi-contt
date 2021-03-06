-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2020 at 06:16 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mms_automation`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_user`
--

CREATE TABLE `tbl_admin_user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(55) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clients`
--

CREATE TABLE `tbl_clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_website` varchar(55) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `country` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zipcode` varchar(15) NOT NULL,
  `is_wl_member` enum('Y','N') NOT NULL COMMENT 'yes,no',
  `if_yes_wl_member_id` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_documents`
--

CREATE TABLE `tbl_client_documents` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `document` varchar(100) NOT NULL,
  `questionnaire_id` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_notes`
--

CREATE TABLE `tbl_client_notes` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_services`
--

CREATE TABLE `tbl_client_services` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_to_do`
--

CREATE TABLE `tbl_client_to_do` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `checklist` text NOT NULL,
  `document` varchar(100) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consultancy`
--

CREATE TABLE `tbl_consultancy` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `mobile` varchar(55) NOT NULL,
  `contact_person` varchar(55) NOT NULL,
  `charges_collected` varchar(55) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discount`
--

CREATE TABLE `tbl_discount` (
  `id` int(11) NOT NULL,
  `discount_name` varchar(55) NOT NULL,
  `discount_code` varchar(55) NOT NULL,
  `discount_type` enum('P','F') NOT NULL COMMENT 'percentage,flat',
  `discount_value` int(11) NOT NULL,
  `discount_valid_from_date` varchar(55) NOT NULL,
  `discount_valid_to_date` varchar(55) NOT NULL,
  `description` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_template`
--

CREATE TABLE `tbl_email_template` (
  `id` int(11) NOT NULL,
  `template_name` text NOT NULL,
  `template_content` text NOT NULL,
  `attached_file` varchar(100) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(55) NOT NULL,
  `last_name` varchar(55) NOT NULL,
  `mobile` varchar(55) NOT NULL,
  `role_id` int(11) NOT NULL,
  `relevant_field` enum('E','F') NOT NULL COMMENT 'experience /fresher',
  `if_experience_years` varchar(55) NOT NULL,
  `qualification` varchar(55) NOT NULL,
  `joining_date` varchar(55) NOT NULL,
  `package_id` int(11) NOT NULL,
  `company_email` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `personal_email` varchar(55) NOT NULL,
  `proof_of_address` varchar(55) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(55) NOT NULL,
  `state` varchar(55) NOT NULL,
  `zipcode` varchar(55) NOT NULL,
  `employee_img` varchar(55) NOT NULL,
  `emergency_contact_no` varchar(55) NOT NULL,
  `blood_group` varchar(30) NOT NULL,
  `reached_mms_by` varchar(55) NOT NULL,
  `if_reference_or_consultancy_id` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_package`
--

CREATE TABLE `tbl_employee_package` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `monthly_package` varchar(55) NOT NULL,
  `bank_name` varchar(55) NOT NULL,
  `ifsc_code` varchar(55) NOT NULL,
  `account_number` varchar(55) NOT NULL,
  `upi_id` text NOT NULL,
  `account_name` varchar(55) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_role`
--

CREATE TABLE `tbl_employee_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(55) NOT NULL,
  `role_abbr` varchar(30) NOT NULL,
  `role_description` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_full_payment`
--

CREATE TABLE `tbl_full_payment` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `payment_method` enum('upi','netbanking','cash','cheque') NOT NULL COMMENT 'upi/netbanking/cash/cheque	',
  `payment_transaction_id` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_installment`
--

CREATE TABLE `tbl_installment` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `no_of_instalment` int(11) NOT NULL,
  `next_due_date` varchar(55) NOT NULL,
  `paid_amt` varchar(55) NOT NULL,
  `due_amt` varchar(55) NOT NULL,
  `payment_method` enum('upi','netbanking','cash','cheque') NOT NULL COMMENT '	upi/netbanking/cash/cheque	',
  `payment_transaction_id` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_internal_documents`
--

CREATE TABLE `tbl_internal_documents` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `document` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_internal_notes`
--

CREATE TABLE `tbl_internal_notes` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `notes` text NOT NULL,
  `team_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `id` int(11) NOT NULL,
  `invoice_date` varchar(55) NOT NULL,
  `invoice_number` varchar(55) NOT NULL,
  `client_id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `tax_percentage` varchar(55) NOT NULL,
  `tax_amount` varchar(55) NOT NULL,
  `invoice_amount` varchar(55) NOT NULL,
  `email_send` enum('Y','N') NOT NULL COMMENT 'Yes,No',
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leads`
--

CREATE TABLE `tbl_leads` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_website` varchar(55) NOT NULL,
  `email_address` varchar(55) NOT NULL,
  `phone_number` varchar(55) NOT NULL,
  `country` varchar(55) NOT NULL,
  `state` varchar(55) NOT NULL,
  `city` varchar(55) NOT NULL,
  `zipcode` varchar(55) NOT NULL,
  `enquiry_type` enum('C','E','R','O') NOT NULL COMMENT 'call/email/reference/online',
  `enquiry_categories_id` int(11) NOT NULL,
  `enquiry_services_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id` int(11) NOT NULL,
  `table_name` text NOT NULL,
  `table_row_id` int(11) NOT NULL,
  `operations` text NOT NULL,
  `before_details` text NOT NULL,
  `after_details` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `updated_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_part_payment`
--

CREATE TABLE `tbl_part_payment` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `due_amt` varchar(55) NOT NULL,
  `payment_method` enum('upi','netbanking','cash','cheque') NOT NULL COMMENT 'upi/netbanking/cash/cheque',
  `payment_transaction_id` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `payment_type` enum('F','I','P') NOT NULL COMMENT 'fullpayment/installment/partpayment',
  `payment_type_id` int(11) NOT NULL,
  `email_send` enum('Y','N') NOT NULL COMMENT 'Yes,No',
  `payment_status` enum('P','S') NOT NULL COMMENT 'Pending,Success',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_transaction`
--

CREATE TABLE `tbl_payment_transaction` (
  `id` int(11) NOT NULL,
  `amount_to_be_paid` varchar(55) NOT NULL,
  `netbanking_txn_no` varchar(55) NOT NULL,
  `netbanking_txn_date` varchar(55) NOT NULL,
  `upi_id` varchar(100) NOT NULL,
  `upi_txn_no` varchar(55) NOT NULL,
  `upi_txn_date` varchar(55) NOT NULL,
  `cheque_no` varchar(55) NOT NULL,
  `cheque_date` varchar(55) NOT NULL,
  `cash_received_date` varchar(55) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE `tbl_project` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `client_document_id` int(11) NOT NULL,
  `project_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questionnaire`
--

CREATE TABLE `tbl_questionnaire` (
  `id` int(11) NOT NULL,
  `question_line_item_id` varchar(100) NOT NULL,
  `service_id` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions`
--

CREATE TABLE `tbl_questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `description` text NOT NULL,
  `question_type` varchar(55) NOT NULL,
  `is_repeatable_field` enum('Y','N') NOT NULL COMMENT 'Yes,No',
  `status` enum('A','I') NOT NULL COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questions_line_item`
--

CREATE TABLE `tbl_questions_line_item` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation`
--

CREATE TABLE `tbl_quotation` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `quotation_number` varchar(55) NOT NULL,
  `quotation_date` varchar(55) NOT NULL,
  `quotation_line_item_id` int(11) NOT NULL,
  `quotation_amt` varchar(55) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `discount_amt` varchar(55) NOT NULL,
  `terms_and_condtion_id` int(11) NOT NULL,
  `email_send` enum('Y','N') NOT NULL COMMENT 'Yes,No',
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_line_item`
--

CREATE TABLE `tbl_quotation_line_item` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `line_item` varchar(100) NOT NULL,
  `line_description` text NOT NULL,
  `line_value` varchar(55) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reference`
--

CREATE TABLE `tbl_reference` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `mobile` varchar(55) NOT NULL,
  `address` varchar(55) NOT NULL,
  `city` varchar(55) NOT NULL,
  `state` varchar(55) NOT NULL,
  `zipcode` varchar(55) NOT NULL,
  `working_mms` enum('Y','N') NOT NULL COMMENT 'Yes,No',
  `if_yes_member_id` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE `tbl_service` (
  `id` int(11) NOT NULL,
  `service_name` varchar(55) NOT NULL,
  `service_description` text NOT NULL,
  `service_img` varchar(55) NOT NULL,
  `category_id` int(11) NOT NULL,
  `service_payment_type` enum('onetime','recurring') NOT NULL COMMENT 'onetime/recurring',
  `if_recurring_period` varchar(30) NOT NULL,
  `recurring_type` enum('weekly','bi_weekly','monthly','yearly') NOT NULL COMMENT 'weekly/bi_weekly/monthly/yearly',
  `service_price` varchar(55) NOT NULL,
  `service_delivery_time` varchar(55) NOT NULL,
  `service_delivery_type` enum('day','week','month') NOT NULL COMMENT 'day/week/month',
  `service_questionnaire_complete_days` varchar(30) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_categories`
--

CREATE TABLE `tbl_service_categories` (
  `id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `category_abbr` varchar(55) NOT NULL,
  `category_description` text NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_faq`
--

CREATE TABLE `tbl_service_faq` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `service_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_features`
--

CREATE TABLE `tbl_service_features` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `service_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_steps`
--

CREATE TABLE `tbl_service_steps` (
  `id` int(11) NOT NULL,
  `service_steps_line_item_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_steps_line_item`
--

CREATE TABLE `tbl_service_steps_line_item` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `estimated_time_type` enum('H','D','W','M') NOT NULL COMMENT 'hours/day/week/month',
  `position` int(11) NOT NULL,
  `status` enum('A','I') NOT NULL COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teams`
--

CREATE TABLE `tbl_teams` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `team_lead` enum('Y','N') NOT NULL COMMENT 'Yes,No',
  `project_assigned_date` varchar(55) NOT NULL,
  `project_deadline_time` varchar(55) NOT NULL,
  `project_deadline_type` enum('H','D','W','M') NOT NULL COMMENT 'hours/days/weeks/months',
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_terms_and_condtions`
--

CREATE TABLE `tbl_terms_and_condtions` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_to_do`
--

CREATE TABLE `tbl_to_do` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `checklist` text NOT NULL,
  `document` text NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wl_members`
--

CREATE TABLE `tbl_wl_members` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `payment_transaction_id` int(11) NOT NULL,
  `membership_start_date` varchar(30) NOT NULL,
  `membership_end_date` varchar(30) NOT NULL,
  `email_send (Yes,No)` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Yes,No',
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wl_membership`
--

CREATE TABLE `tbl_wl_membership` (
  `id` int(11) NOT NULL,
  `membership_fee` varchar(55) NOT NULL,
  `membership_type` varchar(55) NOT NULL,
  `membership_duration` varchar(55) NOT NULL,
  `status` enum('A','I') NOT NULL DEFAULT 'A' COMMENT 'Active,Inactive',
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_user`
--
ALTER TABLE `tbl_admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_client_documents`
--
ALTER TABLE `tbl_client_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_client_notes`
--
ALTER TABLE `tbl_client_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_client_services`
--
ALTER TABLE `tbl_client_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_client_to_do`
--
ALTER TABLE `tbl_client_to_do`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_consultancy`
--
ALTER TABLE `tbl_consultancy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_discount`
--
ALTER TABLE `tbl_discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_email_template`
--
ALTER TABLE `tbl_email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee_package`
--
ALTER TABLE `tbl_employee_package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_employee_role`
--
ALTER TABLE `tbl_employee_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_full_payment`
--
ALTER TABLE `tbl_full_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_installment`
--
ALTER TABLE `tbl_installment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_internal_documents`
--
ALTER TABLE `tbl_internal_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_internal_notes`
--
ALTER TABLE `tbl_internal_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_leads`
--
ALTER TABLE `tbl_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_part_payment`
--
ALTER TABLE `tbl_part_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment_transaction`
--
ALTER TABLE `tbl_payment_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_questionnaire`
--
ALTER TABLE `tbl_questionnaire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_questions_line_item`
--
ALTER TABLE `tbl_questions_line_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quotation_line_item`
--
ALTER TABLE `tbl_quotation_line_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reference`
--
ALTER TABLE `tbl_reference`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service`
--
ALTER TABLE `tbl_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service_categories`
--
ALTER TABLE `tbl_service_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service_faq`
--
ALTER TABLE `tbl_service_faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service_features`
--
ALTER TABLE `tbl_service_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service_steps`
--
ALTER TABLE `tbl_service_steps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_service_steps_line_item`
--
ALTER TABLE `tbl_service_steps_line_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teams`
--
ALTER TABLE `tbl_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_terms_and_condtions`
--
ALTER TABLE `tbl_terms_and_condtions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_to_do`
--
ALTER TABLE `tbl_to_do`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wl_members`
--
ALTER TABLE `tbl_wl_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wl_membership`
--
ALTER TABLE `tbl_wl_membership`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_user`
--
ALTER TABLE `tbl_admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_clients`
--
ALTER TABLE `tbl_clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_documents`
--
ALTER TABLE `tbl_client_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_notes`
--
ALTER TABLE `tbl_client_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_services`
--
ALTER TABLE `tbl_client_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_client_to_do`
--
ALTER TABLE `tbl_client_to_do`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_consultancy`
--
ALTER TABLE `tbl_consultancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_discount`
--
ALTER TABLE `tbl_discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_email_template`
--
ALTER TABLE `tbl_email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee_package`
--
ALTER TABLE `tbl_employee_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_employee_role`
--
ALTER TABLE `tbl_employee_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_full_payment`
--
ALTER TABLE `tbl_full_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_installment`
--
ALTER TABLE `tbl_installment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_internal_documents`
--
ALTER TABLE `tbl_internal_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_internal_notes`
--
ALTER TABLE `tbl_internal_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_leads`
--
ALTER TABLE `tbl_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_part_payment`
--
ALTER TABLE `tbl_part_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment_transaction`
--
ALTER TABLE `tbl_payment_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_project`
--
ALTER TABLE `tbl_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_questionnaire`
--
ALTER TABLE `tbl_questionnaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_questions`
--
ALTER TABLE `tbl_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_questions_line_item`
--
ALTER TABLE `tbl_questions_line_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotation_line_item`
--
ALTER TABLE `tbl_quotation_line_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reference`
--
ALTER TABLE `tbl_reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_service`
--
ALTER TABLE `tbl_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_service_categories`
--
ALTER TABLE `tbl_service_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_service_faq`
--
ALTER TABLE `tbl_service_faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_service_features`
--
ALTER TABLE `tbl_service_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_service_steps`
--
ALTER TABLE `tbl_service_steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_service_steps_line_item`
--
ALTER TABLE `tbl_service_steps_line_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_teams`
--
ALTER TABLE `tbl_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_terms_and_condtions`
--
ALTER TABLE `tbl_terms_and_condtions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_to_do`
--
ALTER TABLE `tbl_to_do`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_wl_members`
--
ALTER TABLE `tbl_wl_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_wl_membership`
--
ALTER TABLE `tbl_wl_membership`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
