mainSite = document.getElementsByClassName("right_panel_main");
orderSite = document.getElementsByClassName("right_panel_order");
sendSite = document.getElementsByClassName("right_panel_send");
paidSite = document.getElementsByClassName("right_panel_paid");
saldoSite = document.getElementsByClassName("right_panel_saldo");

function count(item) {
    sum += item;
}

function chooseButton(event) {
    let x = event.target;
    let y = x.id.length;
    if (y == 22) {
        let z = x.id.slice(y - 1, y);
        let button = document.getElementById("button_choose_topaid_" + z);
        let cost = document.getElementById("data_paid_cost_nummer_" + z);

        let packageId = document.getElementById("data_paid_nummer_" + z);

        button.classList.toggle("changebutton");
        cost.classList.toggle("counting");
        packageId.classList.toggle("counting_nummer");

        let array = document.getElementsByClassName("counting");
        let array2 = document.getElementsByClassName("counting_nummer");
        let sum = 0;
        let packageIds = [""];
        let n = array.length;
        let m = array2.length;
        let xd;
        let xh;

        for (let i = 0; i < n; i++) {
            xd = array[i].title;
            sum += parseFloat(xd);
        }

        for (let j = 0; j < m; j++) {
            xh = array2[j].innerHTML;
            packageIds += "'" + xh + "', ";
        }

        let mx = packageIds.length;
        let packagesId = packageIds.slice(0, mx - 2);

        let summary_cost = document.getElementById("summary_cost");
        let summary_cost_input = document.getElementById("summary_cost_hidden");
        let summary_ids_hidden = document.getElementById("summary_ids_hidden");
        summary_cost.innerHTML = sum + " zł";
        summary_cost_input.value = sum;
        summary_ids_hidden.value = packagesId;

        let resultOfSaldoAmount = document.getElementById(
            "result_of_saldo_amount"
        );
        let summaryToPaidButton = document.getElementById(
            "summary_topaid_button"
        );
        if (resultOfSaldoAmount.value < sum) {
            summary_cost.style.color = "red";
            summaryToPaidButton.style.display = "none";
        } else {
            summary_cost.style.color = "#1254d4";
            summaryToPaidButton.style.display = "initial";
        }

        if (button.value == "Wybrano!") {
            button.value = "Wybierz!";
            countSummaryNumber();
        } else if (button.value == "Wybierz!") {
            button.value = "Wybrano!";
            countSummaryNumber();
        }
    } else {
        let z = x.id.slice(y - 2, y);
        let button = document.getElementById("button_choose_topaid_" + z);
        button.classList.toggle("changebutton");
        if (button.value == "Wybrano!") {
            button.value = "Wybierz!";
            countSummaryNumber();
        } else if (button.value == "Wybierz!") {
            button.value = "Wybrano!";
            countSummaryNumber();
        }
    }
}

function toPaidData(event) {
    let x = event.target;
    let y = x.id.length;
    if (y == 18) {
        let z = x.id.slice(y - 1, y);
        let package_inner = document.getElementById(
            "data_paid_nummer_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "data_paid_nummer_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById("data_paid_nummer_" + z).innerHTML =
                package_title;
            document.getElementById("data_paid_nummer_" + z).title =
                package_inner;
        }
    } else {
        let z = x.id.slice(y - 2, y);
        let package_inner = document.getElementById(
            "data_paid_nummer_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "data_paid_nummer_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById("data_paid_nummer_" + z).innerHTML =
                package_title;
            document.getElementById("data_paid_nummer_" + z).title =
                package_inner;
        }
    }
}

function countSummaryNumber() {
    let number = document.getElementById("summary_number");
    let diff = document.getElementsByClassName("changebutton");
    let value = diff.length;

    number.innerHTML = value;
}

function main() {
    mainSite[0].classList.add("display_yes");
    mainSite[0].classList.remove("display_no");
    orderSite[0].classList.remove("display_yes");
    sendSite[0].classList.remove("display_yes");
    paidSite[0].classList.remove("display_initial");
    saldoSite[0].classList.remove("display_yes");
}

function order() {
    mainSite[0].classList.remove("display_yes");
    orderSite[0].classList.remove("display_no");
    orderSite[0].classList.add("display_yes");
    sendSite[0].classList.remove("display_yes");
    paidSite[0].classList.remove("display_initial");
    saldoSite[0].classList.remove("display_yes");
    mainSite[0].classList.add("display_no");
}

function send() {
    mainSite[0].classList.remove("display_yes");
    sendSite[0].classList.remove("display_no");
    orderSite[0].classList.remove("display_yes");
    sendSite[0].classList.add("display_yes");
    paidSite[0].classList.remove("display_initial");
    saldoSite[0].classList.remove("display_yes");
    mainSite[0].classList.add("display_no");
}

