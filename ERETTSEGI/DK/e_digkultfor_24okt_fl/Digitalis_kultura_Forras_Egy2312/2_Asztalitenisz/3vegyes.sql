SELECT bajnok.ev from bajnok,versenyszam
WHERE versenyszam.nev = "vegyes páros" and versenyszam.id = bajnok.vsz_id
ORDER BY bajnok.ev ASC
LIMIT 1;