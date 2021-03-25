<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=self::HOST?>/school_library/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
            integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF"
            crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <ul class="navbar-nav mr-auto">
        <a class="navbar-brand" href="<?=self::HOST?>">HOME</a>
    </ul>
    <button id="logout" class="btn btn-outline-dark" type="button">Выйти</button>

</nav>


<div class="container-fluid">

    <div class="row">

        <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
            <table class="table table-sm table-striped">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Название</th>
                    <th scope="col" class="text-center">Авторы</th>
                    <th scope="col" class="text-center">Год</th>
                    <th scope="col" class="text-center">Действия</th>
                    <th scope="col" class="text-center">Клики</th>
                </tr>
                </thead>
                <tbody>
                <?=$itemsBooks?>
                </tbody>
            </table>
            <div class="text" style="background: #deebff">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?=$pagination?>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">

            <div class="container" style="background-color: #c9dae1">
                </br>
                <form id="addBook">
                    <div class="form-row">
                        <div class="form-group col-lg-7">
                            <input type="text" class="form-control" id="book" placeholder="Название книги" required>
                        </div>
                        <div class="form-group col-lg-5">
                            <input type="text" class="form-control" id="author1" placeholder="Автор1" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-7">
                            <input type="text" class="form-control" id="year" placeholder="Год" required>
                        </div>
                        <div class="form-group col-lg-5">
                            <input type="text" class="form-control" id="author2" placeholder="Автор2">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="custom-file col-lg-7">
                            <div class="input-group">
                                <input type="file" class="custom-file-input" id="image">
                                <label class="custom-file-label" for="image" data-browse="Выбрать файл"></label>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <input type="text" class="form-control" id="author3" placeholder="Автор3">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col col-lg-7">
                            <div class="text-center">
                                <img width="150" id="blah" src="<?=self::HOST?>/school_library/image/view.jpg" class="img-fluid"
                                     alt="Responsive image">
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <textarea class="form-control" id="about" rows="8"></textarea>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">Добавить</button>
                    </div>
                    </br>
                </form>
            </div>
            </br>
            </br>
            </br>
        </div>

    </div>
    <div class="row" style="background-color: #101010"> 1</div>
</div>

<script src="<?=self::HOST?>/school_library/js/admin.js" defer=""></script>


</body>
</html>
