using belepteto;

List<adatok> adatok = new List<adatok>();

StreamReader sr = new StreamReader("bedat.txt");

while(!sr.EndOfStream)
{
    string line = sr.ReadLine();
    string[] tomb = line.Split(" ");

    adatok.Add(new adatok(tomb[0], tomb[1], int.Parse(tomb[2])));
}

sr.Close();

var elso = adatok.Where()
