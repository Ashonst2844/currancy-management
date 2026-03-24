const money_display = document.getElementById('currency__total')
const username = document.getElementById('username')
const incomes_data = document.querySelectorAll(".incomes span");
const outcomes_data = document.querySelectorAll(".outcomes span");

var data_list;

var name;
var money;
var total_incomes = 0;
var total_outcomes = 0;

incomes_data.forEach((income)=> {
    let int = parseFloat(income.textContent.slice(1))
    total_incomes += int
})
outcomes_data.forEach((outcomes)=> {
    let int = parseFloat(outcomes.textContent.slice(1))
    total_outcomes += int
})

async function ambilDataDariServer() {
    try {
        // Meminta data ke server Node.js
        const response = await fetch('http://localhost:3000/api/currencies');
        const data = await response.json();
        data_list = data;
        
        name = data_list[0].name
        money = data_list[0].currency + (total_incomes*1000) - (total_outcomes*1000)
        
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