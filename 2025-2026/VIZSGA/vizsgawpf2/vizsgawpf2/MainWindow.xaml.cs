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

namespace vizsgawpf2
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

            string[] olvas = File.ReadAllLines("autok.txt");

            foreach (var line in olvas)
                {
                    string[]tomb = line.Split(" ");
                    adatoks.Add(new adatok(int.Parse(tomb[0]), tomb[1], tomb[2], int.Parse(tomb[3]), int.Parse(tomb[4]), int.Parse(tomb[5])));
                }
            var rendszamok = adatoks.Select(x => x.rendszam).Distinct();

            foreach(var x in rendszamok)
            {
                listbox.Items.Add(x);
            }
            listbox.SelectedIndex = 0;
        }

        private void listbox_SelectionChanged(object sender, SelectionChangedEventArgs e)
        {
            string get = listbox.SelectedItem as string;
            canvas.Children.Clear();
            var tomb1 = adatoks.Where(x=> x.rendszam == get).ToList();
            Label label = new Label();
            label.Name = "label";
            label.Width = 400;
            label.Height = 50;
            label.Content = "rendszam: "+ get;
            label.Margin = new Thickness(0,0,0,0);
            canvas.Children.Add(label);

            Label label1 = new Label();
            label1.Name = "label1";
            label1.Width = 400;
            label1.Height = 50;
            label1.Content = "km: " + tomb1.Last().km;
            label1.Margin = new Thickness(0, 20, 0, 0);
            canvas.Children.Add(label1);

            Button button = new Button();
            button.Name = "button";
            button.Width = 200;
            button.Height = 30;
            button.Content = "asdasdasdasdasdas";
            button.Margin = new Thickness(0, 45, 0, 0);
            var hanyan = tomb1.Select(x => x.az).Distinct().Count();
            button.Click += (s, ev) => Button_Click(hanyan);
            canvas.Children.Add(button);
        }

        private void Button_Click(int a)
        {
            Label label12 = new Label();
            label12.Name = "label12";
            label12.Width = 400;
            label12.Height = 50;
            label12.Content = "használták: " + a;
            label12.Margin = new Thickness(0, 70, 0, 0);
            canvas.Children.Add(label12);
        }
    }
}