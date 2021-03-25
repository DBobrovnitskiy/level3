<?php

namespace action\operations;

/**
 * Class ValidationsFormClass
 * checks the correctness of filling
 * out the form on the "admin" page
 *
 * @package action\operations
 */
class ValidationsFormClass
{
    /**
     * Starts the form validation process
     * returns an empty string if the form is filled incorrectly
     * returns an error message if one is found
     *
     * @return string
     */
    public static function validation(): string
    {
        self::cleanRequest();
        if (($form = self::validationForm()) !== '') {
            return $form;
        }
        return self::validationImage();
    }

    /**
     * Escapes and removes spaces before and after forms inputs
     */
    private static function cleanRequest()
    {
        self::processingString($_POST['book']);
        self::processingString($_POST['year']);
        self::processingString($_POST['about']);
        foreach ($_POST['authors'] as &$author) {
            self::processingString($author);
        }
    }

    /**
     * Checking the form for correct information input
     *
     * @return string
     */
    private static function validationForm(): string
    {
        if (preg_replace("/[a-zA-Zа-яА-Я0-9 ієїё+\-№#$]/iu", '', $_POST['book']) !== '') {
            return '{"ok": "book"}';
        }
        if (preg_replace("/[0-9]{4}/", '', $_POST['year']) !== '') {
            return '{"ok": "year"}';
        }
        foreach ($_POST['authors'] as &$author) {
            if (preg_replace('/[a-zA-Zа-яА-Я ієїё-]{3,}/iu', '', $author) !== '') {
                return '{"ok": "author"}';
            }
        }
        return '';
    }

    /**
     * Escapes and removes spaces before and after input
     *
     * @param $string
     * @return string
     */
    private static function processingString(&$string): string
    {
        $string = trim($string);
        $string = stripslashes($string);
        $string = strip_tags($string);
        return htmlspecialchars($string);
    }

    /**
     * Checks if the given file is an image
     *
     * @return string
     */
    private static function validationImage(): string
    {
        if (!isset($_FILES[0])) {
            return '';
        }
        if (!file_exists($_FILES[0]['tmp_name'])) {
            return '{"ok": "image"}';
        }
        if (preg_replace('/(image\/).+/', '', $_FILES[0]['type']) !== '') {
            return '{"ok": "noImage"}';
        }
        return '';
    }
}