function paid() {
    mainSite[0].classList.remove("display_yes");
    paidSite[0].classList.remove("display_no");
    orderSite[0].classList.remove("display_yes");
    sendSite[0].classList.remove("display_yes");
    paidSite[0].classList.add("display_initial");
    saldoSite[0].classList.remove("display_yes");
    mainSite[0].classList.add("display_no");
}

function saldo() {
    mainSite[0].classList.remove("display_yes");
    saldoSite[0].classList.remove("display_no");
    orderSite[0].classList.remove("display_yes");
    sendSite[0].classList.remove("display_yes");
    paidSite[0].classList.remove("display_initial");
    saldoSite[0].classList.add("display_yes");
    mainSite[0].classList.add("display_no");
}

function logOut() {
    location.replace("login.php");
}

function saldoBoost() {
    let button = document.getElementById("saldo_submit_button");
    let saldo_money = document.getElementById("saldo_data_money");
    let saldo_boost = document.getElementById("saldo_boost_amount_id");

    if (
        parseFloat(saldo_money.title) + parseFloat(saldo_boost.value) > 500.0 ||
        parseFloat(saldo_money.title) == 500
    ) {
        button.style.display = "none";
        saldo_boost.max = 500.0 - parseFloat(saldo_money.title);
    } else {
        button.style.display = "initial";
        saldo_boost.max = 500.0;
    }
}

function sendCost() {
    let cost = document.getElementById("send_cost");
    let option = document.getElementById("size_option");
    let delivery = document.getElementById("delivery_option");
    let time = document.getElementById("time");
    let input = document.getElementById("send_cost_input");

    let resultOfSaldoAmount = document.getElementById("result_of_saldo_amount");
    let summaryToSendButton = document.getElementById("summary_tosend_button");

    costS = 13.49;
    costM = 19.99;
    costXL = 24.99;
    deliveryP = 2.99;
    deliveryK = 4.99;
    deliveryKE = 9.49;
    timeP = "3 dni";
    timeK = "2 dni";
    timeKE = "1 dzień";

    if (parseFloat(resultOfSaldoAmount.value) < parseFloat(input.value)) {
        if (option.value == "S" && delivery.value == "P") {
            let costSummary = costS + deliveryP;
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeP;
            cost.style.color = "red";
            summaryToSendButton.style.display = "none";
            input.value = costSummary;
        } else if (option.value == "M" && delivery.value == "P") {
            let costSummary = (costM + deliveryP).toFixed(2);
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeP;
            input.value = costSummary;
            cost.style.color = "red";
            summaryToSendButton.style.display = "none";
        } else if (option.value == "XL" && delivery.value == "P") {
            let costSummary = (costXL + deliveryP).toFixed(2);
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeP;
            input.value = costSummary;
            cost.style.color = "red";
            summaryToSendButton.style.display = "none";
        } else if (option.value == "S" && delivery.value == "K") {
            let costSummary = costS + deliveryK;
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeK;
            input.value = costSummary;
            cost.style.color = "red";
            summaryToSendButton.style.display = "none";
        } else if (option.value == "M" && delivery.value == "K") {
            let costSummary = (costM + deliveryK).toFixed(2);
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeK;
            input.value = costSummary;
            cost.style.color = "red";
            summaryToSendButton.style.display = "none";
        } else if (option.value == "XL" && delivery.value == "K") {
            let costSummary = (costXL + deliveryK).toFixed(2);
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeK;
            input.value = costSummary;
            cost.style.color = "red";
            summaryToSendButton.style.display = "none";
        } else if (option.value == "S" && delivery.value == "KE") {
            let costSummary = costS + deliveryKE;
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeKE;
            input.value = costSummary;
            cost.style.color = "red";
            summaryToSendButton.style.display = "none";
        } else if (option.value == "M" && delivery.value == "KE") {
            let costSummary = (costM + deliveryKE).toFixed(2);
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeKE;
            input.value = costSummary;
            cost.style.color = "red";
            summaryToSendButton.style.display = "none";
        } else if (option.value == "XL" && delivery.value == "KE") {
            let costSummary = costXL + deliveryKE;
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeKE;
            input.value = costSummary;
            cost.style.color = "red";
            summaryToSendButton.style.display = "none";
        }
    } else if (
        parseFloat(resultOfSaldoAmount.value) > parseFloat(input.value)
    ) {
        if (option.value == "S" && delivery.value == "P") {
            let costSummary = costS + deliveryP;
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeP;
            input.value = costSummary;
            cost.style.color = "#1254d4";
            summaryToSendButton.style.display = "initial";
        } else if (option.value == "M" && delivery.value == "P") {
            let costSummary = (costM + deliveryP).toFixed(2);
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeP;
            input.value = costSummary;
            cost.style.color = "#1254d4";
            summaryToSendButton.style.display = "initial";
        } else if (option.value == "XL" && delivery.value == "P") {
            let costSummary = (costXL + deliveryP).toFixed(2);
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeP;
            input.value = costSummary;
            cost.style.color = "#1254d4";
            summaryToSendButton.style.display = "initial";
        } else if (option.value == "S" && delivery.value == "K") {
            let costSummary = costS + deliveryK;
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeK;
            input.value = costSummary;
            cost.style.color = "#1254d4";
            summaryToSendButton.style.display = "initial";
        } else if (option.value == "M" && delivery.value == "K") {
            let costSummary = (costM + deliveryK).toFixed(2);
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeK;
            input.value = costSummary;
            cost.style.color = "#1254d4";
            summaryToSendButton.style.display = "initial";
        } else if (option.value == "XL" && delivery.value == "K") {
            let costSummary = (costXL + deliveryK).toFixed(2);
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeK;
            input.value = costSummary;
            cost.style.color = "#1254d4";
            summaryToSendButton.style.display = "initial";
        } else if (option.value == "S" && delivery.value == "KE") {
            let costSummary = costS + deliveryKE;
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeKE;
            input.value = costSummary;
            cost.style.color = "#1254d4";
            summaryToSendButton.style.display = "initial";
        } else if (option.value == "M" && delivery.value == "KE") {
            let costSummary = (costM + deliveryKE).toFixed(2);
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeKE;
            input.value = costSummary;
            cost.style.color = "#1254d4";
            summaryToSendButton.style.display = "initial";
        } else if (option.value == "XL" && delivery.value == "KE") {
            let costSummary = costXL + deliveryKE;
            cost.innerHTML = costSummary + " zł";
            time.innerHTML = timeKE;
            input.value = costSummary;
            cost.style.color = "#1254d4";
            summaryToSendButton.style.display = "initial";
        }
    }
}

