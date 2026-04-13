using konyvek;

List<adatok>adatok = new List<adatok>();

string[] olvas = File.ReadAllLines("kiadas.txt");

foreach(var x in olvas)
{
    string[] tomb = x.Split(';');
    adatok.Add(new adatok(int.Parse(tomb[0]), int.Parse(tomb[1]), tomb[2], tomb[3], int.Parse(tomb[4])));
}
Console.WriteLine("2.feldat:");
Console.Write("Szerző:");
string kolto = Console.ReadLine();

var koltotomb = adatok.Where(x => x.mu.Contains(kolto)).Count();

Console.WriteLine(koltotomb +" konyvkiadás");
Console.WriteLine("3.feldat:");

int maxp = adatok.Max(x => x.db);

var mennyi = adatok.Where(x=> x.db == maxp).Count();
Console.WriteLine($"Legnagyobb példányszám: {maxp}, előfordult {mennyi} alkalommal");

Console.WriteLine("4.feldat:");

foreach (var x in adatok)
{
    if(x.szarmazas == "kf" && x.db >=40000)
    {
        Console.WriteLine($"{x.ev}/{x.negyevev}. {x.mu}");
    }
}
Console.WriteLine("5.feldat:");

int[] ma2020 = [0,0];
int[] kf2020 = [0, 0];
int[] ma2021 = [0, 0];
int[] kf2021 = [0, 0];
int[] ma2022 = [0, 0];
int[] kf2022 = [0, 0];
int[] ma2023 = [0, 0];
int[] kf2023 = [0, 0];

foreach (var x in adatok)
{
    if(x.ev == 2020)
    {
        if(x.szarmazas =="ma")
        {
            ma2020[0]++;
            ma2020[1] += x.db;
        }
        else if (x.szarmazas == "kf")
        {
            kf2020[0]++;
            kf2020[1] += x.db;
        }
    }
    else if (x.ev == 2021)
    {
        if (x.szarmazas == "ma")
        {
            ma2021[0]++;
            ma2021[1] += x.db;
        }
        else if (x.szarmazas == "kf")
        {
            kf2021[0]++;
            kf2021[1] += x.db;
        }
    }
    else if (x.ev == 2022)
    {
        if (x.szarmazas == "ma")
        {
            ma2022[0]++;
            ma2022[1] += x.db;
        }
        else if (x.szarmazas == "kf")
        {
            kf2022[0]++;
            kf2022[1] += x.db;
        }
    }
    else if (x.ev == 2023)
    {
        if (x.szarmazas == "ma")
        {
            ma2023[0]++;
            ma2023[1] += x.db;
        }
        else if (x.szarmazas == "kf")
        {
            kf2023[0]++;
            kf2023[1] += x.db;
        }
    }
}

Console.WriteLine("év\tMagyar kiadás\tMagyar pédányszám\tKülföldi kiadás\tKülföldi példányszám");
Console.WriteLine($"2020\t{ma2020[0]}\t{ma2020[1]}\t{kf2020[0]}\t{kf2020[1]}");
Console.WriteLine($"2021\t{ma2021[0]}\t{ma2021[1]}\t{kf2021[0]}\t{kf2021[1]}");
Console.WriteLine($"2022\t{ma2022[0]}\t{ma2022[1]}\t{kf2022[0]}\t{kf2022[1]}");
Console.WriteLine($"2023\t{ma2023[0]}\t{ma2023[1]}\t{kf2023[0]}\t{kf2023[1]}");

StreamWriter ir = new StreamWriter("tabla.html");
ir.WriteLine("<table>");
ir.WriteLine("<tr><th>Év</th><th>Magyar kiadás</th><th>Magyar pédányszám</th><th>Külföldi kiadás</th><th>Külföldi példányszám</th></tr>");
ir.WriteLine($"<tr><td>2020</td><td>{ma2020[0]}</td><td>{ma2020[1]}</td><td>{kf2020[0]}</td><td>{kf2020[1]}</td></tr>");
ir.WriteLine($"<tr><td>2021</td><td>{ma2021[0]}</td><td>{ma2021[1]}</td><td>{kf2021[0]}</td><td>{kf2021[1]}</td></tr>");
ir.WriteLine($"<tr><td>2022</td><td>{ma2022[0]}</td><td>{ma2022[1]}</td><td>{kf2022[0]}</td><td>{kf2022[1]}</td></tr>");
ir.WriteLine($"<tr><td>2023</td><td>{ma2023[0]}</td><td>{ma2023[1]}</td><td>{kf2023[0]}</td><td>{kf2023[1]}</td></tr>");
ir.WriteLine("</table>");
ir.Close();


Console.WriteLine("6.feldat:");
Console.WriteLine("Legalább kétszer, nagyobb példányszámban újra kiadott könyvek:");

List<string> muvek = new List<string>();
List<string> muvek2 = new List<string>();
List<string> muvek3 = new List<string>();


foreach (var s in adatok)
{
    if (muvek3.Contains(s.mu))
    {
        
    }
    else if (muvek2.Contains(s.mu))
    {
        muvek3.Add(s.mu);
    }
    else if (muvek.Contains(s.mu))
    {
        muvek2.Add(s.mu);
    }else
    {
        muvek.Add(s.mu);
    }
}


foreach (var s in muvek3)
{
    var mu = adatok.Where(x => x.mu == s).ToList();

    int elso = mu[0].db;

    int db = 0;

    for (int i = 1; i < mu.Count; i++)
    {
        if (mu[i].db > elso)
        {
            db++;
        }
    }

    if (db >= 2)
    {
        Console.WriteLine(s);
    }
}
