SELECT DISTINCT csapat.nev from feladat,csapat,megoldas
WHERE csapat.id = megoldas.csapatid and megoldas.feladatid = feladat.id
and feladat.pontszam = megoldas.pontszam;