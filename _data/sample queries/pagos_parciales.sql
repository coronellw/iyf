select 
	h.name, pu.id_user, u.names, SUM(p.amount) as pagado, u.pays as "debe_pagar"
FROM 
	payments p, payment_user pu, users u, headquarters h
WHERE 
	p.id_payment = pu.id_payment and
	u.id_user = pu.id_user and
	u.id_headquarters = h.id_headquarter
GROUP BY 
	u.id_user
HAVING
	pagado >= u.pays;

