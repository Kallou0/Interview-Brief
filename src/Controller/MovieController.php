<?php

namespace App\Controller;


class MovieController extends AbstractController
{ 
    private $session = false;
    public function __construct() {}

    //get movies movies
    public function index() {
        if(isset($_POST['search']))
        {
            $data_model = $this->model("DatabaseMovieModel");
            $con = $data_model->start_connection();
            $title = $_POST['title'];
            $sql = "SELECT * FROM favourite_movies WHERE title like %$title%";
            $data = $con->query($sql);
            $movies = [];
            if ($data != []) {
                while($row = $data->fetch_object()){
                    array_push($movies,$row);
                }
            }
            
            $latest_movie = $data_model->fetchLatestMovie();
            $this->render('movies/index.html.twig',['all_movies' => $movies, 'latest_movie' => $latest_movie]);
        }

        $data_model = $this->model("ApiMovieModel");
        $all_movies = $data_model->fetchMovies();

        //$page = intval($_GET['page']);
        $page = (isset($_GET['page'])) ? $_GET['page'] : 0;
        $page_size = 9;
        $total_records = count($all_movies);
        $total_pages   = ceil($total_records / $page_size);
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        if ($page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $page_size;
        $all_movies = array_slice($all_movies, $offset, $page_size);

        $latest_movie = $data_model->fetchLatestMovie();
        $this->render('movies/index.html.twig',['all_movies' => $all_movies, 'latest_movie' => $latest_movie]);
    }

    public function getFavourites() {
        $data_model = $this->model("DatabaseMovieModel");
        $movies = $data_model->fetchFavourites();
        $latest_movie = $data_model->fetchLatestMovie();
        $this->render('movies/favourites.html.twig',['movies' => $movies, 'latest_movie' => $latest_movie]);
    }

    public function addToFavourites() {
        $data_model = $this->model("DatabaseMovieModel");
        $con = $data_model->start_connection();
        if(isset($_POST['save']))
        {	 
            $title = $_POST['title'];
            $original_title = $_POST['original_title'];
            $original_language = $_POST['original_language'];
            $overview = $_POST['overview'];
            $poster_path = $_POST['poster_path'];
            $release_date = $_POST['release_date'];
            $vote_count = $_POST['vote_count'];
            $sql = "INSERT INTO favourite_movies (title,original_title,original_language,overview,poster_path,
            release_date,vote_count)
            VALUES ('$title','$original_title','$original_language','$overview','$poster_path','$release_date','$vote_count')";
            if (mysqli_query($con, $sql)) {
                $this->getFavourites();
            } else {
                echo "Error: " . $sql . "
                " . mysqli_error($con);
                }
            mysqli_close($con);
        }
    }

}