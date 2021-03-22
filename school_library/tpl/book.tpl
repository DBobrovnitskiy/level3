<!DOCTYPE html>
<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>shpp-library</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="library Sh++">

    <link rel="stylesheet" href="<?=self::HOST?>/school_library/css/libs.min.css">
    <link rel="stylesheet" href="<?=self::HOST?>/school_library/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
          crossorigin="anonymous"/>

    <link rel="shortcut icon" href="http://localhost:3000/book/favicon.ico">
</head>

<body data-gr-c-s-loaded="true" class="">
<section id="header" class="header-wrapper"><?=$header?></section>
<section id="main" class="main-wrapper">
    <div class="container">
        <div id="content" class="book_block col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <script id="pattern" type="text/template">
                <div data-book-id="{id}" class="book_item col-xs-6 col-sm-3 col-md-2 col-lg-2">
                    <div class="book">
                        <a href="/book/{id}"><img src="img/books/{id}.jpg" alt="{title}">
                            <div data-title="{title}" class="blockI">
                                <div data-book-title="{title}" class="title size_text">{title}</div>
                                <div data-book-author="{author}" class="author">{author}</div>
                            </div>
                        </a>
                        <a href="/book/{id}">
                            <button type="button" class="details btn btn-success">Читать</button>
                        </a>
                    </div>
                </div>
            </script>
            <div id="id" book-id="<?=$id?>">
                <div id="bookImg" class="col-xs-12 col-sm-3 col-md-3 item" style="
    margin:;
"><img src="<?=self::HOST?>/school_library/image/<?=$id?>.jpg" alt="Responsive image" class="img-responsive">

                    <hr>
                </div>
                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 info">
                    <div class="bookInfo col-md-12">
                        <div id="title" class="titleBook"><?=$book?></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="bookLastInfo">
                            <div class="bookRow"><span class="properties">автор:</span><span
                                        id="author"><?=$authors?></span></div>
                            <div class="bookRow"><span class="properties">год:</span><span id="year"><?=$year?></span>
                            </div>
                            <div class="bookRow"><span class="properties">страниц:</span><span
                                        id="pages"><?=$pages?></span></div>
                            <div class="bookRow"><span class="properties">isbn:</span><span id="isbn"></span></div>
                        </div>
                    </div>
                    <div class="btnBlock col-xs-12 col-sm-12 col-md-12">
                        <button type="button" class="btnBook<?=$id?> btn-lg btn btn-success">Хочу читать!</button>
                    </div>
                    <div class="bookDescription col-xs-12 col-sm-12 col-md-12 hidden-xs hidden-sm">
                        <h4>О книге</h4>
                        <hr>
                        <p id="description"><?=$about?></p>
                    </div>
                </div>
                <div class="bookDescription col-xs-12 col-sm-12 col-md-12 hidden-md hidden-lg">
                    <h4>О книге</h4>
                    <hr>
                    <p class="description"><?=$about?></p>
                </div>
            </div>
            <script>
                $('.btnBook<?=$id?>').click(function (event) {
                    $.ajax({
                        url: 'http://test1.local/operations',
                        method: 'POST',
                        dataType: 'HTML',
                        data: {"operation": "Click", "arg": <?=$id?>},
                    }).done(function (data) {
                        if (data === '{"ok": true}') {
                            alert(
                                "Книга свободна и ты можешь прийти за ней." +
                                " Наш адрес: г. Кропивницкий, переулок Васильевский 10, 5 этаж." +
                                " Лучше предварительно прозвонить и предупредить нас, чтоб " +
                                " не попасть в неловкую ситуацию. Тел. 099 196 24 69" +
                                " \n\n"
                            );
                        }
                    })
                });
            </script>
        </div>
    </div>
</section>
<section id="footer" class="footer-wrapper"><?=$footer?></section>
<div class="sweet-overlay" tabindex="-1" style="opacity: -0.04; display: none;"></div>
<div class="sweet-alert hideSweetAlert" data-custom-class="" data-has-cancel-button="false"
     data-has-confirm-button="true" data-allow-outside-click="false" data-has-done-function="false" data-animation="pop"
     data-timer="null" style="display: none; margin-top: -169px; opacity: -0.04;">
    <div class="sa-icon sa-error" style="display: block;">
            <span class="sa-x-mark">
        <span class="sa-line sa-left"></span>
            <span class="sa-line sa-right"></span>
            </span>
    </div>
    <div class="sa-icon sa-warning" style="display: none;">
        <span class="sa-body"></span>
        <span class="sa-dot"></span>
    </div>
    <div class="sa-icon sa-info" style="display: none;"></div>
    <div class="sa-icon sa-success" style="display: none;">
        <span class="sa-line sa-tip"></span>
        <span class="sa-line sa-long"></span>

        <div class="sa-placeholder"></div>
        <div class="sa-fix"></div>
    </div>
    <div class="sa-icon sa-custom" style="display: none;"></div>
    <h2>Ооопс!</h2>
    <p style="display: block;">Ошибка error</p>
    <fieldset>
        <input type="text" tabindex="3" placeholder="">
        <div class="sa-input-error"></div>
    </fieldset>
    <div class="sa-button-container">
        <button class="cancel" tabindex="2" style="display: none; box-shadow: none;">Cancel</button>
        <div class="sa-confirm-button-container">
            <button class="confirm" tabindex="1"
                    style="display: inline-block; background-color: rgb(140, 212, 245); box-shadow: rgba(140, 212, 245, 0.8) 0px 0px 2px, rgba(0, 0, 0, 0.05) 0px 0px 0px 1px inset;">
                OK
            </button>
            <div class="la-ball-fall">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</div>
</body>

</html>