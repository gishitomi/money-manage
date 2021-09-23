// チェックボックスのチェック検知

//「全て選択」のチェックボックス
let checkAll = document.getElementById("all-select");
//支出額、収入額のチェックボックス
let el = document.getElementsByClassName("checks");
// 支出額、収入額のID
let kakeiboId = document.getElementsByClassName('kakeibo-id');

// 削除ボタンの要素を取得
var deleteBtn = document.getElementById('delete-btn');

// 削除項目
var deleteSelectList = document.getElementById('select-delete-list');

// 削除承認ボタン
var confirmDelete = document.getElementById('confirm-delete');

var form = document.getElementById('form');

//全てのチェックボックスをON/OFFする
const funcCheckAll = (bool) => {
    for (let i = 0; i < el.length; i++) {
        el[i].checked = bool;
    }
};

// 支出学、収入額のチェックボックスがチェックされた時
const funcCheck = () => {
    let count = 0;
    for (let i = 0; i < el.length; i++) {
        if (el[i].checked) {
            count++;
        }
        if (count === 0) {
            deleteBtn.classList.remove('active');
        } else {
            deleteBtn.classList.add('active');
        }
    }
}

window.onload = function() {
    // 「全て選択」をクリックした時
    checkAll.onclick = function() {
            if (this.checked) {
                deleteBtn.classList.add('active');
                funcCheckAll(checkAll.checked);

            } else {
                deleteBtn.classList.remove('active');
                funcCheckAll(checkAll.checked);
            }
        }
        // 「全て選択」以外の項目をクリックした時
    for (let i = 0; i < el.length; i++) {
        el[i].onclick = function() {
            checkAll.checked = false;
            funcCheck();
        }
    }
}

var deleteButton = document.getElementById('delete-button');

// 削除ボタンを押した時
confirmDelete.addEventListener('click', function() {
    // 削除する項目のidを格納するための配列
    var deleteItems = [];
    // チェックがついている項目を全取得
    for (let i = 0; i < el.length; i++) {
        if (el[i].checked) {
            deleteItems.push(kakeiboId[i].value);
        }
    }
    console.log(deleteItems);
    // チェックがついている項目のみHTMLに追加
    for (let i = 0; i < deleteItems.length; i++) {
        let input = document.createElement('input');
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "delete_id[" + i + "]");
        input.setAttribute("value", deleteItems[i]);
        deleteSelectList.appendChild(input);
    }

    form.submit();
})