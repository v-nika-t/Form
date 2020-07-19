<?php


    class C_Main extends C_Base {

        function View(){

            session_start();

                $this->title="Главная";
                $this->fileName=$_SERVER['DOCUMENT_ROOT']."/templates/main.php";

                $this-> render();

        }

        function Logout(){//Выход с личного кабинета

            session_start();
            session_destroy();
            session_abort();
            session_reset();

            header('location: index.php');

        }

    }

?>