function submit_register() {
    let submitButtonRegister = document.getElementById("register_submit");
    let submitPRegister = document.getElementById("register_submit_alert");
    let registerName = document.getElementsByName("name")[0].value.length;
    let registerLastName =
        document.getElementsByName("lastName")[0].value.length;
    let registerLogin = document.getElementsByName("login")[0].value.length;
    let registerPassword =
        document.getElementsByName("password")[0].value.length;
    let registerRepassword =
        document.getElementsByName("repassword")[0].value.length;

    if (
        registerName > 0 &&
        registerLastName > 0 &&
        registerLogin > 0 &&
        registerPassword > 0 &&
        registerRepassword > 0
    ) {
        submitButtonRegister.classList.add("display_initial");
        submitButtonRegister.classList.remove("display_no");
        submitPRegister.classList.add("display_no");
        submitPRegister.classList.remove("display_initial");
    } else {
        submitButtonRegister.classList.add("display_no");
        submitButtonRegister.classList.remove("display_initial");
        submitPRegister.classList.add("display_initial");
        submitPRegister.classList.remove("display_no");
    }
}

function toPaidOrdersMain(event) {
    let x = event.target;
    let y = x.id.length;
    if (y == 27) {
        let z = x.id.slice(y - 1, y);
        let package_inner = document.getElementById(
            "nummer_topaid_orders_main_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_topaid_orders_main_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById(
                "nummer_topaid_orders_main_" + z
            ).innerHTML = package_title;
            document.getElementById("nummer_topaid_orders_main_" + z).title =
                package_inner;
        }
    } else {
        let z = x.id.slice(y - 2, y);
        let package_inner = document.getElementById(
            "nummer_topaid_orders_main_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_topaid_orders_main_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById(
                "nummer_topaid_orders_main_" + z
            ).innerHTML = package_title;
            document.getElementById("nummer_topaid_orders_main_" + z).title =
                package_inner;
        }
    }
}

function toPickUpOrdersMain(event) {
    let x = event.target;
    let y = x.id.length;
    if (y == 29) {
        let z = x.id.slice(y - 1, y);
        let package_inner = document.getElementById(
            "nummer_topickup_orders_main_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_topickup_orders_main_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById(
                "nummer_topickup_orders_main_" + z
            ).innerHTML = package_title;
            document.getElementById("nummer_topickup_orders_main_" + z).title =
                package_inner;
        }
    } else {
        let z = x.id.slice(y - 2, y);
        let package_inner = document.getElementById(
            "nummer_topickup_orders_main_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_topickup_orders_main_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById(
                "nummer_topickup_orders_main_" + z
            ).innerHTML = package_title;
            document.getElementById("nummer_topickup_orders_main_" + z).title =
                package_inner;
        }
    }
}

