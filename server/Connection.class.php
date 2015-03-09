<?php

class Connection {

    protected $connection = 'localhost';
    protected $database = 'database';
    protected $user = 'user';
    protected $password = 'password';
    protected $c;
    protected $db;

    public function __construct() {

        $this->c = mysql_connect($this->connection, $this->user, $this->password)
                or die("N�o foi possivel estabelecer a conex�o com o banco de dados: " . mysql_error());

        $this->db = mysql_select_db($this->database, $this->c);
    }

    public function close() {

        mysql_close($this->c);

        unset($this->connection);
        unset($this->database);

        unset($this->user);
        unset($this->password);

        unset($this->c);
        unset($this->db);
    }

}

?>