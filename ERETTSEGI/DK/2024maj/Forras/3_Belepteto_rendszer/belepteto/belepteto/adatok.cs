using System;
using System.Collections.Generic;
using System.Text;

namespace belepteto
{
    internal class adatok
    {
        public string id;
        public TimeOnly time;
        public int kapu;

        public adatok(string id, TimeOnly time, int kapu)
        {
            this.id = id;
            this.time = time;
            this.kapu = kapu;
        }
    }
}
