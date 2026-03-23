const current_money = document.getElementById("currency__total")
var money = current_money.textContent
console.log(parseInt(money) * 1000)

if (parseInt(money) > 0) {
    current_money.classList.add("plus");
    current_money.classList.remove("minus");
} else if (parseInt(money) < 0) {
    current_money.classList.add("minus");
    current_money.classList.remove("plus");
} else {
    current_money.classList.remove("plus", "minus");
}

function goToApp(app) {
    target = "apps/"+app+".html";
    window.location.href += target;
    console.log(target)
}