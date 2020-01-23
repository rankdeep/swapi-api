<?php
class Starship{
 
    private $conn;
    private $table_name = "starships";
 
    public $name;
    public $id;
    public $model;
    public $manufacturer;
    public $cost_in_credits;
    public $length;
    public $max_atmosphering_speed;
    public $crew;
    public $consumables;
    public $passengers;
    public $cargo_capacity;
    public $hyperdrive_rating;
    public $MGLT;
    public $starship_class;
    public $pilots=[];
    public $films=[];
    public $url=[];

    public function __construct($db){
        $this->conn = $db;
    }

    function get_starships()
    {   
        $query="SELECT * FROM starships WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $starship = $stmt->fetch(PDO::FETCH_ASSOC);

        $query="SELECT * FROM films WHERE episode_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $starship['film_id']);
        $stmt->execute();
        $film = $stmt->fetch(PDO::FETCH_ASSOC);

        $query="SELECT * FROM characters WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $starship['pilot_id']);
        $stmt->execute();
        $pilot = $stmt->fetch(PDO::FETCH_ASSOC);


        $this->name = $starship['name'];
        $this->id = $starship['id'];
        $this->model = $starship['model'];
         $this->manufacturer = $starship['manufacturer'];
        $this->cost_in_credits = $starship['cost_in_credits'];
        $this->length = $starship['length'];
        $this->consumables = $starship['consumables'];
        $this->max_atmosphering_speed = $starship['max_atmosphering_speed'];
        $this->crew = $starship['crew'];
        $this->passengers = $starship['passengers'];
        $this->cargo_capacity = $starship['cargo_capacity'];
        $this->hyperdrive_rating = $starship['hyperdrive_rating'];
        $this->MGLT = $starship['MGLT'];
        $this->starship_class = $starship['starship_class'];
        $this->films = ['http://localhost/swapi/films/'.$film['episode_id']];
        $this->pilots = ['http://localhost/swapi/people/'.$pilot['id']];
        $this->url = "http://localhost/swapi/starships/{$starship['id']}";

}
}
?>