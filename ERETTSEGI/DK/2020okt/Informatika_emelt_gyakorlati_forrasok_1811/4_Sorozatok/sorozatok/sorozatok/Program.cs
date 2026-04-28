using sorozatok;

List<adatok> adatoks = new List<adatok>();

string[] olvas = File.ReadAllLines("lista.txt");

for(int i = 0; i < olvas.Length; i+=5)
{
    adatoks.Add(new adatok(olvas[i].Trim(), olvas[i+1].Trim(), olvas[i+2].Trim(),int.Parse(olvas[i+3].Trim()), int.Parse(olvas[i+4].Trim())));
}

Console.WriteLine("2. feladat");
Console.WriteLine($"A listában {adatoks.Where(x=> x.date != "NI").Count()} db vetítési dátummal rendelkező epizod van.");
Console.WriteLine();
Console.WriteLine("3. feladat");


double szazalek = adatoks.Count(x => x.megnezve == 1) * 100.0 / adatoks.Count();
Console.WriteLine($"{szazalek:F2}%");

var perceben = adatoks.Where(x => x.megnezve == 1).Select(x => x.hossz).Sum();

Console.WriteLine();
Console.WriteLine("4. feladat");
Console.WriteLine(perceben);