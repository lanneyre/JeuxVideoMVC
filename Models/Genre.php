<?php
    class Genre{

        static function getAllGenre(){
            return Database::getAll("genre");
        }

        function hydrate($id){
            return Database::getGenreById($id);
        }
    }