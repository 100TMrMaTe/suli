SELECT film.ev,szinkron.hang from szinkron,film WHERE szinkron.filmaz =film.filmaz and film.studio != "Mafilm Audio Kft." GROUP BY hang having count(ev) >=2 order BY hang
 ASC;