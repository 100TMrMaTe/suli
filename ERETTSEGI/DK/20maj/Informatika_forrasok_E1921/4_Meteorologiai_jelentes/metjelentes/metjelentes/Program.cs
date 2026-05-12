using metjelentes;

List<adatok> adatoks = new List<adatok>();

string[] olvas = File.ReadAllLines("tavirathu13.txt");

foreach (var line in olvas)
{
    string[] tomb = line.Split(" ");

    string ora = tomb[1].Substring(0,2);
    string perc = tomb[1].Substring(2);
    string irany = tomb[2].Substring(0,3);
    string ero = tomb[2].Substring(3);
    adatoks.Add(new adatok(tomb[0], ora, perc, irany, int.Parse(ero), int.Parse(tomb[3])));
}


var order = adatoks.OrderBy(x=>int.Parse(x.perc)).ThenBy(x=> int.Parse(x.ora));

Console.WriteLine("2. feladat");
Console.Write("Adja meg egy település kódját! Település: ");
string varos = Console.ReadLine();

var utolsomeres = order.Where(x=> x.varos ==  varos);
if(utolsomeres.Any())
{
    Console.WriteLine($"Az utolsó mérési adat a megadott teleülésről {utolsomeres.Last().ora}:{utolsomeres.Last().perc}-kor érkezett.");
}


Console.WriteLine("3. feladat");

var min = adatoks.Min(x => x.homerseklet);
var max = adatoks.Max(x => x.homerseklet);
var kiir1 = adatoks.Where(x=> x.homerseklet == min);
var kiir2 = adatoks.Where(x => x.homerseklet == max);

Console.WriteLine($"A legalacsonyabb hőmérséklet: {kiir1.First().varos} {kiir1.First().ora}:{kiir1.First().perc} {kiir1.First().homerseklet} fok");
Console.WriteLine($"A legmagasabb hőmérséklet: {kiir2.First().varos} {kiir2.First().ora}:{kiir2.First().perc} {kiir2.First().homerseklet} fok");

Console.WriteLine("4. feladat");
var nulla = adatoks.Where(x => x.irany == "000" && x.erosseg == 00).ToList();

if(nulla.Count == 0)
{
    Console.WriteLine("Nem volt szélcsend a mérések idején.");
}
else
{
    foreach(var x in  nulla)
    {  Console.WriteLine($"{x.varos} {x.ora}:{x.perc}"); }
}

Console.WriteLine("5. feladat");
var varosok = adatoks.Select(x => x.varos).Distinct().ToList();

foreach(var x in varosok)
{
    var min1 = adatoks.Where(y=> y.varos == x).Min(x => x.homerseklet);
    var max1 = adatoks.Where(y => y.varos == x).Max(x => x.homerseklet);
    var elso = adatoks.Where(y => y.varos == x && y.ora == "01").Count();
    var het = adatoks.Where(y => y.varos == x && y.ora == "07").Count();
    var tizenharom = adatoks.Where(y => y.varos == x && y.ora == "13").Count();
    var tizenkilenc = adatoks.Where(y => y.varos == x && y.ora == "19").Count();
    if(elso == 0 ||  het == 0||tizenharom == 0|| tizenkilenc == 0)
    {
        Console.WriteLine($"{x} NA; Hőmérséklet-ingadozás: {max1-min1}");
    }
    else
    {
        var avg = adatoks.Where(y => y.varos == x && (y.ora == "07" || y.ora == "01" || y.ora == "13" || y.ora == "19")).Average(x => x.homerseklet);
        Console.WriteLine($"{x} Középhőmérséklet: {avg.ToString("0")}; Hőmérséklet-ingadozás: {max1 - min1}");
    }
}
Console.WriteLine("6. feladat");

foreach(var x in varosok)
{
    StreamWriter ir = new StreamWriter(x+".txt");
    ir.WriteLine(x);
    var varosadat = order.Where(y => y.varos == x).ToList();
    foreach(var y in varosadat)
    {
        string szoveg = "";
        for(int i = 0;i< Convert.ToInt32(y.erosseg);i++)
        {
            szoveg += "#";
        }
        ir.WriteLine($"{y.ora}:{y.perc} {szoveg}");
    }








    ir.Close();
}
Console.WriteLine("A fájlok elkészültek.");