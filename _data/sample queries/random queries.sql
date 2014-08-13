SELECT * FROM users WHERE genre='M' AND date(born) between '1994-01-01' AND '2014-01-01' AND id_user=128012;

SELECT c.* FROM group_types gt, group_type_criteria gtc, criterias c
WHERE gt.id_group_type = gtc.id_group_type AND c.id_criteria = gtc.id_criteria AND gt.id_group_type = 3;
SELECT * FROM modalities;
update users set checked = 1 WHERE id_modality = 5;
SELECT u.* FROM users u WHERE u.id_modality=5;
SELECT u.* FROM users u WHERE u.id_modality=5 and u.id_user not in (SELECT group_master FROM groups GROUP BY group_master);

SELECT g.*, group_master FROM groups g group by group_master;
SELECT * FROM GROUPS;