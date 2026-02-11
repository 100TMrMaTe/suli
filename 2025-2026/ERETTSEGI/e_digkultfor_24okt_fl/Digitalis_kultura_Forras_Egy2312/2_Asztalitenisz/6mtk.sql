SELECT DISTINCT jatekos.nev from bajnok,egyesulet,jatekos WHERE egyesulet.nev = "MTK" and bajnok.jatekos_id = jatekos.id and egyesulet.id = bajnok.egyesulet_id
ORDER BY jatekos.neme, jatekos.nev ASC;