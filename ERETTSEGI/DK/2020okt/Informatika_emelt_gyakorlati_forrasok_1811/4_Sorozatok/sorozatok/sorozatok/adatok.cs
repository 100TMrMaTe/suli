using System;
using System.Collections.Generic;
using System.Text;

namespace sorozatok
{
    internal class adatok
    {
        public string date;
        public string name;
        public string epizod;
        public int hossz;
        public int megnezve;

        public adatok(string date, string name, string epizod, int hossz, int megnezve)
        {
            this.date = date;
            this.name = name;
            this.epizod = epizod;
            this.hossz = hossz;
            this.megnezve = megnezve;
        }
    }
}
