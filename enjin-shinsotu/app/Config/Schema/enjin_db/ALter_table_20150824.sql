-- can_qualifications‚ÌID‚Éautoincriment‚ğİ’è
ALTER TABLE `can_qualifications` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

-- can_educations‚Éstatus‚Ì’Ç‰Á
ALTER TABLE `can_educations` ADD `status` INT(11) NOT NULL AFTER `graduation_date`;