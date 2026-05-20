using System;
using System.Collections.Generic;
using System.Text;

namespace vizsgawpf2
{
    class adatok
    {
        public int nap;
        public string ido;
        public string rendszam;
        public int az;
        public int km;
        public int kibe;

        public adatok(int nap,string ido,string rendszam,int az,int km,int kibe)
        {
            this.nap = nap;
            this.ido = ido;
            this.rendszam = rendszam;
            this.az = az;
            this.km = km;
            this.kibe = kibe;
        }
    }
}
