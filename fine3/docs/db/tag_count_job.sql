

(SELECT `tag_group`.`name`,`tag`.`name`,`tag`.`link_name`,`tag`.`prefix`, COUNT(1) AS `job_total` FROM `tag_relation`

LEFT JOIN `tag` ON `tag_relation`.`tag_id`=`tag`.`tag_id`
LEFT JOIN `tag_group` ON `tag_group`.`tag_group_id`=`tag`.`tag_group_id`
WHERE `tag_relation`.`tag_id` IN (
	SELECT DISTINCT `tag_relation`.`tag_id` FROM `tag_relation` 
	LEFT JOIN `job` ON `tag_relation`.`account_id`=`job`.`job_id`
	WHERE `job`.`status` = 1
	AND `job`.`delete_flg` = 0
	)
AND `tag_relation`.type = 2
GROUP BY `tag`.`tag_id`
);

