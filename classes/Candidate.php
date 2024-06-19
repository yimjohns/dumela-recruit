<?php
class Candidate {
    private $conn;
    private $table = 'candidates';

    public $id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $email;
    public $country;
    public $state;
    public $city;
    public $job_title;
    public $level;
    public $resume;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' SET
            first_name = :first_name,
            middle_name = :middle_name,
            last_name = :last_name,
            email = :email,
            country = :country,
            state = :state,
            city = :city,
            job_title = :job_title,
            level = :level,
            resume = :resume';

        $stmt = $this->conn->prepare($query);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->middle_name = htmlspecialchars(strip_tags($this->middle_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->state = htmlspecialchars(strip_tags($this->state));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->job_title = htmlspecialchars(strip_tags($this->job_title));
        $this->level = htmlspecialchars(strip_tags($this->level));
        $this->resume = htmlspecialchars(strip_tags($this->resume));

        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':middle_name', $this->middle_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':state', $this->state);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':job_title', $this->job_title);
        $stmt->bindParam(':level', $this->level);
        $stmt->bindParam(':resume', $this->resume);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function read() {
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET
            first_name = :first_name,
            middle_name = :middle_name,
            last_name = :last_name,
            email = :email,
            country = :country,
            state = :state,
            city = :city,
            job_title = :job_title,
            level = :level,
            resume = :resume
            WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->middle_name = htmlspecialchars(strip_tags($this->middle_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->country = htmlspecialchars(strip_tags($this->country));
        $this->state = htmlspecialchars(strip_tags($this->state));
        $this->city = htmlspecialchars(strip_tags($this->city));
        $this->job_title = htmlspecialchars(strip_tags($this->job_title));
        $this->level = htmlspecialchars(strip_tags($this->level));
        $this->resume = htmlspecialchars(strip_tags($this->resume));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':middle_name', $this->middle_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':state', $this->state);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':job_title', $this->job_title);
        $stmt->bindParam(':level', $this->level);
        $stmt->bindParam(':resume', $this->resume);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>