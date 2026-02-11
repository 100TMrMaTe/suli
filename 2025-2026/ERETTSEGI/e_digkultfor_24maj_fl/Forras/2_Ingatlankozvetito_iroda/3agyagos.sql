SELECT ingatlan.hazszam,hirdetes.ar FROM ingatlan,hirdetes
WHERE ingatlan.kozterulet = "Agyagos utca" and hirdetes.allapot = "meghirdetve" and ingatlan.id = hirdetes.ingatlanid