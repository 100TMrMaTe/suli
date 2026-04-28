//2
SELECT nev FROM tevekenyseg WHERE iskolai = -1 order by nev;


//3
SELECT sum(maxletszam*hossz) from munka;

//5
SELECT diak.nev ,count(*) as db from diak,jelentkezes WHERE  jelentkezes.diakid = diak.id AND jelentkezes.elfogadva = 1 and jelentkezes.teljesitve = 0 GROUP BY 1 having db >2;

//6
SELECT datum,kezdes,hossz,tevekenyseg.nev FROM tevekenyseg,munka WHERE datum BETWEEN "2016-10-26" and "2016-11-6" AND munka.id not in (SELECT DISTINCT munkaid from jelentkezes) and tevekenyseg.id = munka.tevekenysegid ORDER by datum,kezdes;