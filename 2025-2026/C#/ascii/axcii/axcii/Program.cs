Console.WriteLine("1. feladat");
string[] konyvLines = File.ReadAllLines("konyv.txt");
foreach (string line in konyvLines)
{
    Console.WriteLine(line);
}
Console.WriteLine();

// 2. feladat
Console.WriteLine("2. feladat");
Console.Write("Kérem adja meg az ismétlések számát: ");
int repeats = int.Parse(Console.ReadLine());

for (int i = 0; i < konyvLines.Length; i++)
{
    string repeatedLine = string.Concat(Enumerable.Repeat(konyvLines[i], repeats));
    Console.Write(repeatedLine);
    if (i < konyvLines.Length - 1 || repeats > 1)
    {
        Console.Write(" | ");
    }
    Console.WriteLine();
}
Console.WriteLine();

// 3. feladat - atalakit függvény
Console.WriteLine("3. feladat - atalakit függvény tesztelése");
string testLine = "4 7_";
Console.WriteLine($"Teszt sor: {testLine}");
Console.WriteLine($"Eredmény: {Atalakit(testLine)}");
Console.WriteLine();

// 4. feladat
Console.WriteLine("4. feladat");
string[] szgTLines = File.ReadAllLines("szg_t.txt");
List<string> szgLines = new List<string>();

foreach (string line in szgTLines)
{
    szgLines.Add(Atalakit(line));
}

// Mentés fájlba
File.WriteAllLines("szg.txt", szgLines);

// Megjelenítés
foreach (string line in szgLines)
{
    Console.WriteLine(line);
}
Console.WriteLine();

// 5. feladat
Console.WriteLine("5. feladat");
Console.Write("Kérem adja meg a tömörített ábra fájlnevét: ");
string compressedFile = Console.ReadLine();
Console.Write("Kérem adja meg a tömörítetlen ábra fájlnevét: ");
string uncompressedFile = Console.ReadLine();

string compressedContent = File.ReadAllText(compressedFile).Replace("\r\n", "").Replace("\n", "");
string uncompressedContent = File.ReadAllText(uncompressedFile).Replace("\r\n", "").Replace("\n", "");

int compressedCount = compressedContent.Length;
int uncompressedCount = uncompressedContent.Length;

Console.WriteLine($"A karakterek száma a tömörített állományban: {compressedCount}");
Console.WriteLine($"A karakterek száma a tömörítetlen állományban: {uncompressedCount}");

double ratio = (double)compressedCount / uncompressedCount;
Console.WriteLine($"A tömörítési arány: {ratio:F2}");
Console.WriteLine();

// 6. feladat
Console.WriteLine("6. feladat");
string[] konyvTLines = File.ReadAllLines("konyv_t.txt");

int sorokSzama = konyvTLines.Length;

int blokkokSzama = 0;
int maxSzelesseg = 0;

foreach (string line in konyvTLines)
{
    string[] blocks = line.Split(' ');
    blokkokSzama += blocks.Length;

    int sorHossz = 0;
    foreach (string block in blocks)
    {
        if (block.Length >= 2)
        {
            int count = int.Parse(block[0].ToString());
            sorHossz += count;
        }
    }

    if (sorHossz > maxSzelesseg)
    {
        maxSzelesseg = sorHossz;
    }
}

Console.WriteLine($"Az ábra magassága sorokban: {sorokSzama}");
Console.WriteLine($"Az ábra szélessége karakterekben: {maxSzelesseg}");
Console.WriteLine($"A blokkok száma: {blokkokSzama}");

    string Atalakit(string compressedLine)
{
    string result = "";
    string[] blocks = compressedLine.Split(' ');

    foreach (string block in blocks)
    {
        if (block.Length >= 2)
        {
            char countChar = block[0];
            if (char.IsDigit(countChar))
            {
                int count = int.Parse(countChar.ToString());
                char character = block[1];

                // Speciális karakterek kezelése
                if (block.Length > 2)
                {
                    // Ha van további karakter a blokkban
                    string rest = block.Substring(1);
                    for (int i = 0; i < count; i++)
                    {
                        result += rest;
                    }
                }
                else
                {
                    result += new string(character, count);
                }
            }
            else
            {
                // Ha nem szám az első karakter, hozzáadjuk az egész blokkot
                result += block;
            }
        }
        else if (block.Length == 1)
        {
            result += block;
        }
    }

    return result;
}
