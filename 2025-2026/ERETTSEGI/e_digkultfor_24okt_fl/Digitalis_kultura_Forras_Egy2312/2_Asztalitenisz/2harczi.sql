SELECT bajnok.ev, versenyszam.nev FROM bajnok,jatekos,versenyszam
WHERE jatekos.nev ="Harczi Zsolt" and jatekos.id = bajnok.jatekos_id and versenyszam.id = bajnok.vsz_id;