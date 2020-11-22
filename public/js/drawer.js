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
    var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth() + 1;
    var date = today.getDate();
    var weekDay = ['日', '月', '火', '水', '木', '金', '土'];
    var day = weekDay[today.getDay()];

    spendDate.textContent = year + '年' + month + '月' + date + '日' + '(' + day + ')';
}