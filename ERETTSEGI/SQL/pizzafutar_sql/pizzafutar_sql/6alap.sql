SELECT nev
FROM pizza
WHERE id IN ( … )
GROUP BY nev
HAVING Count(meret)=3; 

//3
SELECT nev,meret,ar from pizza WHERE ar <1500 ORDER BY meret desc,nev asc;

//4
SELECT nev,meret, count(pizzaid)as db from pizza,rendeles WHERE rendeles.pizzaid = pizza.id GROUP by pizzaid order by 3 desc limit 1;

//5
SELECT COUNT(*) FROM rendeles WHERE rendeles.szallitas BETWEEN "18:00" and "19:00" ;

//6