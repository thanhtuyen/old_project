-- can_qualificationsのIDにautoincrimentを設定
ALTER TABLE `can_qualifications` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

-- can_educationsにstatusの追加
ALTER TABLE `can_educations` ADD `status` INT(11) NOT NULL AFTER `graduation_date`;