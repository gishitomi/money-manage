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

// インデックス画面の日付を取得
// window.addEventListener('load', function() {
//     // インデックス画面の日付を取得
//     var homeIndex = document.getElementById('home-index');
//     var leftMonth = document.getElementById('left-month');
//     var rightMonth = document.getElementById('right-month');
//     var leftMonthBtn = document.getElementById('left-month-btn');
//     var rightMonthBtn = document.getElementById('right-month-btn');
//     // 予算画面の日付取得
//     var budgetMonth = document.getElementById('budget-month');

//     var today = new Date();
//     var year = today.getFullYear();
//     var month = today.getMonth() + 1;
//     var date = today.getDate();
//     var weekDay = ['日', '月', '火', '水', '木', '金', '土'];
//     var day = weekDay[today.getDay()];
//     homeIndex.textContent = year + '年' + month + '月の利用状況';
//     leftMonth.textContent = month - 1 + '月';
//     rightMonth.textContent = month + 1 + '月';
//     budgetMonth.textContent = month + '月の設定予算';

//     // 前月ボタンクリックイベント
//     leftMonthBtn.addEventListener('click', function() {
//             today.setMonth(today.getMonth() - 1);
//             year = today.getFullYear();
//             month = today.getMonth() + 1;
//             var lastMonth = month - 1;
//             var nextMonth = month + 1;
//             // 0が表示されてしまうので、lastMonthが0の場合12を表示させる
//             if (lastMonth > 0) {
//                 leftMonth.textContent = lastMonth + '月';
//             } else {
//                 leftMonth.textContent = 12 + '月';
//             }
//             // 次の月の表示を変更こっちも13が表示されてしまうので、代わりに1を表示させる
//             if (nextMonth < 13) {
//                 rightMonth.textContent = nextMonth + '月';
//             } else {
//                 rightMonth.textContent = 1 + '月';
//             }
//             // インデックス部分の表示を変更
//             homeIndex.textContent = year + '年' + month + '月の利用状況';
//             budgetMonth.textContent = month + '月の設定予算';
//         })
//         // 来月ボタンクリックイベント
//     rightMonthBtn.addEventListener('click', function() {
//         today.setMonth(today.getMonth() + 1);
//         year = today.getFullYear();
//         month = today.getMonth() + 1;
//         var lastMonth = month - 1;
//         var nextMonth = month + 1;
//         // 0が表示されてしまうので、lastMonthが0の場合12を表示させる
//         if (lastMonth > 0) {
//             leftMonth.textContent = lastMonth + '月';
//         } else {
//             leftMonth.textContent = 12 + '月';
//         }
//         // 次の月の表示を変更こっちも13が表示されてしまうので、代わりに1を表示させる
//         if (nextMonth < 13) {
//             rightMonth.textContent = nextMonth + '月';
//         } else {
//             rightMonth.textContent = 1 + '月';
//         }
//         // インデックス部分の表示を変更
//         homeIndex.textContent = year + '年' + month + '月の利用状況';
//         budgetMonth.textContent = month + '月の設定予算';
//     })
// })


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