-- can_qualifications��ID��autoincriment��ݒ�
ALTER TABLE `can_qualifications` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

-- can_educations��status�̒ǉ�
ALTER TABLE `can_educations` ADD `status` INT(11) NOT NULL AFTER `graduation_date`;