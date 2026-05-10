using System;
using System.Collections.Generic;
using System.Text;

namespace konyvek
{
    internal class adatok
    {
        public int ev;
        public int negyedev;
        public string orszag;
        public string konyv;
        public int peldanyszam;

        public adatok(int ev, int negyedev, string orszag, string konyv, int peldanyszam)
        {
            this.ev = ev;
            this.negyedev = negyedev;
            this.orszag = orszag;
            this.konyv = konyv;
            this.peldanyszam = peldanyszam;
        }
    }
}
