var spendBtn = document.getElementById('spend-btn');
var incomBtn = document.getElementById('incom-btn');
var spendDrawer = document.getElementById('spend-drawer');
var incomDrawer = document.getElementById('incom-drawer');

var spendBack = document.getElementById('spend-back');
var incomBack = document.getElementById('incom-back');

var overlay = document.getElementById('overlay');

spendBtn.addEventListener('click', function() {
    spendDrawer.classList.add('open');
    overlay.classList.add('open');
})
incomBtn.addEventListener('click', function() {
    incomDrawer.classList.add('open');
    overlay.classList.add('open');
})

overlay.addEventListener('click', function() {
    this.classList.remove('open');
    spendDrawer.classList.remove('open');
    incomDrawer.classList.remove('open');
})

spendBack.addEventListener('click', function() {
    spendDrawer.classList.remove('open');
    overlay.classList.remove('open');
})

incomBack.addEventListener('click', function() {
    incomDrawer.classList.remove('open');
    overlay.classList.remove('open');
})

// 支出、収入画面の日付を取得
window.onload = function() {
    var spendDate = document.getElementById('spend-date');
    var incomDate = document.getElementById('incom-date');
    var dbSpendDate = document.getElementById('db-spend-date');
    var dbIncomDate = document.getElementById('db-incom-date');
    var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth() + 1;
    var date = today.getDate();
    var weekDay = ['日', '月', '火', '水', '木', '金', '土'];
    var day = weekDay[today.getDay()];

    spendDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';

    incomDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
    dbSpendDate.value = year + '-' + month + '-' + date;
    dbIncomDate.value = year + '-' + month + '-' + date;

    // 左右の矢印を押した時のイベント
    var spendDateLeft = document.getElementById('spend-date-left');
    var spendMonthLeft = document.getElementById('spend-month-left');
    var spendDateRight = document.getElementById('spend-date-right');
    var spendMonthRight = document.getElementById('spend-month-right');
    spendDateLeft.addEventListener('click', function() {
        today.setDate(today.getDate() - 1);
        year = today.getFullYear();
        month = today.getMonth() + 1;
        date = today.getDate();
        day = weekDay[today.getDay()];
        spendDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbSpendDate.value = year + '-' + month + '-' + date;
        incomDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbIncomDate.value = year + '-' + month + '-' + date;
    })
    spendDateRight.addEventListener('click', function() {
        today.setDate(today.getDate() + 1);
        year = today.getFullYear();
        month = today.getMonth() + 1;
        date = today.getDate();
        day = weekDay[today.getDay()];
        spendDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbSpendDate.value = year + '-' + month + '-' + date;
        incomDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbIncomDate.value = year + '-' + month + '-' + date;
    })
    spendMonthLeft.addEventListener('click', function() {
        today.setMonth(today.getMonth() - 1);
        year = today.getFullYear();
        month = today.getMonth() + 1;
        date = today.getDate();
        day = weekDay[today.getDay()];
        spendDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbSpendDate.value = year + '-' + month + '-' + date;
        incomDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbIncomDate.value = year + '-' + month + '-' + date;
    })

    spendMonthRight.addEventListener('click', function() {
        today.setMonth(today.getMonth() + 1);
        year = today.getFullYear();
        month = today.getMonth() + 1;
        date = today.getDate();
        day = weekDay[today.getDay()];
        spendDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbSpendDate.value = year + '-' + month + '-' + date;
        incomDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbIncomDate.value = year + '-' + month + '-' + date;
    })

    var incomMonthLeft = document.getElementById('incom-month-left');
    var incomDateLeft = document.getElementById('incom-date-left');
    var incomDateRight = document.getElementById('incom-date-right');
    var incomMonthRight = document.getElementById('incom-month-right');

    incomDateLeft.addEventListener('click', function() {
        today.setDate(today.getDate() - 1);
        year = today.getFullYear();
        month = today.getMonth() + 1;
        date = today.getDate();
        day = weekDay[today.getDay()];
        incomDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbIncomDate.value = year + '-' + month + '-' + date;
        spendDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbSpendDate.value = year + '-' + month + '-' + date;
    })
    incomDateRight.addEventListener('click', function() {
        today.setDate(today.getDate() + 1);
        year = today.getFullYear();
        month = today.getMonth() + 1;
        date = today.getDate();
        day = weekDay[today.getDay()];
        incomDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbIncomDate.value = year + '-' + month + '-' + date;
        spendDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbSpendDate.value = year + '-' + month + '-' + date;
    })
    incomMonthLeft.addEventListener('click', function() {
        today.setMonth(today.getMonth() - 1);
        year = today.getFullYear();
        month = today.getMonth() + 1;
        date = today.getDate();
        day = weekDay[today.getDay()];
        spendDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbSpendDate.value = year + '-' + month + '-' + date;
        incomDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbIncomDate.value = year + '-' + month + '-' + date;
    })
    incomMonthRight.addEventListener('click', function() {
        today.setMonth(today.getMonth() + 1);
        year = today.getFullYear();
        month = today.getMonth() + 1;
        date = today.getDate();
        day = weekDay[today.getDay()];
        spendDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbSpendDate.value = year + '-' + month + '-' + date;
        incomDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
        dbIncomDate.value = year + '-' + month + '-' + date;
    })
}

// エラーハンドリング
var spendSubmit = document.getElementById('spend-submit');
var money = document.getElementById('money');

function cancelSpendSubmit() {
    var flag = false;
    for (var i = 0; i < document.spendForm.type.length - 1; i++) {
        if (money.value === "" && !document.spendForm.type[i].checked) {
            alert('支出金額、カテゴリを選択してください');
            return false;
        }
        if (money.value === "") {
            alert('支出金額を入力してください');
            return false;
        }
        if (document.spendForm.type[i].checked) {
            flag = true;
        }
    }
    if (!flag) {
        alert('カテゴリを選択してください');
        return false;
    }
}


var incomSubmit = document.getElementById('incom-submit');
var incomMoney = document.getElementById('incom-money');

function cancelIncomSubmit() {
    var flag = false;
    for (var i = 0; i < document.incomForm.type.length - 1; i++) {
        if (incomMoney.value === "" && !document.incomForm.type[i].checked) {
            alert('収入金額、カテゴリを選択してください');
            return false;
        }
        if (incomMoney.value === "") {
            alert('収入金額を入力してください');
            return false;
        }
        if (document.incomForm.type[i].checked) {
            flag = true;
        }
    }
    if (!flag) {
        alert('カテゴリを選択してください');
        return false;
    }
}