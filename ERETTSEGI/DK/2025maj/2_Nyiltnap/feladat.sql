//2
SELECT nev from diakok WHERE telepules = "barnamalom"

//3
SELECT datum, terem, orasorszam from orak WHERE targy = "angol"

//4
SELECT CSOPORT, TARGY, DATUM FROM orak WHERE (targy = "matematika" or targy = "fizika") and csoport like "9%" order by targy asc

//5
SELECT telepules, count(telepules) as db from diakok group by telepules order by 2 DESC

//6
SELECT DISTINCT targy from orak order by targy ASC

//7
SELECT nev,email,telefon from diakok,orak,kapcsolo WHERE orak.id = oraid and diakok.id = diakid and tanar = "Angol Anna" and datum = "2028-11-10"

//8
SELECT nev from diakok WHERE telepules = (SELECT telepules from diakok WHERE nev = "Majer Melinda") and nev <> "Majer Melinda"

//9

SELECT datum, orasorszam, targy, tanar,ferohely-count(oraid) as szabad from orak,kapcsolo where orak.id = oraid GROUP BY orak.id having szabad >0 ORDER BY szabad desc;