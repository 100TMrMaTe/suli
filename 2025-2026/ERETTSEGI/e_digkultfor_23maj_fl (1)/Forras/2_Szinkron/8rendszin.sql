SELECT DISTINCT rendezo as Színész-rendező from film WHERE rendezo = (SELECT szinkron.szinesz from szinkron)
// nem jo