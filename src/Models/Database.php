<?php 
declare(strict_types=1);
namespace App\Models;
use \PDO;
use \Exception;


ini_set('display_errors', 1);
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

class Database
{
    protected $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=".HOST.";dbname=".DB.";port=".PORT, LOGIN, PASSWORD);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

        public function closeDbConnection() {
        try {
            $this->db = null;

        } catch (Exception $e) {
            echo $e->getMessage();
            throw $e;
            exit;
        }
    }
}


?>