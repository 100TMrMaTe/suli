using belepteto;

List<adatok> adatok = new List<adatok>();

StreamReader sr = new StreamReader("bedat.txt");

while (!sr.EndOfStream)
{
    string line = sr.ReadLine();
    string[] tomb = line.Split(" ");

    adatok.Add(new adatok(tomb[0], tomb[1], int.Parse(tomb[2])));
}

sr.Close();

var elso = adatok.Where(x => x.hely == 1).ToArray();
string elso1 = elso[0].ido;
var utolso = adatok.Where(x => x.hely == 2).ToArray();
string utolso1 = utolso.Last().ido;

Console.WriteLine("2. feladat");
Console.WriteLine($"Az első tanuló {elso1}-kor lépett be a főkapun.");
Console.WriteLine($"Az utolsó tanuló {utolso1}-kor lépett ki a főkapun. ");

StreamWriter ir = new StreamWriter("kesok.txt");

int ends = 8 * 60 + 15;
int start = 7 * 60 + 50;
foreach (var x in adatok)
{
    string[] tomb = x.ido.Split(":");
    int ora = int.Parse(tomb[0]);
    int perc = int.Parse(tomb[1]);
    int ido = ora * 60 + perc;
    if (x.hely == 1 && ido >= start && ido <= ends)
    {
        ir.WriteLine(x.id + " " + x.ido);
    }
}

ir.Close();

Console.WriteLine("4. feladat");
var menza = adatok.Where(x => x.hely == 3).ToArray();
Console.WriteLine($"A menzán aznap {menza.Length} tanuló ebédelt. ");
Console.WriteLine("5. feladat");

var konyvtar = adatok.Where(x => x.hely == 4).Distinct().ToArray();
if (konyvtar.Length < menza.Length)
{
    Console.WriteLine("Többen voltak, mint a menzán");
}
else
{
    Console.WriteLine("Nem voltak többen, mint a menzán.");
}

string emberek = "";
Console.WriteLine("6. feladat");
foreach (var x in adatok)
{
    var emberbe = adatok.Where(y => (y.hely == 1) && y.id == x.id).ToArray();
    var emberki = adatok.Where(y => (y.hely == 2) && y.id == x.id).ToArray();
    var igaze = adatok.Where(y => y.ido.StartsWith("10:5") || y.ido== "11:00" && y.id == x.id).ToArray();
    if (emberbe.Length != 0 && igaze.Length != 0)
    {
        if (emberbe.Length != emberki.Length && igaze.Length != 0 && emberbe[0].ido != igaze[0].ido)
        {
            emberek += x.id + " ";
        }
    }
    
}

Console.WriteLine(emberek);

Console.WriteLine("7. feladat");
Console.Write("Egy tanuló azonosítója=");
string bekert = Console.ReadLine();

var belepesek = adatok.Where(x => x.hely == 1 && x.id == bekert).ToArray();
var tavozasok = adatok.Where(x => x.hely == 2 && x.id == bekert).ToArray();

if (belepesek.Length == 0)
{}
else
{
    string[] elsoido = belepesek[0].ido.Split(":");
    int belepesido = int.Parse(elsoido[0]) * 60 + int.Parse(elsoido[1]);
    
    string[] utolsoido = tavozasok.Last().ido.Split(":");
    int utolsobelepes = int.Parse(utolsoido[0]) * 60 + int.Parse(utolsoido[1]);

    int elteletidoperc = utolsobelepes - belepesido;
    int kiirora = elteletidoperc / 60;

    int kiirperc = elteletidoperc - kiirora * 60;
    Console.WriteLine($"A tanuló érkezése és távozása között {kiirora} óra {kiirperc} perc telt el");
}