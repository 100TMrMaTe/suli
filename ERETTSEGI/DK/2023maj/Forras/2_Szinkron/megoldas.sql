//2
SELECT cim,eredeti from film WHERE magyarszoveg = "heltai olga";

//3
SELECT DISTINCT film.rendezo, film.szinkronrendezo from film WHERE ev >2000;

//4
SELECT film.magyarszoveg,cim from film WHERE studio = "mafilm audio kft." and rendezo = "christopher nolan" ORDER BY 1;

//5
SELECT cim,film.eredeti,szinesz,szerep from film,szinkron WHERE szinkron.filmaz = film.filmaz and hang = "anger zsolt";

//6
SELECT eredeti,cim,count(szinkron.filmaz) from film,szinkron WHERE szinkron.filmaz = film.filmaz GROUP BY szinkron.filmaz;

//7
SELECT szinkron.szerep,szinesz,hang from szinkron WHERE szerep like "% rab%" or szerep like "%rab%";

//8
SELECT DISTINCT rendezo as "Színész-rendező" from film,szinkron WHERE szinkron.filmaz= film.filmaz and rendezo in (SELECT szinesz from szinkron);

//9
SELECT hang,cim FROM film,szinkron WHERE szinkron.filmaz = film.filmaz AND hang <>"pap kati" and szinkron.filmaz in (SELECT filmaz from szinkron WHERE hang = "pap kati") ORDER BY cim,hang;

//10
SELECT szinesz,hang,count(*) from szinkron  GROUP BY szinesz,hang HAVING count(*) >=3 order by 3 desc;

//11
SELECT ev,hang FROM film,szinkron WHERE szinkron.filmaz = film.filmaz and ev = (SELECT ev from szinkron,film WHERE film.filmaz = szinkron.filmaz and hang =hang)                order by hang;
