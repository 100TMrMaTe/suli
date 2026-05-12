using cegesauto;

List<adatok> adatok = new List<adatok>();

string[] olvas = File.ReadAllLines("autok.txt");

foreach (var line in olvas)
{
    string[] tomb = line.Split(" ");
    adatok.Add(new adatok(int.Parse(tomb[0]), tomb[1], tomb[2], int.Parse(tomb[3]),int.Parse(tomb[4]),int.Parse(tomb[5])));
}

var utolso = adatok.Where(x=> x.beki ==0).ToList();

Console.WriteLine("2. feladat");
Console.WriteLine($"{utolso.Last().nap}. nap rendszám: {utolso.Last().rendszam}");
Console.WriteLine("3. feladat");

Console.Write("Nap: ");
int nap = Convert.ToInt32(Console.ReadLine());
var aznap = adatok.Where(x => x.nap == nap).ToList();

foreach (var a in aznap)
{
    if(a.beki == 0)
    {
        Console.WriteLine($"{a.ido} {a.rendszam} {a.az} ki");
    }
    else
    {
        Console.WriteLine($"{a.ido} {a.rendszam} {a.az} be");
    }
}
Console.WriteLine("4. feladat");

var autok = adatok.Select(x=> x.rendszam).Distinct().ToList();
int nincsbent = 0;
foreach (var a in autok)
{
    var auto = adatok.Where(x=> x.rendszam == a).ToList();
    if (auto.Last().beki == 0)
    {
        nincsbent++;
    }
}
Console.WriteLine($"A honap végén {nincsbent} autót nem hoztak vissza.");
Console.WriteLine("5. feladat");

foreach (var a in autok)
{
    var auto = adatok.Where(x => x.rendszam == a).ToList();
    Console.WriteLine($"{a} {auto.Last().km - auto.First().km} km");
}
Console.WriteLine("6. feladat");

int leghosszab =  0;
int az =  0;
foreach (var a in autok)
{
    var auto = adatok.Where(x => x.rendszam == a).ToList();
    for(int i = 0;i< auto.Count-1;i++)
    {
        if(auto[i+1].km - auto[i].km  >leghosszab)
        {
            leghosszab = auto[i + 1].km - auto[i].km;
            az = auto[i].az;
        }
    }
}
Console.WriteLine($"Leghosszabb út: {leghosszab} km, személy: {az}");
Console.WriteLine("7. feladat");
Console.Write("Rendszám: ");
string rendszambe = Console.ReadLine();

var auto1 = adatok.Where(x=> x.rendszam == rendszambe).ToList();

StreamWriter ir = new StreamWriter(rendszambe+"_menetlevel.txt");

if(auto1.Count % 2 == 0)
{
    for (int i = 0; i < auto1.Count - 1; i += 2)
    {
        ir.WriteLine($"{auto1[i].az}\t{auto1[i].nap}. {auto1[i].ido}\t{auto1[i].km} km\t{auto1[i + 1].nap}. {auto1[i + 1].ido}\t{auto1[i + 1].km} km");
    }
}
else
{
    for (int i = 0; i < auto1.Count - 1; i += 2)
    {
        ir.WriteLine($"{auto1[i].az}\t{auto1[i].nap}. {auto1[i].ido}\t{auto1[i].km} km\t{auto1[i + 1].nap}. {auto1[i + 1].ido}\t{auto1[i + 1].km} km");
    }
    ir.WriteLine($"{auto1.Last().az}\t{auto1.Last().nap}. {auto1.Last().ido}\t{auto1.Last().km} km");
}
ir.Close();
Console.WriteLine("Menetlevél kész.");
