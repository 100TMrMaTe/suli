
using belepteto;

List<adatok> adatok = new List<adatok>();

string[] olvas = File.ReadAllLines("bedat.txt");

foreach (var x in olvas)
{
    string[] tomb = x.Split(" ");

    adatok.Add(new adatok(tomb[0], TimeOnly.Parse(tomb[1]), int.Parse(tomb[2])));
}
Console.WriteLine("2. feladat");
Console.WriteLine($"Az első tanuló {adatok.First().time}-kor lépett be a főkapun.");
Console.WriteLine($"Az utolsó tanuló {adatok.Last().time}-kor lépett ki a főkapun.");

var kesok = adatok.Where(x => x.time > TimeOnly.Parse("7:50") && x.time <= TimeOnly.Parse("8:15")).ToList();

StreamWriter ir = new StreamWriter("kesok.txt");

foreach(var x in kesok)
{
    ir.WriteLine($"{x.time} {x.id}");
}

ir.Close();

Console.WriteLine("4. feladat");
var menzasok = adatok.Where(x => x.kapu == 3).Count();
Console.WriteLine($"A menzán aznap {menzasok} tanuló ebédelt.");
Console.WriteLine("5. feladat");
var konyvtarosok = adatok.Where(x=> x.kapu == 4).Select(x => x.id).Distinct().Count();
Console.WriteLine($"Aznap {konyvtarosok} tanuló kölcsönzött a könyvtárban.");
if(konyvtarosok > menzasok)
{
    Console.WriteLine("Többen voltak, mint a menzán.");
}
else
{
    Console.WriteLine("Nem voltak többen, mint a menzán.");
}
Console.WriteLine("6. feladat");
Console.WriteLine("Az érintett tanulók:");
var ids = adatok.Select(x => x.id).Distinct().ToList();
string kiir = "";
foreach(var x in ids)
{
    var az = adatok.Where(y => y.id == x && (y.kapu == 1 || y.kapu == 2)).ToList();
    for(int i = 0;i<az.Count-1;i++)
    {
        if (az[i].kapu == az[i+1].kapu)
        {
            kiir += $"{az[i].id} ";
        }
    }

}
Console.WriteLine(kiir);
Console.WriteLine("7. feladat");
Console.Write("Egy tanuló azonosítója=");
string id = Console.ReadLine();
var tombje = adatok.Where(x=> x.id == id).ToList();
TimeSpan eltelt = tombje.Last().time - tombje.First().time;
string[] eltelt1 = Convert.ToString(eltelt).Split(":");
Console.WriteLine($"A tanuló érkezése és távozása között {Convert.ToInt32(eltelt1[0])} óra {Convert.ToInt32(eltelt1[1])} perc telt el.");