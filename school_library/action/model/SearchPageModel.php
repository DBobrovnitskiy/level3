<?php

namespace action\model;

use core\AbstractModel;

class SearchPageModel extends AbstractModel
{

    /**
     * Creates content and put it in an array
     *
     * @return array
     */
    protected function createContentArray(): array
    {
        // TODO: Implement createContentArray() method.
        $request = $this->param;
        $content = ($request === false) ? [] : $this->getContent($request);
        return array(
            'content' => $content,
            'massage' => $this->getMassage($request, $content)
        );
    }

    /**
     * Sets a query to the database;
     * the result is returned as content
     *
     * @param $request
     * @return array
     */
    private function getContent($request): array
    {
        $contentArray = array();
        $command = ("SELECT b.book_id, b.book, b.year, GROUP_CONCAT(DISTINCT a.author ORDER BY a.author ASC) AS " .
            "'authors' FROM `books` b JOIN relation USING(book_id) JOIN `authors` a USING(author_id) WHERE " .
            "book LIKE :search OR author LIKE :search OR year LIKE :search GROUP BY book_id"
        );
        $rows = $this->sql->runSqlCommand($command, array(':search' => "%" . $request . "%"));
        while ($row = $rows->fetch()) {
            $contentArray[] = $row;
        }
        return $contentArray;
    }

    /**
     * Generates a supplementary message based on search results
     *
     * @param $request
     * @param $content
     * @return string
     */
    protected function getMassage($request, $content): string
    {
        if ($request === false) {
            return 'Некорректный запрос';
        }
        if ($content == false) {
            return 'Поиск по запросу "' . $request . '" не дал результата';
        }
        return 'Результат поиска по запросу "' . $request . '":';
    }
}
