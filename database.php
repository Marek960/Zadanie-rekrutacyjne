<?php
//Baza
class database{
   public $servername = "localhost";
   public $username = "root";
   public $password = "";
   public $dbName = "zadanie";
   public $conn= "";

    function __construct(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password);
        if ($this->conn->connect_error) {
            die("Blad polaczenia: " . $this->conn->connect_error);
        }
    }

    function create(){//tworzenie bazy i tabeli + polaczenie
        // polaczenie
        $this->conn = new mysqli($this->servername, $this->username, $this->password);
        // tworzenie bazy
        if (!mysqli_select_db($this->conn,$this->dbName)){
            $sql = "CREATE DATABASE ".$this->dbName;
            if ($this->conn->query($sql) === TRUE) {
                echo "Baza danych utworzona";
            }else {
                echo "Blad: " . $this->conn->error;
            }
        } 
        //Tabela
        mysqli_select_db($this->conn,"zadanie");
        //jesli nie ma id to z result pusty, wiec tworzymy emails tabele.
        $query = "SELECT id FROM emails";
        $result = mysqli_query($this->conn, $query);

        if(empty($result)) {
                        $query = "CREATE TABLE emails (
                                id int(11) AUTO_INCREMENT,
                                email varchar(255) NOT NULL,
                                PRIMARY KEY  (ID)
                                )";
                        $result = mysqli_query($this->conn, $query);
                        }
        mysqli_close($this->conn);

        }

        function add(){
            $this->conn = new mysqli($this->servername, $this->username, $this->password);
            mysqli_select_db($this->conn,"zadanie");

            $sql = "INSERT INTO emails (email) VALUES
            ('jankowalki@wp.pl'),
            ('janniekowalski@gmail.com'),
            ('adamsciana@wp.pl'),
            ('obrotowekrzeslo@onet.pl'),
            ('laptopyxxx@mail.org'),
            ('testowymail@wp.pl'),
            ('krzys22@mail.org'),
            ('marekmarek@gmail.com')";

                if(mysqli_query($this->conn, $sql)){
                    echo "Dodano rekordy";
                } else{
                    echo "Blad: $sql. " . mysqli_error($this->conn);
                }
            mysqli_close($this->conn);
        }

        function countDomain(){
            $this->conn = new mysqli($this->servername, $this->username, $this->password);
            mysqli_select_db($this->conn,"zadanie");

            $query = "SELECT email FROM emails";
            $result = mysqli_query($this->conn, $query);

            $tabDomain = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $domainWithFile = [];
                  $domainWithFile = explode('@', $row['email'])[1];
                  if(isset($domainWithFile)){
                      array_push($tabDomain,$domainWithFile);
                  }
                }
              } else {
                echo "Brak wyniku";
              }
              echo '<br>';
              $values=array_count_values($tabDomain) ;

              foreach ($values as $key=>$value) {
                echo $key ." X ". $value;
                echo '<br>';
            }
               mysqli_close($this->conn);
        }

    }
