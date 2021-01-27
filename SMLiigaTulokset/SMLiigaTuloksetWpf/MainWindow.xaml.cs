using System;
using System.Windows;
using System.Xml;



namespace SMLiigaTuloksetWpf
{
    /// <summary>
    /// Interaction logic for MainWindow.xaml
    /// </summary>
    public partial class MainWindow : Window
    {
        int kotimaalit = 0;
        int vierasmaalit = 0;

        int kotiPelIndex = 0;
        string[] kotiPelaajienNimet = new string[50];
        string[] kotiPelaajienNumerot = new string[50];

        int vierasPelIndex = 0;
        string[] vierasPelaajienNimet = new string[50];
        string[] vierasPelaajienNumerot = new string[50];


        public MainWindow()
        {
            InitializeComponent();
            XmlReader lukija = XmlReader.Create("SMliigaJoukkueetPelaajat.xml");
            string joukkue = "";
            lukija.MoveToContent();
            while (lukija.Read())
            {
                if (lukija.NodeType == XmlNodeType.Element && lukija.Name == "Joukkue")
                {
                    if (lukija.HasAttributes)
                    {
                        joukkue = lukija.GetAttribute("nimi");
                        lstKotijoukkue.Items.Add(joukkue);
                        lstVierasjoukkue.Items.Add(joukkue);
                    }
                }

            }
           /* lstKotijoukkue.SelectedIndex = 0;
            lstVierasjoukkue.SelectedIndex = 1; */ 
 
        }
        

        private void LstKotijoukkue_SelectionChanged(object sender, System.Windows.Controls.SelectionChangedEventArgs e)
        {
            
            if (lstKotijoukkue.SelectedIndex == lstVierasjoukkue.SelectedIndex)
            {
                MessageBox.Show("Sama joukkue: valinta virheellinen");
            }
            kotimaalit = 0;
            kotiPelIndex = 0;
            for (int i = 0; i > 50; i++)
            {
                kotiPelaajienNumerot[i] = "";
                kotiPelaajienNimet[i] = string.Empty;
            }

            lblKotimaalit.Content = 0;
            lstKotiMaalit.Items.Clear();
            string joukkue = "";
            joukkue = lstKotijoukkue.SelectedItem.ToString();

            XmlReader lukija = XmlReader.Create("SMliigaJoukkueetPelaajat.xml");
            lukija.MoveToContent();
            lstKotipelaajat.Items.Clear();
            lblKotijoukkue.Content = joukkue;
            while (lukija.Read())
            {
                if (lukija.NodeType == XmlNodeType.Element && lukija.Name == "Joukkue")
                {
                    if (lukija.HasAttributes)
                    {
                        string haettuJoukkue = lukija.GetAttribute("nimi");
                        if (joukkue == haettuJoukkue)
                        {   
                            // luetaan kaikki joukkueen pelaajat
                            while (lukija.Read())
                            {
                                if (lukija.NodeType == XmlNodeType.EndElement && lukija.Name == "Pelaajat")
                                {
                                    return;
                                }
                                if (lukija.NodeType == XmlNodeType.Element && lukija.Name == "Nimi")
                                {
                                    lukija.Read();
                                    lstKotipelaajat.Items.Add(lukija.Value);

                                    kotiPelaajienNimet[kotiPelIndex] = lukija.Value;
                                    while (lukija.Read())
                                    {
                                        if (lukija.NodeType == XmlNodeType.Element && lukija.Name == "Pelaajanro")
                                        {
                                            lukija.Read();
                                            kotiPelaajienNumerot[kotiPelIndex] = lukija.Value;
                                            kotiPelIndex++;
                                            break;
                                        }
                                    }
                                }
                            }
                        }

                    }
                }
            }
        }

        private void LstVierasjoukkue_SelectionChanged(object sender, System.Windows.Controls.SelectionChangedEventArgs e)
        {
            if (lstKotijoukkue.SelectedIndex == lstVierasjoukkue.SelectedIndex)
            {
                MessageBox.Show("Sama joukkue: valinta virheellinen");
            }
            vierasmaalit = 0;
            vierasPelIndex = 0;
            for (int i = 0; i > 50; i++)
            {
                vierasPelaajienNumerot[i] = "";
                vierasPelaajienNimet[i] = string.Empty;
            }
            lblVierasmaalit.Content = 0;
            lstVierasmaalit.Items.Clear();
            string joukkue = "";
            joukkue = lstVierasjoukkue.SelectedItem.ToString();
            lblVierasjoukkue.Content = joukkue;

            XmlReader lukija = XmlReader.Create("SMliigaJoukkueetPelaajat.xml");
            lukija.MoveToContent();
            lstVieraspelaajat.Items.Clear();

            while (lukija.Read())
            {
                if (lukija.NodeType == XmlNodeType.Element && lukija.Name == "Joukkue")
                {
                    if (lukija.HasAttributes)
                    {
                        string haettuJoukkue = lukija.GetAttribute("nimi");
                        if (joukkue == haettuJoukkue)
                        {
                            // luetaan kaikki joukkueen pelaajat
                            while (lukija.Read())
                            {
                                if (lukija.NodeType == XmlNodeType.EndElement && lukija.Name == "Pelaajat")
                                {
                                    return;
                                }
                                if (lukija.NodeType == XmlNodeType.Element && lukija.Name == "Nimi")
                                {
                                    lukija.Read();
                                    lstVieraspelaajat.Items.Add(lukija.Value);

                                    vierasPelaajienNimet[vierasPelIndex] = lukija.Value;
                                    while (lukija.Read())
                                    {
                                        if (lukija.NodeType == XmlNodeType.Element && lukija.Name == "Pelaajanro")
                                        {
                                            lukija.Read();
                                            vierasPelaajienNumerot[vierasPelIndex] = lukija.Value;
                                            vierasPelIndex++;
                                            break;
                                        }
                                    }
                                }
                            }
                        }

                    }
                }
            }
        }

        private void BtnKirjaaKotiMaali_Click(object sender, RoutedEventArgs e)
        {
            DateTime maalintekohetki = DateTime.Now;

            int valittuPelaajaIndeksi = lstKotipelaajat.SelectedIndex;

            if (lstKotipelaajat.SelectedIndex >= 0)
            {
                lstKotiMaalit.Items.Add(maalintekohetki.ToLongTimeString() + ": "
                                                + kotiPelaajienNumerot[valittuPelaajaIndeksi] + ". "
                                                + lstKotipelaajat.SelectedItem.ToString());

                kotimaalit++;
                lblKotimaalit.Content = kotimaalit;
                

            }
            else
            {
                MessageBox.Show("Valitse maalin tehnyt kotijoukkueen pelaaja");
            }
        }

        private void BtnKirjaaVierasMaali_Click(object sender, RoutedEventArgs e)
        {
            
            DateTime maalintekohetki = DateTime.Now;

            int valittuPelaajaIndeksi = lstVieraspelaajat.SelectedIndex;

            if (lstVieraspelaajat.SelectedIndex >= 0)
            {
                lstVierasmaalit.Items.Add(maalintekohetki.ToLongTimeString() + ": "
                                                + vierasPelaajienNumerot[valittuPelaajaIndeksi] + ". "
                                                + lstVieraspelaajat.SelectedItem.ToString());

                vierasmaalit++;
                lblVierasmaalit.Content = vierasmaalit;


            }
            else
            {
                MessageBox.Show("Valitse maalin tehnyt vierasjoukkueen pelaaja");
            }
        }
    }
}
