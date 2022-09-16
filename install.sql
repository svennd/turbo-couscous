

CREATE TABLE `brick_info` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL,
  `pool` varchar(255) NOT NULL,
  `brick` varchar(255) NOT NULL,
  `avail` bigint(20) NOT NULL,
  `used` bigint(20) NOT NULL,
  `snapshots` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ping`
--

CREATE TABLE `ping` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `descr` text DEFAULT NULL,
  `cron_code` text DEFAULT NULL,
  `expected_result` text DEFAULT NULL,
  `count` int(11) DEFAULT 0,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ping_log`
--

CREATE TABLE `ping_log` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zfs_info`
--

CREATE TABLE `zfs_info` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` bigint(20) NOT NULL,
  `free` bigint(20) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zfs_snapshots`
--

CREATE TABLE `zfs_snapshots` (
  `hash` varchar(255) NOT NULL,
  `server` varchar(255) NOT NULL,
  `pool` varchar(255) NOT NULL,
  `brick` varchar(255) NOT NULL,
  `snapshot` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brick_info`
--
ALTER TABLE `brick_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hash` (`hash`,`server`,`pool`,`brick`) USING HASH;

--
-- Indexes for table `ping`
--
ALTER TABLE `ping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ping_log`
--
ALTER TABLE `ping_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zfs_info`
--
ALTER TABLE `zfs_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hash` (`hash`);

--
-- Indexes for table `zfs_snapshots`
--
ALTER TABLE `zfs_snapshots`
  ADD UNIQUE KEY `key` (`hash`,`server`,`pool`,`brick`,`snapshot`) USING HASH,
  ADD KEY `hash_lookup` (`hash`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brick_info`
--
ALTER TABLE `brick_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ping`
--
ALTER TABLE `ping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ping_log`
--
ALTER TABLE `ping_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zfs_info`
--
ALTER TABLE `zfs_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
