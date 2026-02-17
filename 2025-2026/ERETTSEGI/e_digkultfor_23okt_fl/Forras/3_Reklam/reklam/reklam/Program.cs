using System.Runtime.InteropServices.JavaScript;
using reklam;

List<adatok> adatok = new List<adatok>();

StreamReader sr = new StreamReader("rendel.txt");

while (!sr.EndOfStream)
{
    string line = sr.ReadLine();
    string[] split = line.Split(' ');
    
    adatok.Add(new adatok(int.Parse(split[0]), split[1],int.Parse(split[2])));
}

sr.Close();
Console.WriteLine("2. feladat:");
Console.WriteLine("A rendelések száma: "+adatok.Count);
Console.WriteLine("3. feladat:");
Console.Write("Kérem, adjon meg egy napot: ");

int szam =int.Parse(Console.ReadLine());

var valasz4 = adatok.Where(x=> x.nap == szam).Count();
Console.WriteLine("A rendelések száma az adott napon: "+valasz4);
Console.WriteLine("4. feladat: ");

var napokszama = adatok.Where(x=> x.reklam == "NR").Select(y => y.nap).Distinct().Count();
Console.WriteLine((30-napokszama)+" nap nem volt a reklámban nem érintett városból rendelés");
Console.WriteLine("5. feladat: ");

int a = adatok.Max(x=> x.db);
var nap = adatok.Where(x => x.db == a).ToArray();
Console.WriteLine($"A legnagyobb darabszám: {a}, a rendelés napja: {nap.First().nap}");
Console.WriteLine("7. feladat: ");

static int osszes(string varos,int benap, List<adatok> adatok)
{
    var tomb = adatok.Where(x=> x.nap == benap && varos == x.reklam).Sum(x=> x.db);
    return tomb;
}

static int osszes1(string varos,int benap, List<adatok> adatok)
{
    var tomb1 = adatok.Where(x=> x.nap == benap && varos == x.reklam).Count();
    return tomb1;
}

int pl = osszes("PL",21,adatok);
int nr = osszes("NR",21,adatok);
int tv = osszes("TV",21,adatok);
Console.WriteLine($"A rendelt termékek darabszáma a 21. napon PL: {pl} TV: {tv} NR: {nr}");

Console.WriteLine("8. feladat:");

int pl1 = 0;
int pl2 = 0;
int pl3 = 0;
int nr1 = 0;
int nr2 = 0;
int nr3 = 0;
int tv1 = 0;
int tv2 = 0;
int tv3 = 0;

for (int i = 1; i < 11; i++)
{
    pl1 += osszes1("PL",i,adatok);
    nr1 += osszes1("NR",i,adatok);
    tv1 += osszes1("TV",i,adatok);
}

for (int i = 11; i < 21; i++)
{
    pl2 += osszes1("PL",i,adatok);
    nr2 += osszes1("NR",i,adatok);
    tv2 += osszes1("TV",i,adatok);
}

for (int i = 21; i < 31; i++)
{
    pl3 += osszes1("PL",i,adatok);
    nr3 += osszes1("NR",i,adatok);
    tv3 += osszes1("TV",i,adatok);
}

Console.WriteLine("Napok\t1..10\t11..20\t21..30 ");
Console.WriteLine($"PL\t{pl1}\t{pl2}\t{pl3}");
Console.WriteLine($"TV\t{tv1}\t{tv2}\t{tv3}");
Console.WriteLine($"NR\t{nr1}\t{nr2}\t{nr3}");

StreamWriter ir = new StreamWriter("kampany.txt");

ir.WriteLine("Napok\t1..10\t11..20\t21..30 ");
ir.WriteLine($"PL\t{pl1}\t{pl2}\t{pl3}");
ir.WriteLine($"TV\t{tv1}\t{tv2}\t{tv3}");
ir.WriteLine($"NR\t{nr1}\t{nr2}\t{nr3}");

ir.Close();

//Console.WriteLine("7. feladat:");