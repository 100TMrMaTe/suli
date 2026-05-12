using System;
using System.Collections.Generic;
using System.Text;

namespace cegesauto
{
    internal class adatok
    {
        public int nap;
        public string ido;
        public string rendszam;
        public int az;
        public int km;
        public int beki;

        public adatok(int nap, string ido, string rendszam, int az, int km, int beki)
        {
            this.nap = nap;
            this.ido = ido;
            this.rendszam = rendszam;
            this.az = az;
            this.km = km;
            this.beki = beki;
        }
    }
}
