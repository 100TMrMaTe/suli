namespace utemez;

public class adatok
{
    public int kezdho;
    public int kezdonap;
    public int vegho;
    public int vegnap;
    public string id;
    public string tabor;
    
    public adatok(int  kezdho, int kezdonap, int vegho,int vegnap, string id, string tabor)
    {
        this.kezdho = kezdho;
        this.kezdonap = kezdonap;
        this.vegho = vegho;
        this.vegnap = vegnap;
        this.id = id;
        this.tabor = tabor;
        
    }
}