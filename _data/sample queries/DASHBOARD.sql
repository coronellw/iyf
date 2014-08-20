select 
	h.name, 
	(select count(*) from users u1 where u1.id_headquarters = h.id_headquarter) as inscritos, -- registrados
	(select count(*) from users u1 where (u1.id_modality = 1 or u1.id_modality = 2) and u1.id_headquarters = h.id_headquarter ) as nuevos, -- nuevos
	-- (select count(*) from users u1, payment_user pu, payments p WHERE u1.id_user = pu.id_user AND pu.id_payment = p.id_payment AND u1.pays = ), -- pagos completos
	SUM(u.pays) as recaudo
from 
	users u, headquarters h 
where 
	u.id_headquarters = h.id_headquarter 
group by 
	h.id_headquarter;