function AwizoOrdersMain(event) {
    let x = event.target;
    let y = x.id.length;
    if (y == 26) {
        let z = x.id.slice(y - 1, y);
        let package_inner = document.getElementById(
            "nummer_awizo_orders_main_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_awizo_orders_main_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById("nummer_awizo_orders_main_" + z).innerHTML =
                package_title;
            document.getElementById("nummer_awizo_orders_main_" + z).title =
                package_inner;
        }
    } else {
        let z = x.id.slice(y - 2, y);
        let package_inner = document.getElementById(
            "nummer_awizo_orders_main_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_awizo_orders_main_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById("nummer_awizo_orders_main_" + z).innerHTML =
                package_title;
            document.getElementById("nummer_awizo_orders_main_" + z).title =
                package_inner;
        }
    }
}

function pickedUpOrdersMO(event) {
    let x = event.target;
    let y = x.id.length;
    if (y == 27) {
        let z = x.id.slice(y - 1, y);
        let package_inner = document.getElementById(
            "nummer_pickuped_orders_mo_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_pickuped_orders_mo_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById(
                "nummer_pickuped_orders_mo_" + z
            ).innerHTML = package_title;
            document.getElementById("nummer_pickuped_orders_mo_" + z).title =
                package_inner;
        }
    } else {
        let z = x.id.slice(y - 2, y);
        let package_inner = document.getElementById(
            "nummer_pickuped_orders_mo_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_pickuped_orders_mo_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById(
                "nummer_pickuped_orders_mo_" + z
            ).innerHTML = package_title;
            document.getElementById("nummer_pickuped_orders_mo_" + z).title =
                package_inner;
        }
    }
}

function noPaidOrdersMO(event) {
    let x = event.target;
    let y = x.id.length;
    if (y == 25) {
        let z = x.id.slice(y - 1, y);
        let package_inner = document.getElementById(
            "nummer_nopaid_orders_mo_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_nopaid_orders_mo_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById("nummer_nopaid_orders_mo_" + z).innerHTML =
                package_title;
            document.getElementById("nummer_nopaid_orders_mo_" + z).title =
                package_inner;
        }
    } else {
        let z = x.id.slice(y - 2, y);
        let package_inner = document.getElementById(
            "nummer_nopaid_orders_mo_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_nopaid_orders_mo_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById("nummer_nopaid_orders_mo_" + z).innerHTML =
                package_title;
            document.getElementById("nummer_nopaid_orders_mo_" + z).title =
                package_inner;
        }
    }
}

function toPickOrdersMO(event) {
    let x = event.target;
    let y = x.id.length;
    if (y == 25) {
        let z = x.id.slice(y - 1, y);
        let package_inner = document.getElementById(
            "nummer_topick_orders_mo_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_topick_orders_mo_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById("nummer_topick_orders_mo_" + z).innerHTML =
                package_title;
            document.getElementById("nummer_topick_orders_mo_" + z).title =
                package_inner;
        }
    } else {
        let z = x.id.slice(y - 2, y);
        let package_inner = document.getElementById(
            "nummer_topick_orders_mo_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_topick_orders_mo_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById("nummer_topick_orders_mo_" + z).innerHTML =
                package_title;
            document.getElementById("nummer_topick_orders_mo_" + z).title =
                package_inner;
        }
    }
}

function sentOrdersMO(event) {
    let x = event.target;
    let y = x.id.length;
    if (y == 23) {
        let z = x.id.slice(y - 1, y);
        let package_inner = document.getElementById(
            "nummer_sent_orders_mo_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_sent_orders_mo_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById("nummer_sent_orders_mo_" + z).innerHTML =
                package_title;
            document.getElementById("nummer_sent_orders_mo_" + z).title =
                package_inner;
        }
    } else {
        let z = x.id.slice(y - 2, y);
        let package_inner = document.getElementById(
            "nummer_sent_orders_mo_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_sent_orders_mo_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById("nummer_sent_orders_mo_" + z).innerHTML =
                package_title;
            document.getElementById("nummer_sent_orders_mo_" + z).title =
                package_inner;
        }
    }
}

function toAwizoOrdersMain(event) {
    let x = event.target;
    let y = x.id.length;
    if (y == 28) {
        let z = x.id.slice(y - 1, y);
        let package_inner = document.getElementById(
            "nummer_toawizo_orders_main_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_toawizo_orders_main_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById(
                "nummer_toawizo_orders_main_" + z
            ).innerHTML = package_title;
            document.getElementById("nummer_toawizo_orders_main_" + z).title =
                package_inner;
        }
    } else {
        let z = x.id.slice(y - 2, y);
        let package_inner = document.getElementById(
            "nummer_toawizo_orders_main_" + z
        ).innerHTML;
        let package_title = document.getElementById(
            "nummer_toawizo_orders_main_" + z
        ).title;
        if (package_inner !== package_title) {
            document.getElementById(
                "nummer_toawizo_orders_main_" + z
            ).innerHTML = package_title;
            document.getElementById("nummer_toawizo_orders_main_" + z).title =
                package_inner;
        }
    }
}
