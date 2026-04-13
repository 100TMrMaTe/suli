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

namespace vizsgawpf
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        List<adatok> adatoks = new List<adatok>();
        public MainWindow()
        {
            
            InitializeComponent();
              

            string[] olvas = File.ReadAllLines("szerviz.txt");

            foreach (var x in olvas)
            {
                string[] tomb = x.Split("\t");

                adatoks.Add(new adatok(tomb[0], tomb[1], tomb[2], tomb[3], tomb[4]));
            }

            var adatok2 = adatoks.OrderBy(x => x.rendszam).Distinct().ToList();
            foreach (var x in adatok2)
            {
                listbox.Items.Add(x.rendszam);
                listbox.SelectionChanged += LstOnSelectionChanged;
            }

            

        }
        private void LstOnSelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            string rendszam =Convert.ToString(listbox.SelectedItem);
            var utolso = adatoks.Where(x=> x.rendszam == rendszam).OrderByDescending(x=> x.datum).ToList();
            rendszambox.Text = rendszam;
            fajtabox.Text = utolso[0].fajta;
            uzembebox.Text = utolso[0].uzembe;
            tulajbox.Text = utolso[0].tulaj;
            szervizbox.Text = utolso[0].datum;

        }


    }
}