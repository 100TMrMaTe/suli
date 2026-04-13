using System.Globalization;
using utemez;

List<adatok> adatok = new List<adatok>();

StreamReader sr = new StreamReader("taborok.txt");

while (!sr.EndOfStream)
{
    string line = sr.ReadLine();
    string[] tomb = line.Split("\t");
    adatok.Add(new adatok(int.Parse(tomb[0]), int.Parse(tomb[1]), int.Parse(tomb[2]), int.Parse(tomb[3]), tomb[4],
        tomb[5]));
}
sr.Close();

Console.WriteLine("2. feladat ");
Console.WriteLine("Az adatsorok száma: "+adatok.Count);
Console.WriteLine("Az először rögzített tábor témája: "+adatok.First().tabor);
Console.WriteLine("Az utoljára rögzített tábor témája: "+adatok.Last().tabor);
Console.WriteLine("3. feladat");

var zenei = adatok.Where(x=> x.tabor == "zenei");

if (zenei.Count() == 0)
{
    Console.WriteLine("Nem volt zenei tábor.");
}
else
{
    foreach (var x in zenei)
    {
        Console.WriteLine($"Zenei tábor kezdődik {x.kezdho}. hó {x.kezdonap}. napján.");
    }
}

Console.WriteLine("4. feladat");
int lenght = 0;

foreach (var x in adatok)
{
    if (x.id.Length > lenght)
    {
        lenght = x.id.Length;
    }
}

var legtobb = adatok.Where(x=> x.id.Length == lenght).ToArray();

foreach (var x in legtobb)
{
    Console.WriteLine(x.kezdho+" "+x.kezdonap+" "+x.tabor);
}



static int sorszam(int honap,int nap)
{
    int osszes = 0;
    if (honap == 6)
    {
        osszes = nap - 16;
    }
    else if (honap == 7)
    {
        osszes = nap + (30 - 16);
    }
    else if (honap == 8)
    {
        osszes = nap + 31 + (30 - 16);
    }
    return osszes;
}

Console.WriteLine("6. feladat ");

Console.Write("hó: ");
int honap = Convert.ToInt32(Console.ReadLine());
Console.Write("nap: ");
int nap = Convert.ToInt32(Console.ReadLine());


int osszesen = 0;
for (int i = 0; i < adatok.Count; i++)
{
    int keresett = sorszam(honap, nap);
    int kezdes = sorszam(adatok[i].kezdho, adatok[i].kezdonap);
    int vege = sorszam(adatok[i].vegho, adatok[i].vegnap);
    if (keresett >= kezdes && keresett <= vege)
    {
        osszesen++;
    }
}

Console.WriteLine($"Ekkor éppen {osszesen} tábor tart.");
Console.WriteLine("7. feladat ");

Console.Write("Adja meg egy tanuló betűjelét: ");
string azonosito =  Console.ReadLine();

var taborok1 = adatok.Where(x=> x.id.Contains(azonosito)).OrderBy(x => x.kezdonap).ToArray();
var taborok = taborok1.OrderBy(x=> x.kezdho).ToArray();
StreamWriter ir = new StreamWriter("egytanulo.txt");

foreach (var x in taborok)
{
    ir.WriteLine($"{x.kezdho}.{x.kezdonap}-{x.vegho}.{x.vegnap}. {x.tabor}");
}

ir.Close();

for (int i = 0; i < taborok.Length-1; i++)
{
    if (sorszam(taborok[i].vegho, adatok[i].vegnap) >= sorszam(taborok[i + 1].kezdho, adatok[i + 1].kezdonap))
    {
        Console.WriteLine("Nem mehet el mindegyik táborba.");
        break;
    }
    else
    {

    }
}
