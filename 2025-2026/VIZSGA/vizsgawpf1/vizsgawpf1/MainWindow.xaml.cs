using System.IO;
using System.Text;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Navigation;
using System.Windows.Shapes;
using vizsgawpf1;



namespace vizsgawpf1
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    /// 
    
public partial class MainWindow : Window
    {

        List<adatok> adatoks = new List<adatok>();
        public MainWindow()
        {
            
            InitializeComponent();

            string[] ovlas = File.ReadAllLines("autok.txt");
            foreach (var x in ovlas)
            {
                string[] tomb = x.Split(" ");
                adatoks.Add(new adatok(int.Parse(tomb[0]), TimeOnly.Parse(tomb[1]), tomb[2], int.Parse(tomb[3]), int.Parse(tomb[4]), int.Parse(tomb[5])));
            }
            var rendszamok = adatoks.Select(x => x.rendszam).Distinct();
            foreach (var x in rendszamok)
            {
                listbox.Items.Add(x);
            }      
        }

        private void listbox_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            canvas.Children.Clear();
            string rendszam = listbox.SelectedItem.ToString();
            var get = adatoks.Where(x=> x.rendszam == rendszam).ToList();
            Label rendszamlabel = new Label();
            rendszamlabel.Name = "Rendszam";
            rendszamlabel.Width = 500;
            rendszamlabel.Height = 50;
            rendszamlabel.Content = "rendszam: "+rendszam;
            rendszamlabel.Margin = new Thickness(0, 0, 0, 0);
            canvas.Children.Add(rendszamlabel);

            Label km = new Label();
            km.Name = "km";
            km.Width = 500;
            km.Height = 50;
            km.Content = "kilométer állás: " + get.Last().km;
            km.Margin = new Thickness(0, 20, 0, 0);
            canvas.Children.Add(km);
            
            Button button = new Button();
            button.Name = "button";
            button.Width = 500;
            button.Height = 30;
            button.Content = "Hányan vezették ezt az autót";
            button.Margin = new Thickness(0, 50, 0, 0);
            int count = get.Select(x => x.az).Distinct().Count();
            button.Click += (s, ev)=> button_click(count);
            canvas.Children.Add(button);
        }
        public void button_click(int a)
        {
            Label hasznalt = new Label();
            hasznalt.Name = "hasznalt";
            hasznalt.Width = 500;
            hasznalt.Height = 50;
            hasznalt.Content = "Enyi sofőr használta a kocsit: " + a;
            hasznalt.Margin = new Thickness(0, 80, 0, 0);
            canvas.Children.Add(hasznalt);
        }
    }
}