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
        public int sebesseg;

        public adatok(string rendszam,int ora, int perc, int sebesseg)
        {
            this.rendszam = rendszam;
            this.ora = ora;
            this.perc = perc;
            this.sebesseg = sebesseg;
        }
    }
}
