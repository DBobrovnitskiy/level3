<?php


class MigrationClass
{
    private $pdo;

    /**
     * RunSqlClass constructor.
     * @param $host
     * @param $dbName
     * @param $user
     * @param $pass
     */
    public function __construct($host, $dbName, $user, $pass)
    {
        $this->pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
    }

    /**
     *
     * @throws Exception
     */
    public function run(): void
    {
        $this->researchStory();
        $fileList = scandir('./');
        foreach ($fileList as $fileName) {
            if (preg_match('/([0-9]{3}).+(\.sql)/', $fileName)) {
                $this->processing($fileName);
            }
        }
    }

    /**
     * @param $fileName
     * @return bool
     */
    private function migration($fileName): bool
    {
        $command = file_get_contents($fileName);
        return $this->pdo->exec($command) !== false;
    }

    /**
     * @return bool
     */
    private function findStoryTable(): bool
    {
        $exec = $this->pdo->query("SHOW TABLES LIKE 'story_table'");
        return $exec->rowCount();
    }

    /**
     * @return bool
     */
    private function createStoryTable(): bool
    {
        $command = "CREATE TABLE `story_table` ( `id` INT(11) NOT NULL AUTO_INCREMENT , " .
            "`sql_file` VARCHAR(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL , " .
            "`data` DATETIME on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , " .
            "PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        return $this->pdo->query($command) !== false;
    }

    /**
     * @param $fileName
     */
    private function writeToStory($fileName): void
    {
        $command = "INSERT INTO `story_table` (`id`, `sql_file`, `data`) VALUES (NULL, '" . $fileName .
            "', current_timestamp()); ";
        $this->pdo->exec($command);
    }

    /**
     * @param $fileName
     * @return bool
     */
    private function findFileInTheStory($fileName): bool
    {
        $exec = $this->pdo->query("SELECT * FROM `story_table` WHERE `sql_file` LIKE '" . $fileName . "'");
        return $exec->rowCount();
    }

    /**
     * @param $fileName
     * @throws Exception
     */
    private function processing($fileName): void
    {
        if ($this->findFileInTheStory($fileName) !== false) {
            return;
        }
        if (!$this->migration($fileName)) {
            throw new Exception('Error!!!');
        }
        $this->writeToStory($fileName);
    }

    /**
     * @throws Exception
     */
    private function researchStory(): void
    {
        if ($this->findStoryTable()) {
            return;
        }
        if ($this->createStoryTable() === false) {
            throw new Exception('Error Story');
        }
    }

}