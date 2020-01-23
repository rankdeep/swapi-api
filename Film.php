<?php
class Film{
 
    private $conn;
   private $table_name = "films";
 
    public $title;
    public $episode_id;
    public $opening_crawl;
    public $director;
    public $producer;
    public $release_date;
    public $characters=[];
    public $planets=[];
    public $starships=[];
    public $vehicles=[];
    public $species=[];
    public $url=[];

    public function __construct($db){
        $this->conn = $db;
    }

    function get_films()
    {   
        $query="SELECT * FROM films WHERE episode_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->episode_id);
        $stmt->execute();
        $film = $stmt->fetch(PDO::FETCH_ASSOC);

        $query="SELECT * FROM characters WHERE id IN (SELECT character_id FROM film_characters WHERE film_id = ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->episode_id);
        $stmt->execute();
        $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $film_characters = [];
        foreach ($characters as $key => $character) {
            $film_characters[] = 'http://localhost/swapi/people/'.$character['id'];
        }

        $query="SELECT * FROM planets WHERE id IN (SELECT planet_id FROM species_planet WHERE film_id= ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->episode_id);
        $stmt->execute();
        $planets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $species_planet = [];
        foreach ($planets as $key => $planet) {
            $species_planet[] = 'http://localhost/swapi/planets/'.$planet['id'];
        }


        $this->title = $film['title'];
        $this->episode_id = $film['episode_id'];
        $this->opening_crawl = $film['opening_crawl'];
        $this->director = $film['director'];
        $this->producer = $film['producer'];
        $this->release_date = $film['release_date'];
        $this->characters = $film_characters;
        $this->planets = [];
        $this->starships = [];
        $this->vehicles = [];
        $this->species = [];
        $this->url = "http://localhost/swapi/films/{$film['episode_id']}";
}
}
?>