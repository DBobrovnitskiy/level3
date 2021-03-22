<div data-book-id="<?=$id?>" class="book_item col-xs-6 col-sm-3 col-md-2 col-lg-2">
                    <div class="book">
                        <a href="<?=self::HOST?>/book/<?=$id?>"><img src="<?=self::HOST?>/school_library/image/<?=$id?>.jpg" alt="<?=$book?>">
                            <div data-title="<?=$book?>" class="blockI" style="height: 46px;">
                                <div data-book-title="<?=$book?>" class="title size_text"><?=$book?></div>
                                <div data-book-author="<?=$authors?>" class="author"><?=$authors?></div>
                            </div>
                        </a>
                        <a href="<?=self::HOST?>/book/<?=$id?>">
                            <button type="button" class="details btn btn-success">Читать</button>
                        </a>
                    </div>
                </div>
