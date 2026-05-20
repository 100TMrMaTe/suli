using System;
using System.Collections.Generic;
using System.Text;

namespace vizsgawpf1
{
    class adatok
    {
        public int nap;
        public TimeOnly ido;
        public string rendszam;
        public int az;
        public int km;
        public int beki;

        public adatok(int nap, TimeOnly ido, string rendszam, int az, int km, int beki)
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
