//2
SELECT ev,versenyszam.nev from versenyszam,bajnok,jatekos WHERE bajnok.jatekos_id = jatekos.id and jatekos.nev = "Harczi Zsolt";

//3
SELECT ev from bajnok,versenyszam WHERE versenyszam.id= bajnok.vsz_id and versenyszam.nev = "vegyes páros" order by ev limit 1;

//4
SELECT IF(neme=1,"ferfi","noi") as neme, count(*) as db from jatekos GROUP BY neme;

//5
SELECT DISTINCT orszag from egyesulet,bajnok WHERE ev >2000 and bajnok.egyesulet_id = egyesulet.id and orszag <>"magyarorszag";

//6
SELECT DISTINCT jatekos.nev from jatekos,bajnok,egyesulet WHERE bajnok.jatekos_id = jatekos.id and egyesulet.id=bajnok.egyesulet_id and egyesulet.nev = "mtk" order by neme,jatekos.nev;

//7
SELECT jatekos.nev, bajnok.ev, versenyszam.nev from jatekos,bajnok,versenyszam WHERE jatekos.id =bajnok.jatekos_id and versenyszam.id = bajnok.vsz_id GROUP BY  bajnok.jatekos_id HAVING count(bajnok.jatekos_id) <2;

//8
SELECT DISTINCT nev, (SELECT ev from bajnok WHERE jatekos.id = bajnok.jatekos_id order by ev desc LIMIT 1)-(SELECT ev from bajnok WHERE jatekos.id = bajnok.jatekos_id order by ev asc LIMIT 1) AS idotav 
FROM jatekos, bajnok 
WHERE jatekos.id = jatekos_id 
HAVING idotav>=10 
ORDER BY idotav DESC;

//9
SELECT DISTINCT jatekos.nev from jatekos,bajnok,versenyszam WHERE versenyszam.id = bajnok.vsz_id and jatekos.id = bajnok.jatekos_id and versenyszam.nev = "vegyes páros" and jatekos.nev <>"pergel szandra" and ev IN (SELECT ev from bajnok,jatekos,versenyszam WHERE jatekos.id = bajnok.jatekos_id and versenyszam.id = bajnok.vsz_id and versenyszam.nev = "vegyes páros" and jatekos.nev ="Pergel Szandra");
