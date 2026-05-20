using sebesseg;

List<adatok> adatok = new List<adatok>();

string[] olvas = File.ReadAllLines("ut.txt");

int teljeshossz  = int.Parse(olvas[0].Trim());

foreach (string line in olvas.Skip(1))
{
    string[] tomb = line.Split(" ");
    adatok.Add(new adatok(int.Parse(tomb[0]), tomb[1]));
}
Console.WriteLine("2. feladat");
foreach(var x in adatok)
{
    if(x.jel.StartsWith("Varos"))
    {
        Console.WriteLine(x.jel);
    }
}

Console.WriteLine();
Console.WriteLine("3. feladat");
Console.Write("Adja meg a vizsgált szakasz hosszát km-ben! ");
string beker = Console.ReadLine();

int sebesseghatar = 90;
var adat1 = adatok.Where(x=> x.km <= double.Parse(beker)*1000).ToList();

foreach(var x in adat1)
{
    int jel = 90;
    if(x.jel.StartsWith("Varos"))
    {
        jel = 50;
    }
    else if(x.jel.EndsWith("0"))
    {
        jel = int.Parse(x.jel);
    }

    if(jel <  sebesseghatar)
    {
        sebesseghatar = jel;
    }
}
Console.WriteLine($"AZ első {beker} km-en {sebesseghatar} km/h volt a legalacsonyabb megengedett sebesség.");
Console.WriteLine();
Console.WriteLine("4. feladat");

var varosok = adatok.Where(x => x.jel.StartsWith("Varos") || x.jel == "]").ToList();

double telepules = 0;
for(int i = 0; i < varosok.Count-1; i+=2)
{
    telepules += varosok[i + 1].km - varosok[i].km;
}

double teljeshossz1 = Convert.ToDouble(teljeshossz);

double kiir = telepules / teljeshossz1 * 100;

Console.WriteLine($"Az út {kiir.ToString("n2")} százaléka vezet településen belül.");
Console.WriteLine();
Console.WriteLine("5. feladat");
Console.Write("Adja meg egy település nevét! ");
string varosbe =Convert.ToString(Console.ReadLine());

var kezdokm = adatok.Where(x=> x.jel == varosbe).ToList();
var vegkmtomb = adatok.Where(x => x.km > Convert.ToInt32(kezdokm.First().km) && x.jel == "]").Select(x => x.km).ToList();
int vegkm = vegkmtomb.First();

var varosonbelul = adatok.Where(x => x.km > Convert.ToInt32(kezdokm.First().km) && x.km<vegkm && int.TryParse(x.jel,out _)).Count();
Console.WriteLine($"A sebesességkorlátozó táblák száma: {varosonbelul}");
Console.WriteLine($"Az út hossza a településen belül {vegkm- Convert.ToInt32(kezdokm.First().km)} mélter");

