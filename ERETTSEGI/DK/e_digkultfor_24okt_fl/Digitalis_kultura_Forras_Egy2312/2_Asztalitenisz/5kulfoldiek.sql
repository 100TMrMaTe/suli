SELECT DISTINCT egyesulet.orszag from bajnok,egyesulet
WHERE bajnok.ev > 2000 and egyesulet.orszag != "Magyarország" and egyesulet.id = bajnok.egyesulet_id;