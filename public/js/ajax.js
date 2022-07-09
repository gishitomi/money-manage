$(function() {
    //ボタンを押したタイミングで発火する
    $(document).on('blur', '#change-calendar', function() {
        console.log($('#change-calendar').val());
        let url = $('#change-calendar').val();
        $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "POST", //HTTP通信の種類
                url: "/changedate",
                data: { "url": url },
                dataType: "json"
            })
            //通信が成功したとき
            .done((data) => {
                //選択した日付に遷移
                window.location.href = '/kakeibo/' + data.url;
            })
            //通信が失敗したとき
            .fail((error) => {
                console.log(error.statusText);
            });
    });
});