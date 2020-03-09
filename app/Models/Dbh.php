<?php
//phpinfo();

namespace app\Models;
use PDO;

class Dbh {
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "pracownia_pizzy";
    private $charset = "utf8";

    public function Connect() {
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName.';charset='.$this->charset;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}

/* require 'vendor/autoload.php';
    use app\Models\Dbh; */