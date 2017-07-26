<?php
/**
 * Created by PhpStorm.
 * User: yav
 * Date: 25.07.17
 * Time: 12:12
 */


require __DIR__.'/../app/vendor/autoload.php';
define("MIGRATIONS_PATH", dirname(__DIR__,1)."/app/db/migrations");
define("SEEDS_PATH", dirname(__DIR__,1)."/app/db/seeds");
/**
 * Script for creating, destroying, and seeding the app's database
 */
class Migrate {
    function __construct($args)
    {
        $this->args = $args;
    }
    function help()
    {
        echo "\n";
        echo "syntax: php migrate <command> [<args>]".PHP_EOL;
        echo PHP_EOL;
        echo "Commands: \n";
        echo "php migrate --help                  -->   Displays the help menu.".PHP_EOL;
        echo "php migrate migrate                 -->   Migrate the database.".PHP_EOL;
        echo "php migrate seed                    -->   Seed the database tables.".PHP_EOL;
        echo "php migrate migrate --seed   -->   Migrate and seed the database.".PHP_EOL;
        echo PHP_EOL;
    }
    function exec()
    {

        if (count($this->args) <= 1) {
            $this->help();
        } else {
            switch ($this->args[1]) {
                case "migrate":
                    $this->runMigrations();
                    if (!isset($this->args[2]) || $this->args[2] != '--seed')
                        break;
                case "seed":
                    $this->runSeed();
                    break;
                case "help":
                case "--help":
                    $this->help();
                    break;
            }
        }
    }
    function runMigrations()
    {
        $files = glob(MIGRATIONS_PATH.'/*.php');
        $this->run($files);

    }
    function runSeed()
    {
        $files = glob(SEEDS_PATH.'/*.php');
        $this->run($files);
    }

    private function run($files)
    {
        foreach ($files as $file) {
            require_once($file);
            $class = basename($file, '.php');
            $obj = new $class;
            $obj->run();
        }
    }
}
$novice = new Migrate($argv);
$novice->exec();