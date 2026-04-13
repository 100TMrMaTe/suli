SELECT jatekos.nev, MAX(bajnok.ev)-MIN(bajnok.ev) as eltelt_evek FROM jatekos,bajnok
WHERE jatekos.id = bajnok.jatekos_id
GROUP BY jatekos.id
HAVING eltelt_evek >=10
ORDER BY eltelt_evek DESC;