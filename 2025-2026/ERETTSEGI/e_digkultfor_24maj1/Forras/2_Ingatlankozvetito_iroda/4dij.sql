SELECT SUM(ar)*0.015
FROM hirdetes
WHERE allapot='eladva'
AND datum BETWEEN '2021.01.01' AND '2021.12.31';