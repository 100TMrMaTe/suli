using System;
using System.Collections.Generic;
using System.Text;

namespace vizsga
{
    internal class adatok
    {
        public string rendszam;
        public string fajta;
        public string uzembe;
        public string tulaj;
        public string datum;

        public adatok(string rendszam, string fajta, string uzembe, string tulaj, string datum)
        {
            this.rendszam = rendszam;
            this.fajta = fajta;
            this.uzembe = uzembe;
            this.tulaj = tulaj;
            this.datum = datum;
        }
    }
}
