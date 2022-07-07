$(function() {
    //ボタンを押したタイミングで発火する
    $(document).on('blur', '#test-calendar', function() {
        console.log($('#test-calendar').val());
        let url = $('#test-calendar').val();
        $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "POST", //HTTP通信の種類
                url: "/changedate",
                data: { "url": url },
                dataType: "json"
            })
            //通信が成功したとき
            .done((data) => {
                console.log(data);
                //選択した日付に遷移
                window.location.href = '/kakeibo/' + data.url;
            })
            //通信が失敗したとき
            .fail((error) => {
                console.log(error.statusText);
            });
    });
});