SELECT megnevezes, veznev, utonev, email
FROM felhasznalo, hirfolyam
WHERE felhasznalo.id=moderator; 



SELECT tartalom
FROM uzenet
WHERE tartalom LIKE '%bike%' OR tartalom LIKE '%bicikli%';



SELECT veznev, utonev
FROM felhasznalo
GROUP BY veznev, utonev
HAVING COUNT(*)>1
ORDER BY veznev, utonev; 




SELECT megnevezes, COUNT(uzenet.id)
FROM uzenet, hirfolyam
WHERE h_id=hirfolyam.id
GROUP BY hirfolyam.id
ORDER BY 2 DESC; 




SELECT veznev, utonev, tartalom, kuldido
FROM felhasznalo, uzenet, hirfolyam
WHERE felhasznalo.id=f_id AND
 tartalom LIKE CONCAT('%',megnevezes,'%'); 


 SELECT COUNT(*)
FROM (
 SELECT f_id
 FROM uzenet
 GROUP BY f_id
 ) AS egyedi


 SELECT veznev, utonev
FROM felhasznalo
WHERE utolso<'2010-01-01' AND
 id NOT IN (SELECT f_id FROM uzenet); 



 SELECT veznev, utonev, COUNT(*)
FROM felhasznalo, uzenet, hirfolyam
WHERE felhasznalo.id=f_id AND hirfolyam.id=h_id AND
 megnevezes='e-bike' AND
 kuldido BETWEEN '12:00:00' AND '16:00:00'
GROUP BY uzenet.f_id;




SELECT kuldido
FROM uzenet
WHERE f_id=(
 SELECT f_id
 FROM uzenet
 ORDER BY kuldido
 LIMIT 1
 )
ORDER BY kuldido DESC
LIMIT 1; 
