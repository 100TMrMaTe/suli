function toRadian(angle){
    return angle*Math.PI/180;
}

class Aszteroida
{
    constructor(posx, posy, szin, irany, sebesseg) {
        this.posx=posx;
        this.posy=posy;
        this.szin=szin;
        this.irany=irany;
        this.sebesseg=sebesseg;
        this.meret=20 //fix méret
    }
}
var Aszter = new Aszteroida(50,40,"red",toRadian(30),3.5)
console.log(Aszter)