using vizsga;

List<adatok> adatok = new List<adatok>();

string[] olvas = File.ReadAllLines("szerviz.txt");

foreach (var x in olvas)
{
    string[] tomb = x.Split("\t");

    adatok.Add(new adatok(tomb[0], tomb[1],tomb[2], tomb[3], tomb[4]));
}

Console.WriteLine("2.feladat:");
Console.WriteLine(adatok.Count());
Console.WriteLine("3.feladat:");

var egyszer = adatok.Select(x=> x.rendszam).Distinct().Count();
Console.WriteLine(egyszer);

Console.WriteLine("4.feladat:");

Console.Write("rendszam:");
string berendszam = Console.ReadLine();

var rendszamleker = adatok.Where(x=> x.rendszam == berendszam).ToList();

if(rendszamleker.Count == 0)
{
    Console.WriteLine("nincs ilyen rendszam");
}
else
{
    foreach(var x in rendszamleker)
    {
        Console.WriteLine(x.datum);
    }
}

Console.WriteLine("5.feladat:");

Dictionary<string,int> adatoks = new Dictionary<string,int>();

foreach (var x in adatok)
{
    if (adatoks.ContainsKey(x.rendszam))
    {
        adatoks[x.rendszam]++;
    }
    else
    {
        adatoks[x.rendszam] = 1;
    }
}


var kiir = adatoks.OrderByDescending(x=> x.Value).ToList();

foreach(var x in kiir)
{
    if(x.Value == kiir.First().Value)
    {
        Console.WriteLine(x.Key);
    }
}
Console.WriteLine("6.feladat:");

var utolso = adatok.OrderBy(x => x.datum).ToList();
var utolso1 = utolso.OrderBy(x => x.rendszam).ToList();

for (int i = 0; i < utolso1.Count-1; i++)
{
    if (utolso1[i].rendszam == utolso1[i+1].rendszam && utolso1[i].tulaj != utolso1[i + 1].tulaj)
    {
        Console.WriteLine(utolso1[i].rendszam);
    }
}

Console.WriteLine("7.feladat");

var szemelyek = adatok.Select(x => x.tulaj).Distinct().ToList();
StreamWriter ir = new StreamWriter("fajl.txt");

foreach (var x in szemelyek)
{
    var autoi = adatok.Where(y=> y.tulaj == x).Select(y => y.rendszam).Distinct().ToList();

    string kiir1 = x+":";
    foreach (var y in autoi)
    {
        kiir1 += " " + y;
    }
    ir.WriteLine(kiir1);
}


ir.Close();

Console.WriteLine("8.feladat:");

var rendszamok = adatok.Select(x => x.rendszam).Distinct().ToList();
int count = 0;
string rendszam = "";

foreach (var x in rendszamok)
{
    var emberek = adatok.Where(y=> y.rendszam == x).Select(x=> x.tulaj).Distinct().Count();

    if(emberek  > count)
    {
        count = emberek;
        rendszam = x;
    }
}

Console.WriteLine(rendszam+": "+count+" tulaja volt.");

Console.WriteLine("9.feladat");
var ev3elott = adatok.Where(x => (DateTime.Parse(x.datum) - DateTime.Parse(x.uzembe)).TotalDays < 365 * 3).OrderBy(x=> x.rendszam).Select(y => y.rendszam).Distinct().ToList();

foreach (var x in ev3elott)
{
    Console.WriteLine(x);
}