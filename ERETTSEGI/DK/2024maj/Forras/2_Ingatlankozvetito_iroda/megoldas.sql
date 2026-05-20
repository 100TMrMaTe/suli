//2
SELECT DISTINCT kozterulet FROM ingatlan order by kozterulet;
//3
SELECT ingatlan.hazszam, hirdetes.ar from ingatlan,hirdetes WHERE hirdetes.ingatlanid = ingatlan.id and ingatlan.kozterulet= "Agyagos utca" and hirdetes.allapot = "meghirdetve";
//4
SELECT sum(ar)*0.015 from hirdetes WHERE hirdetes.allapot = "eladva" and hirdetes.datum >= "2021.01.01" and datum <= "2021.12.31";
//5
SELECT max(ar)/min(ar) from hirdetes WHERE allapot = "meghirdetve";
//6
SELECT kozterulet,hazszam,datum from ingatlan,hirdetes WHERE hirdetes.ingatlanid = ingatlan.id GROUP BY ingatlanid HAVING COUNT(ingatlanid) = 1 ORDER BY datum limit 1;
//7
SELECT DISTINCT kozterulet,hazszam,ar from ingatlan,hirdetes WHERE hirdetes.ingatlanid = ingatlan.id and (SELECT ar from hirdetes WHERE ingatlanid = ingatlan.id and hirdetes.allapot = "meghirdetve") = (SELECT ar from hirdetes WHERE ingatlanid = ingatlan.id and hirdetes.allapot = "eladva");
//8
SELECT kozterulet, hazszam 
FROM ingatlan 
WHERE id NOT IN (SELECT ingatlanid from helyiseg WHERE helyiseg.funkcio = "WC") 
AND id NOT IN (SELECT ingatlanid from helyiseg WHERE helyiseg.funkcio = "konyha");
//9