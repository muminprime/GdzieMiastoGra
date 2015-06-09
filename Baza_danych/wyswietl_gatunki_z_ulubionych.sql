SELECT g.nazwa FROM `database`.gatunki as g RIGHT JOIN
(SELECT gat1 as 'id_gatunkow' FROM (
SELECT gat1 FROM `database`.ulubione_gatunki WHERE id = 11
UNION ALL
SELECT gat2 FROM `database`.ulubione_gatunki WHERE id = 11
UNION ALL
SELECT gat3 FROM `database`.ulubione_gatunki WHERE id = 11
UNION ALL
SELECT gat4 FROM `database`.ulubione_gatunki WHERE id = 11
UNION ALL
SELECT gat5 FROM `database`.ulubione_gatunki WHERE id = 11
UNION ALL
SELECT gat6 FROM `database`.ulubione_gatunki WHERE id = 11
UNION ALL
SELECT gat7 FROM `database`.ulubione_gatunki WHERE id = 11
UNION ALL
SELECT gat8 FROM `database`.ulubione_gatunki WHERE id = 11
UNION ALL
SELECT gat9 FROM `database`.ulubione_gatunki WHERE id = 11
UNION ALL
SELECT gat10 FROM `database`.ulubione_gatunki WHERE id = 11
UNION ALL
SELECT gat11 FROM `database`.ulubione_gatunki WHERE id = 11
) T1
WHERE gat1 > 0) T2
ON g.id=T2.id_gatunkow