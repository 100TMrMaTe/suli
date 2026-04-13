using autok;

List<adatok> adatok = new List<adatok>();

string[] olvas = File.ReadAllLines("jeladas.txt");

foreach (var line in olvas)
{
    string[] tomb = line.Split('\t');
    adatok.Add(new adatok(tomb[0], int.Parse(tomb[1]), int.Parse(tomb[2]), int.Parse(tomb[3])));
}
Console.WriteLine("2. feladat:");
Console.WriteLine($"Az utolsó jeladás időpontja {adatok.Last().ora}:{adatok.Last().perc}, a jármű rendszáma {adatok.Last().rendszam}");
Console.WriteLine("3. feladat:");
Console.WriteLine("Az első jármű: "+ adatok.First().rendszam);

var jeladasok = adatok.Where(x => x.rendszam == adatok.First().rendszam).ToList();
string kiir = "";
foreach(var s in jeladasok)
{
    kiir += " " + s.ora + ":" + s.perc;
}
Console.WriteLine("Jeladásainak időpontjai:"+kiir);

Console.WriteLine("4. feladat:");
Console.Write("Kérem, adja meg az órát:");
string beora = Console.ReadLine();
Console.Write("Kérem, adja meg az percet:");
string beperc = Console.ReadLine();

var mennyi = adatok.Where(x=> x.ora ==int.Parse(beora) && x.perc == int.Parse(beperc)).Count();
Console.WriteLine("A jeladások száma: "+mennyi);

Console.WriteLine("5. feladat:");
int maxseb = adatok.Max(x => x.sebesseg);
Console.WriteLine("A legnagyobb sebesség km/h: "+maxseb);

var maxsebrendszam = adatok.Where(x=> x.sebesseg == maxseb);
kiir = "";
foreach(var s in maxsebrendszam)
{
    kiir += " " + s.rendszam;
}
Console.WriteLine("A járművek:"+kiir);

Console.WriteLine("6. feladat:");

double km = 0.0;

Console.Write("Kérem adja meg a rendszámot: ");
string rendszambe = Console.ReadLine();

var jelzesei = adatok
    .Where(x => x.rendszam == rendszambe)
    .ToList();


Console.WriteLine($"{jelzesei.First().ora}:{jelzesei.First().perc} 0.0 km");

for (int i = 0; i < jelzesei.Count - 1; i++)
{
    double ora = jelzesei[i].ora + (jelzesei[i].perc / 60.0);
    double ora1 = jelzesei[i + 1].ora + (jelzesei[i + 1].perc / 60.0);

    double elteltido = ora1 - ora;

    double megtettut = jelzesei[i].sebesseg * elteltido + km;
    km = megtettut;

    Console.WriteLine($"{jelzesei[i + 1].ora}:{jelzesei[i + 1].perc} {megtettut:F2} km");
}