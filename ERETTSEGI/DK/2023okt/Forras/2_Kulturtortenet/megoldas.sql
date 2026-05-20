SELECT nev from csapat WHERE nev like "#%";
//3
SELECT feladatsor.nevado from feladatsor WHERE nevado not like "% % %";
//4
SELECT nevado from feladatsor WHERE kituzes <= "2018-12-31" and hatarido >= "2019-01-01";
//5
//6
SELECT nevado,ag,sum(pontszam) as elerheto from feladatsor,feladat WHERE feladatsor.id= feladat.feladatsorid GROUP BY feladatsor.id having elerheto <> 150;