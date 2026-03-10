
DROP table if exists studio;
CREATE TABLE studio (id INT NOT NULL AUTO_INCREMENT , nev varchar(40) NOT NULL , PRIMARY KEY (id)) ENGINE = InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

INSERT INTO studio(nev) SELECT DISTINCT studio FROM film ORDER BY studio;
ALTER TABLE film ADD studio_id INT NULL AFTER studio;
ALTER TABLE film ADD INDEX(studio_id);
UPDATE film SET studio_id=(SELECT studio.id FROM studio WHERE studio.nev=film.studio);
ALTER TABLE film DROP studio;



DROP table if exists ember;
CREATE TABLE ember (id INT NOT NULL AUTO_INCREMENT , 

nev varchar(40) NOT NULL , 

PRIMARY KEY (id)) ENGINE = InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;
INSERT INTO ember(nev) SELECT DISTINCT rendezo FROM film ORDER BY rendezo;
INSERT INTO ember(nev) SELECT DISTINCT magyarszoveg FROM film ORDER BY magyarszoveg;
INSERT INTO ember(nev) SELECT DISTINCT szinkronrendezo FROM film ORDER BY szinkronrendezo;
INSERT INTO ember(nev) SELECT DISTINCT szinesz FROM szinkron ORDER BY szinesz;
INSERT INTO ember(nev) SELECT DISTINCT hang FROM szinkron ORDER BY hang;

ALTER TABLE film ADD COLUMN IF NOT EXISTS rendezo_id INT NULL AFTER rendezo;
ALTER TABLE film ADD COLUMN IF NOT EXISTS magyarszoveg_id INT NULL AFTER magyarszoveg;
ALTER TABLE film ADD COLUMN IF NOT EXISTS szinkronrendezo_id INT NULL AFTER szinkronrendezo;

ALTER TABLE szinkron ADD COLUMN IF NOT EXISTS szinesz_id INT NULL AFTER szinesz;
ALTER TABLE szinkron ADD COLUMN IF NOT EXISTS hang_id INT NULL AFTER hang;

ALTER TABLE film ADD INDEX(rendezo_id);
ALTER TABLE film ADD INDEX(magyarszoveg_id);
ALTER TABLE film ADD INDEX(szinkronrendezo_id);
ALTER TABLE szinkron ADD INDEX(szinesz_id);
ALTER TABLE szinkron ADD INDEX(hang_id);

UPDATE film SET rendezo_id=(SELECT ember.id FROM ember WHERE ember.nev=film.rendezo LIMIT 1);
UPDATE film SET magyarszoveg_id=(SELECT ember.id FROM ember WHERE ember.nev=film.magyarszoveg LIMIT 1);
UPDATE film SET szinkronrendezo_id=(SELECT ember.id FROM ember WHERE ember.nev=film.szinkronrendezo LIMIT 1);
UPDATE szinkron SET szinesz_id=(SELECT ember.id FROM ember WHERE ember.nev=szinkron.szinesz LIMIT 1);
UPDATE szinkron SET hang_id=(SELECT ember.id FROM ember WHERE ember.nev=szinkron.hang LIMIT 1);

ALTER TABLE film DROP rendezo;
ALTER TABLE film DROP magyarszoveg;
ALTER TABLE film DROP szinkronrendezo;
ALTER TABLE szinkron DROP szinesz;
ALTER TABLE szinkron DROP hang;



ALTER TABLE film DROP FOREIGN KEY IF EXISTS rendezo_fk;
ALTER TABLE film
  ADD CONSTRAINT rendezo_fk FOREIGN KEY (rendezo_id) REFERENCES ember(id) on delete set null;
  
 ALTER TABLE film DROP FOREIGN KEY IF EXISTS magyarszoveg_fk;
ALTER TABLE film
  ADD CONSTRAINT magyarszoveg_fk FOREIGN KEY (magyarszoveg_id) REFERENCES ember(id) on delete set null;

  ALTER TABLE film DROP FOREIGN KEY IF EXISTS szinkronrendezo_fk;
ALTER TABLE film
  ADD CONSTRAINT szinkronrendezo_fk FOREIGN KEY (szinkronrendezo_id) REFERENCES ember(id) on delete set null;
  
  ALTER TABLE szinkron DROP FOREIGN KEY IF EXISTS szinesz_fk;
ALTER TABLE szinkron
  ADD CONSTRAINT szinesz_fk FOREIGN KEY (szinesz_id) REFERENCES ember(id) on delete set null;

    ALTER TABLE szinkron DROP FOREIGN KEY IF EXISTS hang_fk;
ALTER TABLE szinkron
  ADD CONSTRAINT hang_fk FOREIGN KEY (hang_id) REFERENCES ember(id) on delete set null;


ALTER TABLE film DROP FOREIGN KEY IF EXISTS studio_fk;
ALTER TABLE film
  ADD CONSTRAINT studio_fk FOREIGN KEY (studio_id) REFERENCES studio (id) on delete set null;

  

COMMIT;
