using System;
using System.Collections.Generic;
using System.Text;

namespace autok
{
    internal class adatok
    {
        public string rendszam;
        public int ora;
        public int perc;
        public int km;
        public int percben;

        public adatok(string rendszam, int ora, int perc, int km, int percben)
        {
            this.rendszam = rendszam;
            this.ora = ora;
            this.perc = perc;
            this.km = km;
            this.percben = percben;
        }
    }
}
