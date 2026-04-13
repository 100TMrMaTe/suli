//2
SELECT csapat.nev from csapat WHERE nev like "#%"

//3
SELECT nevado from feladatsor WHERE nevado not like "% % %";

//4
SELECT nevado from feladatsor WHERE kituzes <="2018-12-31" and hatarido >="2018-12-31";

//5
SELECT csapat.nev, sum(pontszam) FROM csapat,megoldas WHERE megoldas.csapatid = csapat.id GROUP BY csapatid order by 2 desc;

//6
SELECT nevado,ag,sum(pontszam) FROM feladatsor,feladat WHERE feladatsor.id=feladat.feladatsorid GROUP BY feladat.feladatsorid having sum(pontszam) <>150; 

//7
SELECT DISTINCT csapat.nev from csapat,feladat,megoldas WHERE csapat.id = megoldas.csapatid and feladat.id = megoldas.feladatid and megoldas.pontszam = feladat.pontszam;

//8
