SELECT nev
FROM nyelv, fordito, szemely
WHERE nyelv.id=nyelvid AND szemelyid=szemely.id AND szemely.elerheto = 1 and fnyelv = "magyar" and (cnyelv = "angol" or cnyelv = "orosz") GROUP BY nev HAVING count(nev)>1;