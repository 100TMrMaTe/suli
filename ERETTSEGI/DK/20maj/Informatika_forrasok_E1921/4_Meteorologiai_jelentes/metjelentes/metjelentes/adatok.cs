using System;
using System.Collections.Generic;
using System.Text;

namespace metjelentes
{
    internal class adatok
    {
        public string varos;
        public string ora;
        public string perc;
        public string irany;
        public int erosseg;
        public int homerseklet;

        public adatok(string varos, string ora, string perc, string irany, int erosseg, int homerseklet)
        {
            this.varos = varos;
            this.ora = ora;
            this.perc = perc;
            this.irany = irany;
            this.erosseg = erosseg;
            this.homerseklet = homerseklet;
        }
    }
}
