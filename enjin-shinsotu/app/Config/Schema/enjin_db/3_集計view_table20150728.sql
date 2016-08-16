 USE enjin_db;

 drop view if exists max_order;
 drop view if exists can_sel_job;
 drop view if exists sel_stats;
 drop view if exists sel_stat_children;
 drop view if exists ev_stats;
 drop view if exists ev_stat_children;



CREATE VIEW enjin_db.max_order AS (
		  SELECT DISTINCT MAX( ss.order ) AS max_order, sh.job_vote_id, sh.can_candidate_id 
		  FROM screening_stages AS ss 
		  INNER JOIN sel_histories AS sh ON ss.id = sh.screening_stage_id 
		  GROUP BY sh.job_vote_id, sh.can_candidate_id 
);

CREATE VIEW enjin_db.can_sel_job AS (
	SELECT rec_departments.rec_company_id rec_company_id, 
		   job_votes.id job_vote_id, 
		   can_candidates.id can_candidate_id, 
		   sel_histories.id sel_history_id, 
		   sel_histories.screening_stage_id screening_stage_id, 
		   screening_stages.last_select_flag last_sel_flag,
	 	   sel_histories.select_status_id select_status_id, 
	 	   sel_histories.created created, 
	 	   sel_histories.modified modified
	FROM can_candidates 
	INNER JOIN sel_histories ON can_candidates.id = sel_histories.can_candidate_id 
	INNER JOIN job_votes ON sel_histories.job_vote_id = job_votes.id 
	INNER JOIN rec_departments ON job_votes.rec_department_id = rec_departments.id 
	INNER JOIN screening_stages ON sel_histories.screening_stage_id = screening_stages.id 
	INNER JOIN max_order AS mo ON sel_histories.job_vote_id = mo.job_vote_id 
							   AND sel_histories.can_candidate_id = mo.can_candidate_id
							   AND  screening_stages.order = mo.max_order 
	WHERE sel_histories.status = 0

);


CREATE VIEW enjin_db.sel_stats AS (
	SELECT job_vote_id, 
	       screening_stage_id, 
	       select_status_id, 
	       last_sel_flag, 
	       count( select_status_id ) count 
	FROM can_sel_job 
	GROUP BY job_vote_id, screening_stage_id, select_status_id, last_sel_flag 
); 


CREATE VIEW enjin_db.sel_stat_children AS (
	SELECT sel_stats.job_vote_id, 
		   sel_stats.screening_stage_id, 
		   sel_stats.select_status_id, 
		   sel_stats.last_sel_flag, 
		   can_sel_job.can_candidate_id 
	FROM can_sel_job 
	INNER JOIN sel_stats ON can_sel_job.job_vote_id = sel_stats.job_vote_id 
						 AND can_sel_job.screening_stage_id = sel_stats.screening_stage_id 
						 AND can_sel_job.select_status_id = sel_stats.select_status_id 
);







CREATE VIEW enjin_db.ev_stats AS (
	SELECT ev_schedules.ev_event_id ev_event_id, 
		   ev_schedules.id ev_schedule_id, 
		   ev_histories.status ev_history_status, 
		   ev_histories.after_score after_score, 
		   count( ev_histories.id ) count
	FROM ev_schedules 
	INNER JOIN ev_histories ON ev_schedules.id = ev_histories.ev_schedule_id 
	GROUP BY ev_schedules.ev_event_id, ev_schedules.id, ev_histories.status, ev_histories.after_score  
);

CREATE VIEW enjin_db.ev_stat_children AS ( 
	SELECT ev_stats.ev_event_id, 
		   ev_stats.ev_schedule_id, 
		   ev_stats.ev_history_status, 
		   ev_stats.after_score, 
		   ev_histories.can_candidate_id 
	FROM ev_schedules 
	INNER JOIN ev_histories ON ev_schedules.id = ev_histories.ev_schedule_id 
	INNER JOIN ev_stats ON ev_schedules.id = ev_stats.ev_schedule_id 
						AND ev_histories.status = ev_stats.ev_history_status 
						AND ev_histories.after_score = ev_stats.after_score 
);


-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015 年 7 朁E23 日 04:35
-- サーバのバージョン： 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `enjin_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `ev_stat_child_histories`
--	

-- drop table if exists ev_stat_child_histories;

-- drop table if exists sel_stat_child_histories;

drop table if exists ev_stat_histories;
drop table if exists sel_stat_histories;
drop table if exists ev_stat_children_histories;
drop table if exists sel_stat_children_histories;


CREATE TABLE IF NOT EXISTS `ev_stat_children_histories` (
  `id` int(11) NOT NULL,
  `ev_event_id` int(11) NOT NULL,
  `ev_schedule_id` int(11) NOT NULL,
  `ev_history_status` int(11) NOT NULL,
  `after_score` int(11) NOT NULL,
  `can_candidate_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `ev_stat_histories`
--

CREATE TABLE IF NOT EXISTS `ev_stat_histories` (
  `id` int(11) NOT NULL,
  `ev_event_id` int(11) NOT NULL,
  `ev_schedule_id` int(11) NOT NULL,
  `ev_history_id` int(11) NOT NULL,
  `ev_history_status` int(11) NOT NULL,
  `after_score` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `stat_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `sel_stat_child_histories`
--

CREATE TABLE IF NOT EXISTS `sel_stat_children_histories` (
  `id` int(11) NOT NULL,
  `job_vote_id` int(11) NOT NULL,
  `screening_stage_id` int(11) NOT NULL,
  `select_status_id` int(11) NOT NULL,
  `last_sel_flag` int(11) NOT NULL,
  `can_candidate_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `sel_stat_histories`
--

CREATE TABLE IF NOT EXISTS `sel_stat_histories` (
  `id` int(11) NOT NULL,
  `job_vote_id` int(11) NOT NULL,
  `screening_stage_id` int(11) NOT NULL,
  `select_status_id` int(11) NOT NULL,
  `last_sel_flag` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `stat_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ev_stat_children_histories`
--
ALTER TABLE `ev_stat_children_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ev_stat_histories`
--
ALTER TABLE `ev_stat_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_stat_children_histories`
--
ALTER TABLE `sel_stat_children_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sel_stat_histories`
--
ALTER TABLE `sel_stat_histories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ev_stat_children_histories`
--
ALTER TABLE `ev_stat_children_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ev_stat_histories`
--
ALTER TABLE `ev_stat_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sel_stat_children_histories`
--
ALTER TABLE `sel_stat_children_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sel_stat_histories`
--
ALTER TABLE `sel_stat_histories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
