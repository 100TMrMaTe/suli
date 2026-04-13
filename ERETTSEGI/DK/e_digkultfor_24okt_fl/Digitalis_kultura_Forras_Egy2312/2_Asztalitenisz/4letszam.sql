SELECT COUNT(*), IF(jatekos.neme = 0,"nő","ferfi") AS nemek
from jatekos
GROUP BY jatekos.neme;