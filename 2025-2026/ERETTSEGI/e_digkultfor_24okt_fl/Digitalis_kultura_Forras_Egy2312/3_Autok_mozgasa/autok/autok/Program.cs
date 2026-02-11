using autok;

List<adatok> adatok = new List<adatok>();

StreamReader sr = new StreamReader("jeladas.txt");

while (!sr.EndOfStream)
{
    string line = sr.ReadLine();
    string[] tomb = line.Split("\t");
    adatok.Add(new adatok(tomb[0], int.Parse(tomb[1]), int.Parse(tomb[2]), int.Parse(tomb[3])));
}

sr.Close();

Console.WriteLine("2. feladat:");
Console.WriteLine(
    $"Az utolsó jeladás időpontja {adatok[adatok.Count - 1].ora}:{adatok[adatok.Count - 1].perc}, a jármű rendszáma {adatok[adatok.Count - 1].rendszam}");
Console.WriteLine("3. feladat:");

string elsoauto = adatok[0].rendszam;

string idok = "Jeladásainak időpontjai: ";

foreach (var x in adatok)
{
    if (x.rendszam == elsoauto)
    {
        idok += ($"{x.ora}:{x.perc} ");
    }
}

Console.WriteLine(idok);

Console.WriteLine("4. feladat:");


Console.Write("Kérem, adja meg az órát: ");
int ora = int.Parse(Console.ReadLine());

Console.Write("Kérem, adja meg a percet: ");
int perc = int.Parse(Console.ReadLine());

int count = adatok.Where(x => x.ora == ora && x.perc == perc).Count();
Console.WriteLine($"A jeladások száma: {count} ");

Console.WriteLine("5. feladat:");

int maxseb = adatok.Max(x => x.sebesseg);
Console.WriteLine($"A legnagyobb sebesség km/h: {maxseb} ");

string kiir = "A járművek: ";

foreach (var x in adatok)
{
    if (x.sebesseg == maxseb)
    {
        kiir += x.rendszam + " ";
    }
}

Console.WriteLine(kiir);

Console.WriteLine("6. feladat:");

Console.Write("Kérem, adja meg a rendszámot: ");

string rendszam = Console.ReadLine();

var tombrend = adatok.Where(x => x.rendszam == rendszam).ToList();

if (tombrend.Count == 0)
{
    Console.WriteLine("Nincs ilyen rendszámú jármű!");
}
else
{
    Console.WriteLine(tombrend[0].ora + ":" + tombrend[0].perc + " 0.0 km");
    double osszkm = 0;
    for (int i = 0; i < tombrend.Count - 1; i++)
    {
        int elotteido = tombrend[i].ora * 60 + tombrend[i].perc;
        int utanaido = tombrend[i + 1].ora * 60 + tombrend[i + 1].perc;
        int ido = utanaido - elotteido;
        double osztas = ido / 60.0;
        double km = osztas * tombrend[i].sebesseg;
        osszkm += km;
        Console.WriteLine(tombrend[i + 1].ora + ":" + tombrend[i + 1].perc + " " + osszkm.ToString("0.0") + " km");
    }
}

var rendszamok = adatok.Select(x => x.rendszam).Distinct().ToList();

StreamWriter ir = new StreamWriter("ido.txt");

foreach (var x in rendszamok)
{
    var adottAuto = adatok.Where(a => a.rendszam == x).ToArray();

    int elsoOra = adottAuto.First().ora;
    int elsoPerc = adottAuto.First().perc;

    int utolsoOra = adottAuto.Last().ora;
    int utolsoPerc = adottAuto.Last().perc;

    ir.WriteLine($"{x} {elsoOra} {elsoPerc} {utolsoOra} {utolsoPerc}");
}

ir.Close();