<?php
class Vehicle{
 
    private $conn;
    private $table_name = "vehicles";
 
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
    public $vehicle_class;
    public $pilots=[];
    public $films=[];
    public $url=[];

    public function __construct($db){
        $this->conn = $db;
    }

    function get_vehicles()
    {   
        $query="SELECT * FROM vehicles WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

        $query="SELECT * FROM films WHERE episode_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $vehicle['film_id']);
        $stmt->execute();
        $film = $stmt->fetch(PDO::FETCH_ASSOC);


        $this->name = $vehicle['name'];
        $this->id = $vehicle['id'];
        $this->model = $vehicle['model'];
         $this->manufacturer = $vehicle['manufacturer'];
        $this->cost_in_credits = $vehicle['cost_in_credits'];
        $this->length = $vehicle['length'];
        $this->consumables = $vehicle['consumables'];
        $this->max_atmosphering_speed = $vehicle['max_atmosphering_speed'];
        $this->crew = $vehicle['crew'];
        $this->passengers = $vehicle['passengers'];
        $this->cargo_capacity = $vehicle['cargo_capacity'];
        $this->vehicle_class = $vehicle['vehicle_class'];
        $this->films = ['http://localhost/swapi/films/'.$film['episode_id']];
        $this->pilots = [];
        $this->url = "http://localhost/swapi/vehicles/{$vehicle['id']}";

}
}
?>