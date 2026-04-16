//2
SELECT letszam from megye WHERE nev = "vas";

//3
SELECT SUM(aerob.letszam) from aerob,megye WHERE megye.nev = "somogy" and aerob.mkod = megye.kod;

//4
SELECT aerob.letszam from aerob,megye,allapot WHERE megye.kod = aerob.mkod and megye.nev = "zala" and allapot.nev = "egészséges" and aerob.nem = 1 and allapot.kod = aerob.allkod;

//5
SELECT count(*) from megye WHERE megye.letszam < (SELECT letszam from megye WHERE nev = "heves");

//6
SELECT DISTINCT (SELECT SUM(aerob.letszam) from aerob,megye WHERE megye.nev = "pest" and aerob.mkod = megye.kod)/(SELECT letszam from megye WHERE nev = "pest") as resztvett 
from megye,aerob;

//7
SELECT megye.nev, aerob.letszam from aerob,megye,allapot WHERE megye.kod = aerob.mkod and allapot.nev = "egészséges" and aerob.nem = 1 and allapot.kod = aerob.allkod;

//8
SELECT megye.nev as megyenev, (SELECT SUM(aerob.letszam) from aerob,megye 
WHERE megye.nev = megyenev and aerob.mkod = megye.kod)/(SELECT letszam from megye WHERE nev = megyenev) as resztvett FROM megye ORDER by resztvett DESC LIMIT 1;

//9
SELECT megye.nev as Megyenév, (SELECT SUM(aerob.letszam) from aerob,megye,allapot 
WHERE megye.nev = Megyenév and aerob.mkod = megye.kod AND allapot.kod = aerob.allkod AND allapot.nev like "%fejlesztés%")/
(SELECT letszam from megye WHERE nev = Megyenév) as Arány FROM megye HAVING Arány >0.25;
