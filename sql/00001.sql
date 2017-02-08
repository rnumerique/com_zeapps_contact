CREATE TABLE `zeapps_code_naf` (
  `code_naf` varchar(6) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `zeapps_code_naf`
--
ALTER TABLE `zeapps_code_naf`
  ADD PRIMARY KEY (`code_naf`);

CREATE TABLE `zeapps_companies` (
  `id` int(10) unsigned NOT NULL,
  `id_user_account_manager` int(10) unsigned NOT NULL,
  `name_user_account_manager` varchar(100) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `id_parent_company` int(10) unsigned NOT NULL,
  `name_parent_company` varchar(255) NOT NULL,
  `id_type_account` int(10) unsigned NOT NULL,
  `name_type_account` int(100) NOT NULL,
  `id_activity_area` int(10) unsigned NOT NULL,
  `name_activity_area` varchar(100) NOT NULL,
  `turnover` bigint(20) NOT NULL,
  `billing_address_1` varchar(100) NOT NULL,
  `billing_address_2` varchar(100) NOT NULL,
  `billing_address_3` varchar(100) NOT NULL,
  `billing_city` varchar(100) NOT NULL,
  `billing_zipcode` varchar(50) NOT NULL,
  `billing_state` varchar(100) NOT NULL,
  `billing_country_id` int(10) unsigned NOT NULL,
  `billing_country_name` varchar(100) NOT NULL,
  `delivery_address_1` varchar(100) NOT NULL,
  `delivery_address_2` varchar(100) NOT NULL,
  `delivery_address_3` varchar(100) NOT NULL,
  `delivery_city` varchar(100) NOT NULL,
  `delivery_zipcode` varchar(50) NOT NULL,
  `delivery_state` varchar(100) NOT NULL,
  `delivery_country_id` int(10) unsigned NOT NULL,
  `delivery_country_name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `phone` varchar(25) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `code_naf` varchar(15) NOT NULL,
  `code_naf_libelle` varchar(255) NOT NULL,
  `company_number` varchar(30) NOT NULL,
  `accounting_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `zeapps_companies`
--
ALTER TABLE `zeapps_companies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `zeapps_companies`
--
ALTER TABLE `zeapps_companies`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;

CREATE TABLE `zeapps_contacts` (
  `id` int(10) unsigned NOT NULL,
  `id_user_account_manager` int(10) unsigned NOT NULL,
  `name_user_account_manager` varchar(100) NOT NULL,
  `id_company` int(10) unsigned NOT NULL,
  `name_company` varchar(255) NOT NULL DEFAULT '',
  `title_name` varchar(30) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `other_phone` varchar(25) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `assistant` varchar(70) NOT NULL,
  `assistant_phone` varchar(25) NOT NULL,
  `department` varchar(100) NOT NULL,
  `job` varchar(100) NOT NULL,
  `email_opt_out` enum('Y','N') NOT NULL DEFAULT 'N',
  `skype_id` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL DEFAULT '0000-00-00',
  `address_1` varchar(100) NOT NULL,
  `address_2` varchar(100) NOT NULL,
  `address_3` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `website_url` varchar(255) NOT NULL,
  `accounting_number` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `zeapps_contacts`
--
ALTER TABLE `zeapps_contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `zeapps_contacts`
--
ALTER TABLE `zeapps_contacts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;

CREATE TABLE `zeapps_country_lang` (
  `id_country` int(10) unsigned NOT NULL,
  `id_lang` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `zeapps_country_lang`
--
ALTER TABLE `zeapps_country_lang`
  ADD PRIMARY KEY (`id_country`,`id_lang`);
