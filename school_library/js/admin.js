var host = 'http://library.local';

var image;
$("#image").change(function () {
    image = this.files
    if (image && image[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
        reader.readAsDataURL(image[0]); // convert to base64 string
    }
});

$('#addBook').submit(function (event) {
    event.preventDefault();
    var data = new FormData();
    data.append("operation", "AddBook");
    data.append("arg", "image");
    data.append("book", $("#book").val());
    data.append("year", $("#year").val());
    data.append("about", $("#about").val());
    data.append("authors[]", $("#author1").val());
    data.append("authors[]", $("#author2").val());
    data.append("authors[]", $("#author3").val());
    $.each(image, function (key, value) {
        data.append(key, value);
    });
    $.ajax({
        url: host + '/operations',
        method: 'POST',
        dataType: 'HTML',
        data: data,
        processData: false,
        contentType: false,
        success :function (data) {
            if(data === '{"ok": true}'){
                alert('Книга успешно добавлена!');
                $("#addBook")[0].reset();
                window.location.reload()
            }
        },
        error: function (jqXHR) {
            let massage = '\nКнига не добавлена!';
            if(jqXHR.responseText === '{"ok": "book"}'){
                alert('Название книги должно содержать только буквы и цыфры!' + massage);
            } else if(jqXHR.responseText === '{"ok": "author"}'){
                alert('Имя автора должно содержать как минимум 3 буквы!' + massage);
            }else if(jqXHR.responseText === '{"ok": "year"}'){
                alert('Поле год должно содержать 4 цыфры!' + massage);
            }else if(jqXHR.responseText === '{"ok": "image"}'){
                alert('Во время загрузки изображения произошла ошибка!' + massage);
            }else if(jqXHR.responseText === '{"ok": "noImage"}'){
                alert('Данный файл не является изображением!' + massage);
            }else if(jqXHR.responseText === '{"ok": "false"}'){
                alert('Произошла ошибка на сервере!' + massage);
            }
        }
    })
});


$(".deleteBook").click(function (e) {
    var arg = $(e.target).val();
    $.ajax({
        url: host + '/operations',
        method: 'POST',
        dataType: 'HTML',
        data: {"operation": "Delete", "arg": arg},
    }).done(function (data) {
        if (data === '{"ok": true}') {
            window.location.reload()
        }
    })
});


$('#logout').click(function (e) {
    $.ajax({
        url: host + '/school_library/logout.php',
        method: 'POST',
        dataType: 'JSON',
    }).done()
    location.assign(host);
});


