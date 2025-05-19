<?php

class IndianStateCity {
    private $pdo;

    public function connect() {
        $host = 'localhost';
        $db   = 'indian_state_district_city';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new \PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getStates() {
        if ($this->pdo === null) {
            $this->connect();
        }
        $stmt = $this->pdo->query("SELECT * FROM state");
        return $stmt->fetchAll();
    }

    public function addState($state_title, $state_description) {
        if ($this->pdo === null) {
            $this->connect();
        }
        $stmt = $this->pdo->prepare("INSERT INTO state (state_title, state_description) VALUES (?, ?)");
        $stmt->execute([$state_title, $state_description]);
        return $this->pdo->lastInsertId();
    }

    public function getDistricts($stateId) {
        if ($this->pdo === null) {
            $this->connect();
        }
        $stmt = $this->pdo->prepare("SELECT * FROM district WHERE state_id = ?");
        $stmt->execute([$stateId]);
        return $stmt->fetchAll();
    }

    public function getCities($districtId) {
        if ($this->pdo === null) {
            $this->connect();
        }
        $stmt = $this->pdo->prepare("SELECT * FROM city WHERE districtid = ?");
        $stmt->execute([$districtId]);
        return $stmt->fetchAll();
    }
}