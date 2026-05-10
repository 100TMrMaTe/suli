using konyvek;

List<adatok> adatoks = new List<adatok>();

string[] olvas = File.ReadAllLines("kiadas.txt");


foreach (var line in olvas)
{
    string[] tomb = line.Split(';');

    adatoks.Add(new adatok(int.Parse(tomb[0]), int.Parse(tomb[1]), tomb[2], tomb[3], int.Parse(tomb[4])));
}

Console.WriteLine("2. feladat:");
Console.Write("Szerző: ");
string beszerzo = Console.ReadLine();

var count = adatoks.Where(x=> x.konyv.Contains(beszerzo)).Count();

if(count != 0 && count != adatoks.Count)
{
    Console.WriteLine($"{count} könyvkiadás");
}
else
{
    Console.WriteLine("nem adtak ki.");
}

Console.WriteLine("3. feladat:");
int max = adatoks.Max(x=> x.peldanyszam);

int count1 = adatoks.Where(x => x.peldanyszam == max).Count();

Console.WriteLine($"Legnagyobb példányszám: {max}, előfordult {count1} alkalommal");
Console.WriteLine("4. feladat:");


foreach(var x in adatoks)
{
    if(x.peldanyszam >=40000 && x.orszag == "kf")
    {
        Console.WriteLine($"{x.ev}/{x.negyedev}. {x.konyv}");
        break;
    }
}

Console.WriteLine("6. feladat:");


var konyvek = adatoks.Select(x=>x.konyv).Distinct().ToList();
List<string> list = new List<string>();

foreach(var x in konyvek)
{
    var kadatok = adatoks.Where(y => y.konyv == x).ToList();

    int nagyobb = 0;
    int elsokiad = kadatok[0].peldanyszam;

    foreach (var c in kadatok)
    {
        if (c.peldanyszam > elsokiad)
        {
            nagyobb++;
        }
    }
    if(nagyobb >= 2)
    {
        list.Add(x);
    }
}

foreach(var x in list) { Console.WriteLine(x); }