<?php
    class ApiMovieModel {
        const API_KEY = 'ef5798629f334e2867cacdf593f3e225';

        public function fetchMovies() {
            $data = file_get_contents('https://api.themoviedb.org/3/movie/popular?api_key='.self::API_KEY); //we could use Curl or GuzzleHttp is we had an API with endpoints supporting all HTTP request methods
            $json_data = json_decode($data, true);
            $movies = $json_data['results'];
            
            return $movies;
            
        }

        public function fetchLatestMovie() {
            $data = file_get_contents('https://api.themoviedb.org/3/movie/latest?api_key='.self::API_KEY); //we could use Curl or GuzzleHttp is we had an API with endpoints supporting all HTTP request methods
            $latest_movies = json_decode($data, true);
            
            return $latest_movies;
        }

        public function addToFavourites($movie) {
            
            
        }
    }
?>