using sebesseg;

List<adatok> adatoks = new List<adatok>();

string[] tomb = File.ReadAllLines("ut.txt");

int uthossz =int.Parse(tomb[0]);

for(int i = 1; i < tomb.Length; i++)
{
    string[] split = tomb[i].Split(" ");
    adatoks.Add(new adatok(int.Parse(split[0]),split[1]));
}

Console.WriteLine(adatoks);

var telepulesek = adatoks.Where(x => x.jelzes.StartsWith("Varos")).Distinct().ToList();

Console.WriteLine("2. feladat");
Console.WriteLine("A települések neve:");

foreach(var x in telepulesek)
{
    Console.WriteLine(x.jelzes);
}

Console.WriteLine("3. feladat ");
Console.Write("Adja meg a vizsgált szakasz hosszát km-ben! ");
double hossz =double.Parse(Console.ReadLine());

var vizsgalt = adatoks.Where(x => x.meter < (hossz * 1000));

int minseb = 90;

foreach(var x in vizsgalt)
{
    if(x.jelzes.EndsWith("0") || x.jelzes.StartsWith("Varos"))
    {
        if (x.jelzes.StartsWith("Varos") && minseb < 50)
        {
            minseb = 50;
            
        }

        if(x.jelzes.EndsWith("0"))
        {
            if (int.Parse(x.jelzes) < minseb)
            {
                minseb = int.Parse(x.jelzes);
            }
        }
        
    }
    
}

Console.WriteLine($"Az első {hossz} km-en {minseb} km/h volt a legalacsonyabb megengedett sebesség. ");


int telepuleshossz = 0;

var varoskezdo = adatoks.Where(x => x.jelzes.StartsWith("Varos")).Select(y => y.meter).ToList();
var varosveg = adatoks.Where(x => x.jelzes == "]").Select(y => y.meter).ToList();

for(int i = 0; i < varoskezdo.Count; i++)
{
    telepuleshossz += varosveg[i] - varoskezdo[i];
}

double szazalek = (telepuleshossz / (double)uthossz) * 100;

Console.WriteLine($"A települések aránya: {szazalek:F2}%");