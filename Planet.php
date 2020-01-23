<?php
class Planet{
 
    private $conn;
    private $table_name = "planets";
 
    public $name;
    public $id;
    public $rotation_period;
    public $orbital_period;
    public $diameter;
    public $climate;
    public $gravity;
    public $terrain;
    public $surface_water;
    public $population;
    public $residents=[];
    public $films=[];
    public $url=[];

    public function __construct($db){
        $this->conn = $db;
    }

    function get_planets()
    {   
        $query="SELECT * FROM planets WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $planets = $stmt->fetch(PDO::FETCH_ASSOC);

        $query="SELECT * FROM characters WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $planets['people_id']);
        $stmt->execute();
        $people = $stmt->fetch(PDO::FETCH_ASSOC);

        $query="SELECT * FROM films WHERE episode_id IN (SELECT film_id FROM species_planet WHERE planet_id = ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $films = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $species_planet = [];
        foreach ($films as $key => $film) {
            $species_planet[] = 'http://localhost/swapi/films/'.$film['episode_id'];
        }

        $this->name = $planets['name'];
        $this->id = $planets['id'];
        $this->rotation_period = $planets['rotation_period'];
         $this->orbital_period = $planets['orbital_period'];
        $this->diameter = $planets['diameter'];
        $this->climate = $planets['climate'];
        $this->gravity = $planets['gravity'];
        $this->terrain = $planets['terrain'];
        $this->surface_water = $planets['surface_water'];
        $this->population = $planets['population'];
        $this->residents = ['http://localhost/swapi/people/'.$people['id']];
        $this->films = $species_planet;
        $this->url = "http://localhost/swapi/planets/{$planets['id']}";
}
}
?>