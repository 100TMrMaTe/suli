SELECT jatekos.nev,bajnok.ev,versenyszam.nev FROM bajnok,jatekos,versenyszam
WHERE bajnok.jatekos_id = jatekos.id AND bajnok.vsz_id = versenyszam.id
GROUP BY jatekos.id
HAVING COUNT(jatekos.id) =1;