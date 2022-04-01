$(function () {
    const token = $('meta[name="csrf-token"]').attr("content");
    const myAjax = new MyAjax(token);
    const urlapKezeles = new UrlapKezeles(myAjax);

    let bejegyzesekVegpont = "/bejegyzesek";
    let tevekenysegekVegpont = "/tevekenysegek";
    myAjax.getAjax(bejegyzesekVegpont, adatfeldolgoz);
    myAjax.getAjax(tevekenysegekVegpont, urlapKezeles.optionTevekenysegFeltolt);
});
function adatfeldolgoz(tomb) {
    const bejegyzesek = new Bejegyzesek();
    bejegyzesek.bejegyzesFeldolgoz(tomb);
    const osszesitettMap = new Map();
    tomb.forEach((elem) => {
        let aktOsztaly = osztalyokTmb[elem.osztalyokID];
        if (osszesitettMap.has(aktOsztaly)) {
            let ujertek =
                osszesitettMap.get(aktOsztaly) + elem.tevekenyseg.pontszam;
            osszesitettMap.set(aktOsztaly, ujertek);
        } else {
            osszesitettMap.set(aktOsztaly, elem.tevekenyseg.pontszam);
        }
    });

    const osszTomb = [["Osztály", "Pontszám", { role: "style" }]];
    osszesitettMap.forEach((key, value) => {
        osszTomb.push([value, key, "green"]);
    });

    google.charts.load("current", { packages: ["corechart", "bar"] });
    google.charts.setOnLoadCallback(drawMultSeries);
    function drawMultSeries() {
        var data = google.visualization.arrayToDataTable(osszTomb);
        console.log(osszTomb);
        var options = {
            title: "Pontszámok osztályonként",
            chartArea: { width: "50%" },
            hAxis: {
                title: "Pontszám",
                minValue: 0,
            },
            vAxis: {
                title: "Osztályok",
            },
        };

        var chart = new google.visualization.BarChart(
            document.getElementById("diagram")
        );
        chart.draw(data, options);
    }
}
const osztalyokTmb = [
    "Válassz tevékenységet!",
    "nSZF1A",
    "nSZF1B",
    "nSZF2A",
    "nIRU1A",
    "nIRU1B",
    "nIRU2A",
];
class UrlapKezeles {
    constructor(myAjax) {
        this.myAjax = myAjax;

        this.osztalyokSelect = $("#osztalyok");
        this.tevekenysegekSelect = $("#tevekenysegek");
        console.log(this.tevekenysegekSelect);
        this.optionOsztalyokFeltolt(osztalyokTmb);
        $("#kuld").on("click", () => {
            const adat = {
                osztalyokID: $("#osztalyok").val(),
                tevekenysegId: $("#tevekenysegek").val(),
            };
            console.log(adat);
            let bejegyzesVegpont = "/bejegyzes";
            myAjax.postAjax(bejegyzesVegpont, adat);
        });
    }
    optionTevekenysegFeltolt(tomb) {
        console.log(tomb);
        tomb.forEach((element) => {
            $("#tevekenysegek").append(
                `<option value='${element.id}'>${element.tevekenyseg_nev}</option>`
            );
        });
    }
    optionOsztalyokFeltolt(tomb) {
        console.log(tomb);
        tomb.forEach((element, index) => {
            this.osztalyokSelect.append(
                `<option value='${index}'>${element}</option>`
            );
        });
    }
}
class Bejegyzesek {
    constructor() {}
    bejegyzesFeldolgoz(tomb) {
        tomb.forEach((elem) => {
            new Bejegyzes(elem);
        });
    }
}

class Bejegyzes {
    constructor(adat) {
        this.adat = adat;
        const szuloelem = $("#adatok");
        let allapot = adat.allapot === 0 ? "jóváhagyásra vár" : "";
        const elem = `<div class="bejegyzes">
               <div class="osztaly">${osztalyokTmb[adat.osztalyokID]}</div>
               <div class="tevekenyseg">${
                   adat.tevekenyseg.tevekenyseg_nev
               }</div>
               <div class="pontszam">${adat.tevekenyseg.pontszam}</div>
               <div class="allapot">${
                   adat.allapot === 0 ? "jóváhagyásra vár" : "elfogadva"
               }</div>
       </div>`;
        szuloelem.append(elem);
        this.node = szuloelem.children(".bejegyzes:last-child");
    }
}
