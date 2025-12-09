
using System.Globalization;
using sebesseg;

List<adatok> lista = new List<adatok>();

string[] sorok = File.ReadAllLines("ut.txt");

int teljes = int.Parse(sorok[0].Trim());

for (int i = 1; i < sorok.Length; i++)
{
    string tiszta = sorok[i].Trim();
    string[] elemek = tiszta.Split(' ');

    lista.Add(new adatok(Convert.ToInt32(elemek[0]),elemek[1]));
}

Console.WriteLine("2. feladat\r\nA települések neve:");
var varosok = lista.Where(x => x.jel.StartsWith("Varos")).ToList();

foreach (var v in varosok)
{
    Console.WriteLine(v.jel);
}


Console.WriteLine("3. feladat");
Console.Write("Adja meg a vizsgált szakasz hosszát km-ben! ");
double kilometer = double.Parse(Console.ReadLine(), CultureInfo.InvariantCulture);

List<int> korlatozasok = new List<int>();

korlatozasok.Add(90);
foreach (var esemeny in lista)
{
    string jel = esemeny.jel;
    int tav = esemeny.meter;
    if (tav <= kilometer * 1000)
    {
        if (jel.StartsWith("Varos"))
        {
            korlatozasok.Add(50);
        }
        else if (jel.EndsWith("0"))
        {
            korlatozasok.Add(int.Parse(jel));
        }
        else if (jel == "]")
        {
            korlatozasok.Add(90);
        }
    }
}

Console.WriteLine($"Az elso {kilometer} km-en {korlatozasok.Min()} km/h volt a legalacsonyabb megengedett sebesség.");


Console.WriteLine("4. feladat");

int belulHossz = 0;
int varosKezdoPont = 0;
bool varosbanVagyunk = false;

foreach (var esemeny in lista)
{
    string jel = esemeny.jel;
    int tav = esemeny.meter;

    if (jel.StartsWith("Varos"))
    {
        varosKezdoPont = tav;
        varosbanVagyunk = true;
    }
    else if (jel == "]")
    {
        if (varosbanVagyunk)
        {
            belulHossz += tav - varosKezdoPont;
            varosbanVagyunk = false;
        }
    }
}


double szazalek = (double)belulHossz / teljes * 100;
Console.WriteLine($"Az út {szazalek:F2} százaléka vezet településen belül.");



Console.WriteLine("5.feladat ");
Console.Write("Adja meg egy település nevét! ");
string varos = Console.ReadLine();

string varosban = "false";
int varosmeter = 0;
int teljeshossz = 0;
int jelzotablakszama= 0;

foreach (var esemeny in lista)
{
    string jel = esemeny.jel;
    int tav = esemeny.meter;
    if (jel == varos)
    {
        varosban = "true";
        varosmeter = tav;
    }
    else if (jel == "]" && varosban == "true")
    {
        teljeshossz = tav - varosmeter;
        break;
    }
    else if (varosban == "true" && int.TryParse(jel, out int korlat))
    {
        jelzotablakszama++;
    }
}

Console.WriteLine("Az út hossza a településen belül "+teljeshossz);
Console.WriteLine("A sebességkorlátozó táblák száma:"+jelzotablakszama);


Console.WriteLine("6. feladat");

var telepulesek = new List<(string nev, int kezdo, int vege)>();
bool varosban1 = false;
string aktVaros = "";
int varosKezdo = 0;

foreach (var adat in lista)
{
    if (adat.jel.StartsWith("Varos"))
    {
        varosban1 = true;
        aktVaros = adat.jel;
        varosKezdo = adat.meter;
    }
    else if (adat.jel == "]" && varosban1)
    {
        telepulesek.Add((aktVaros, varosKezdo, adat.meter));
        varosban1 = false;
    }
}

int varosIndex = -1;
for (int i = 0; i < telepulesek.Count; i++)
{
    if (telepulesek[i].nev == varos)
    {
        varosIndex = i;
        break;
    }
}

string kozeliVaros = "";

if (varosIndex >= 0)
{
    int balTav = int.MaxValue;
    if (varosIndex > 0)
    {
        balTav = telepulesek[varosIndex].kezdo - telepulesek[varosIndex - 1].vege;
    }

    int jobbTav = int.MaxValue;
    if (varosIndex < telepulesek.Count - 1)
    {
        jobbTav = telepulesek[varosIndex + 1].kezdo - telepulesek[varosIndex].vege;
    }

    if (balTav < jobbTav)
    {
        kozeliVaros = telepulesek[varosIndex - 1].nev;
    }
    else if (jobbTav < balTav)
    {
        kozeliVaros = telepulesek[varosIndex + 1].nev;
    }
    else
    {
        if (balTav != int.MaxValue)
        {
            kozeliVaros = telepulesek[varosIndex - 1].nev;
        }
        else if (jobbTav != int.MaxValue)
        {
            kozeliVaros = telepulesek[varosIndex + 1].nev;
        }
    }
}

Console.WriteLine($"A legközelebbi település: {kozeliVaros}");