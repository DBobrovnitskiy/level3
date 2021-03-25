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
        $this->pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
    }

    /**
     * Starts the process of updating the database
     */
    public function run()
    {
        try {
            $this->researchStory();
            $fileList = scandir('./');
            foreach ($fileList as $fileName) {
                if (preg_match('/([0-9]{3}).+(\.sql)/', $fileName)) {
                    $this->processing($fileName);
                }
            }
            echo "Database Complete!\n";
        }catch (Exception $e){
            echo "Something wrong!\n";
        }
    }

    /**
     * Migrates by filename
     *
     * @param $fileName
     * @return bool
     */
    private function migration($fileName): bool
    {
        $command = file_get_contents($fileName);
        echo $fileName . ' ====> ';
        return $this->pdo->exec($command) !== false;
    }

    /**
     * Tries to find the "story_table" table in the database
     *
     * @return bool
     */
    private function findStoryTable(): bool
    {
        $exec = $this->pdo->query("SHOW TABLES LIKE 'story_table'");
        return $exec->rowCount();
    }

    /**
     * Creates a table "story_table" in the database
     *
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
     * Writes the migration to the "story_table" table
     *
     * @param $fileName
     */
    private function writeToStory($fileName)
    {
        $command = "INSERT INTO `story_table` (`id`, `sql_file`, `data`) VALUES (NULL, '" . $fileName .
            "', current_timestamp()); ";
        $this->pdo->exec($command);
    }

    /**
     * Looking for migration in the "story_table" table
     *
     * @param $fileName
     * @return bool
     */
    private function findFileInTheStory($fileName): bool
    {
        $exec = $this->pdo->query("SELECT * FROM `story_table` WHERE `sql_file` LIKE '" . $fileName . "'");
        return $exec->rowCount();
    }

    /**
     * Handles action on file name
     * Can migration or not, depending on the records
     * in the "story_table" table
     *
     * @param $fileName
     * @throws Exception
     */
    private function processing($fileName)
    {
        if ($this->findFileInTheStory($fileName) !== false) {
            return;
        }
        if (!$this->migration($fileName)) {
            echo "fail\n\n";
            throw new Exception('Error!!!');
        }
        echo "ok\n\n";
        $this->writeToStory($fileName);
    }

    /**
     * Looks for the table "story_table" in the database,
     * and if it does not find it creates it
     *
     * @throws Exception
     */
    private function researchStory()
    {
        if ($this->findStoryTable()) {
            return;
        }
        if ($this->createStoryTable() === false) {
            echo 'error!';
            throw new Exception('Error Story');
        }
    }

}