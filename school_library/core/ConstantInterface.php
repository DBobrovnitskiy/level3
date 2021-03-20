<?php

namespace core;

interface ConstantInterface
{
    //host
    public const HOST = 'http://test1.local';
    public const DIRECTORY = '/media/home/project/www/test1.local/public_html/school_library';

    //Book page constant
    public const STANDARD_OFFSET = 5;
    public const STEPS = 5;

    //Admin page constant
    public const PAGINATION_SPACE = 3;
    public const BOOKS_ON_THE_PAGE = 5;

}