//2
SELECT nev from tag WHERE elhunyt <> "" order by nev;
//3
SELECT nev,identitas,tipus,ev from tag,tagsag WHERE tag.id = tagsag.tagid and identitas <> "" and (tipus ="r" or tipus = "l") order by ev;
//4
SELECT DISTINCT nev,ev from tag,tagsag WHERE tag.id =tagsag.tagid;
//5
SELECT DISTINCT ((SELECT COUNT(*) from tag WHERE nem ="n")/(SELECT COUNT(*) from tag)) as nokaranya from tag;
//6