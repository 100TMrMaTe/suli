//2
SELECT DISTINCT kozterulet from ingatlan order by 1;

//3
SELECT hazszam ,ar from ingatlan, hirdetes WHERE hirdetes.ingatlanid = ingatlan.id and kozterulet = "Agyagos utca" and hirdetes.allapot = "meghirdetve";

//4
SELECT SUM(ar*0.015) from hirdetes WHERE hirdetes.allapot = "eladva" and datum >="2021-01-01" and datum < "2022-01-01";

//5
SELECT MAX(ar) / MIN(ar) as arany from hirdetes  WHERE hirdetes.allapot = "meghirdetve";

//6
SELECT kozterulet, hazszam, datum from hirdetes,ingatlan WHERE hirdetes.ingatlanid = ingatlan.id GROUP BY ingatlanid HAVING COUNT(ingatlanid) =1 order by datum ASC limit 1;

//7
SELECT kozterulet, hazszam, ar 
FROM ingatlan, hirdetes  
WHERE ingatlan.id=ingatlanid  
AND (allapot ='meghirdetve' OR allapot='eladva') 
GROUP BY ingatlanid 
HAVING COUNT(*)=2  
 AND MAX(ar)=MIN(ar); 

//8
SELECT kozterulet, hazszam 
FROM ingatlan 
WHERE id NOT IN ( 
SELECT ingatlanid  
 FROM helyiseg 
 WHERE funkcio='konyha' 
) 
AND id NOT IN ( 
 SELECT ingatlanid 
 FROM helyiseg 
 WHERE funkcio='WC' 
); 

//9
SELECT kozterulet, hazszam, 
SUM(hossz*szel*IF(funkcio="terasz",0.5,1)) AS terulet 
FROM ingatlan, helyiseg 
WHERE ingatlan.id=ingatlanid 
GROUP BY ingatlan.id 
HAVING terulet>180;
