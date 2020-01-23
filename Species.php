<?php
class Species{
 
    private $conn;
    private $table_name = "species";
 
    public $name;
    public $id;
    public $classification;
    public $designation;
    public $average_height;
    public $skin_color;
    public $hair_color;
    public $eye_color;
    public $average_lifespan;
    public $people=[];
    public $homeworld=[];
    public $language;
    public $films=[];
    public $url=[];

    public function __construct($db){
        $this->conn = $db;
    }

    function get_species()
    {   
        $query="SELECT * FROM species WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $species = $stmt->fetch(PDO::FETCH_ASSOC);

        $query="SELECT * FROM planets WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $species['homeworld_id']);
        $stmt->execute();
        $planets = $stmt->fetch(PDO::FETCH_ASSOC);


        $query="SELECT * FROM characters WHERE id IN (SELECT people_id FROM species_planet WHERE species_id = ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $species_planet = [];
        foreach ($characters as $key => $character) {
            $species_planet[] = 'http://localhost/swapi/people/'.$character['id'];
        }

        $query="SELECT * FROM films WHERE episode_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $species['film_id']);
        $stmt->execute();
        $film = $stmt->fetch(PDO::FETCH_ASSOC);


        $this->name = $species['name'];
        $this->id = $species['id'];
        $this->classification = $species['classification'];
        $this->designation = $species['designation'];
        $this->average_height = $species['average_height'];
        $this->skin_color = $species['skin_color'];
        $this->hair_color = $species['hair_color'];
        $this->eye_color = $species['eye_color'];
        $this->average_lifespan = $species['average_lifespan'];
        $this->language = $species['language'];
        $this->films = ['http://localhost/swapi/films/'.$film['episode_id']];
        $this->people = $species_planet;
        $this->homeworld = 'http://localhost/swapi/planets/'.$planets['id'];
        $this->url = "http://localhost/swapi/species/{$species['id']}";

}
}
?>