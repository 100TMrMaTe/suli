SELECT csapat.nev, SUM(megoldas.pontszam) as osszpontszam from megoldas,csapat 
WHERE megoldas.csapatid = csapat.id
GROUP BY csapat.id
ORDER BY osszpontszam DESC;