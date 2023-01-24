<?php
    class DatabaseMovieModel {
        const DATABASE_HOST = 'localhost';
        const DATABASE_USER = 'root';
        const DATABASE_PASS = '';
        const DATABASE_NAME = 'aglet_test';


        public function start_connection() {
            $con = mysqli_connect(self::DATABASE_HOST, self::DATABASE_USER, self::DATABASE_PASS, self::DATABASE_NAME);
            if ( mysqli_connect_errno() ) {
                // If there is an error with the connection, stop the script and display the error.
                exit('Failed to connect to MySQL: ' . mysqli_connect_error());
            }
            return $con;
            
        }

        public function fetchFavourites() {
            $con = $this->start_connection();
            $sql = "SELECT * FROM favourite_movies";
            $data = $con->query($sql);
            $movies = [];
            while($row = $data->fetch_object()){
                array_push($movies,$row);
            }
            return $movies;
        }

        public function fetchLatestMovie() {
            $con = $this->start_connection();
            $sql = "SELECT * FROM favourite_movies ORDER BY release_date DESC LIMIT 1";
            $data = $con->query($sql);
            $movie = $data->fetch_object();
            return $movie;
        }

        public function fetchMovie() {
            $con = $this->start_connection();
            $sql = "SELECT * FROM favourite_movies WHERE title=";
            $data = $con->query($sql);
            $movies = [];
            while($row = $data->fetch_object()){
                array_push($movies,$row);
            }
            return $movies;
        }
    }
?>