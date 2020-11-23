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


// 日付を取得
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
    var spendDateRight = document.getElementById('spend-date-right');
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

    var incomDateLeft = document.getElementById('incom-date-left');
    var incomDateRight = document.getElementById('incom-date-right');

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
}