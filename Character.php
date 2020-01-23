<?php
class Character{
 
    private $conn;
    private $table_name = "characters";
 
    public $id;
    public $name;
    public $height;
    public $mass;
    public $hair_color;
    public $skin_color;
    public $eye_color;
    public $birth_year;
    public $gender;
    public $homeworld;
    public $species=[];
    public $films=[];
    public $starships=[];
    public $vehicles=[];
    public $url=[];

    public function __construct($db){
        $this->conn = $db;
    }

    function get_characters()
    {
        $query="SELECT * FROM characters WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $character = $stmt->fetch(PDO::FETCH_ASSOC);

        $query="SELECT * FROM planets WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $character['planet_id']);
        $stmt->execute();
        $planet = $stmt->fetch(PDO::FETCH_ASSOC);

        $query="SELECT * FROM species WHERE id IN (SELECT species_id FROM character_species WHERE character_id = ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $species = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $character_species = [];
        foreach ($species as $key => $species) {
            $character_species[] = 'http://localhost/swapi/species/'.$species['id'];
        }

        $query="SELECT * FROM films WHERE episode_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $character['film_id']);
        $stmt->execute();
        $film = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $character['id'];
        $this->name = $character['name'];
        $this->height = $character['height'];
        $this->mass = $character['mass'];
        $this->hair_color = $character['hair_color'];
        $this->skin_color = $character['skin_color'];
        $this->eye_color = $character['eye_color'];
        $this->birth_year = $character['birth_year'];
        $this->gender = $character['gender'];
        $this->homeworld = 'http://localhost/swapi/planets/'.$planet['id'];
        $this->species = $character_species;
        $this->films = ['http://localhost/swapi/films/'.$film['episode_id']];
        $this->starships = [];
        $this->vehicles = [];
        $this->url = "http://localhost/swapi/people/{$character['id']}";
}
}
?>