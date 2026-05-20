using autok;

List<adatok> adatok = new List<adatok>();

string[] olvas = File.ReadAllText("jeladas.txt").Split(" ");


for(int i = 0; i < olvas.Length-3; i+=4)
{
    adatok.Add(new adatok(olvas[i], int.Parse(olvas[i + 1]), int.Parse(olvas[i + 2]), int.Parse(olvas[i + 3]), int.Parse(olvas[i + 1]) * 60 + int.Parse(olvas[i + 2])));
}
Console.WriteLine("2. feladat:");
Console.WriteLine($"AZ utolsó jeladás időpontja {adatok.Last().ora}:{adatok.Last().perc}, a jármű rendszáma {adatok.Last().rendszam}");
Console.WriteLine("3. feladat:");
Console.WriteLine($"Az első jármű: {adatok.First().rendszam}");

var elsojarmu = adatok.Where(x=> x.rendszam == adatok.First().rendszam).ToList();
string kiir = "Jeladásainak időpontja:";
foreach(var x in elsojarmu)
{
    kiir += $" {x.ora}:{x.perc}";
}
Console.WriteLine(kiir);
Console.WriteLine("4. feladat:");

Console.Write("Kérem, adja meg az órát: ");
int beora = int.Parse(Console.ReadLine());
Console.Write("Kérem, adja meg az percet: ");
int beperc = int.Parse(Console.ReadLine());

var jeladasok = adatok.Where(x=> x.ora == beora && x.perc == beperc).ToList();
if(jeladasok.Count > 0)
{
    Console.WriteLine($"A jeladások száma: {jeladasok.Count}");
}
else
{
    Console.WriteLine("A jeladások száma: 0");
}
Console.WriteLine("5. feladat:");

Console.WriteLine($"A legnagyobb sebesség km/h: {adatok.Max(x=> x.km)}");

var leggyorsabbak = adatok.Where(x => x.km == adatok.Max(x => x.km)).ToList();

string kiir1 = "A járművek:";
foreach (var x in leggyorsabbak)
{
    kiir1 += $" {x.rendszam}";
}
Console.WriteLine(kiir1);
Console.WriteLine("6. feladat:");
Console.Write("Kérem, adja meg a rendszámot: ");
string berendszam = Console.ReadLine();
var jelad = adatok.Where(x=> x.rendszam == berendszam).ToList();

Console.WriteLine($"{jelad.First().ora}:{jelad.First().perc} 0.0 km");
double eddigmegtettut = 0.0;
for(int i = 0; i < jelad.Count-1; i++)
{
    int elteltido = jelad[i + 1].percben - jelad[i].percben;
    double km = (Convert.ToDouble(elteltido) / 60) * jelad[i].km;
    Console.WriteLine($"{jelad[i + 1].ora}:{jelad[i + 1].perc} {(km + eddigmegtettut).ToString("n1")} km");
    eddigmegtettut += km;
}
