gsap.registerPlugin(TextPlugin)

var tl = gsap.timeline()

const money_display = document.getElementById('currency__total')
const username = document.getElementById('username')
const wallet = document.querySelectorAll('.wishlists');
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
        
        wallet.forEach(elem => {
            const current = elem.querySelector('i');
            const targetText = elem.querySelector('b').textContent;
            const progress = elem.querySelector('h2');
            const target = parseInt(targetText.replace(/\./g, ''));
            
            current.textContent = currency_format
            if (money >= target) {
                current.classList.add('plus')
                current.classList.remove('minus')
            } else if(money < target) {
                current.classList.add('minus')
                current.classList.remove('plus')
            }
            let progression = money/target
            progress.style.setProperty('--width', `calc(${progression} * 100%)`)
            console.log(progression)
        });
        console.log(name, ": ", currency_format, " ", typeof(currency_format))

        let counter = {value:0}

        tl.to(counter, {
            value : money,
            duration: 3,
            ease:"power1.out",
            onUpdate: () => {
                money_display.innerHTML = Math.floor(counter.value).toLocaleString()
            }
        })
        
        tl.to(username, {
            duration: 2,
            text: name,
            ease: "none"
        }, "-=1")

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

const form_box = document.getElementById('form')
function open_form(target) {
    const form = form_box.querySelector('form')
    const title = document.querySelector('#form-title');

    let state = target.slice(5)
    let text = "Enter your new " + state + "!"

    title.textContent = text

    console.log(text)
    form_box.style.display = "block"
    let path = "src/backend/action/"+target+".php"
    form_box.style.display = "block"
    form.setAttribute('action',  path)
    console.log(path)
}

function close_form() {
    form_box.style.display = 'none'
}

document.addEventListener("DOMContentLoaded", () => {
    tl.to('.cards', {
        opacity: 1,
        scale: 1,
        duration: 0.7,
        ease: "bounce.in",
        stagger: 0.2
    })
    tl.to([".incomes", ".outcomes", ".bills", ".wishlists"], {
        opacity: 1,
        scale: 1,
        x:0,
        duration: 0.7,
        ease: "bounce.in",
        stagger: 0.2
    },"-=0.5")
});
