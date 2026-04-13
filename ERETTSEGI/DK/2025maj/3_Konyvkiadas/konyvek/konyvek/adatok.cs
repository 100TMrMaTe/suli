using System;
using System.Collections.Generic;
using System.Text;

namespace konyvek
{
    internal class adatok
    {
        public int ev;
        public int negyevev;
        public string szarmazas;
        public string mu;
        public int db;

        public adatok (int ev, int negyevev, string szarmazas, string mu, int db)
        {
            this.ev = ev;
            this.negyevev = negyevev;
            this.szarmazas = szarmazas;
            this.mu = mu;
            this.db = db;
        }
    }
}
