//2
SELECT hirfolyam.megnevezes, felhasznalo.veznev, felhasznalo.utonev, felhasznalo.email from hirfolyam,felhasznalo WHERE felhasznalo.id = hirfolyam.moderator;

//3

SELECT tartalom from uzenet WHERE tartalom like "%bike%" or tartalom like "%bicikli%";

//4
SELECT veznev, utonev, COUNT(*)
FROM felhasznalo
GROUP BY veznev, utonev
HAVING COUNT(*)>1
ORDER BY veznev, utonev

//5

SELECT megnevezes, COUNT(uzenet.id)
FROM uzenet, hirfolyam
WHERE h_id=hirfolyam.id
GROUP BY hirfolyam.id
ORDER BY 2 DESC;

//6

SELECT COUNT(DISTINCT f_id)
FROM uzenet; 

//7

SELECT veznev, utonev
FROM felhasznalo
WHERE utolso<'2010-01-01' AND
 id NOT IN (SELECT f_id FROM uzenet);

 //8

 SELECT veznev, utonev, COUNT(*)
FROM felhasznalo, uzenet, hirfolyam
WHERE felhasznalo.id=f_id AND hirfolyam.id=h_id AND
 megnevezes='e-bike' AND
 kuldido >= '12:00:00' AND kuldido <= '16:00:00'
GROUP BY uzenet.f_id;

//9

SELECT kuldido from uzenet WHERE (SELECT f_id from uzenet order by kuldido ASC limit 1) = f_id order by kuldido DESC limit 1