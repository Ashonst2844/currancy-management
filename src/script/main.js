const money_display = document.getElementById('currency__total')
const username = document.getElementById('username')

var data_list;

var name;
var money;

async function ambilDataDariServer() {
    try {
        // Meminta data ke server Node.js
        const response = await fetch('http://localhost:3000/api/currencies');
        const data = await response.json();
        data_list = data;
        
        name = data_list[0].name
        money = data_list[0].currency
        
        currency_format = new Intl.NumberFormat("id-ID").format(money)
        console.log(name, ": ", currency_format, " ", typeof(currency_format))

        money_display.textContent = currency_format + ",00";
        username.textContent = name

        if (parseInt(money) > 0) {
            money_display.classList.add("plus");
            money_display.classList.remove("minus");
        } else if (parseInt(money) < 0) {
            money_display.classList.add("minus");
            money_display.classList.remove("plus");
        } else {
            money_display.classList.remove("plus", "minus");
        }

    } catch (error) {
        console.error("Server belum jalan atau error:", error);
    }
}
ambilDataDariServer();

function goToApp(app) {
    target = "apps/"+app+".html";
    window.location.href += target;
}