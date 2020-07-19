<?php

    abstract class C_Controller{

        abstract function render();//дизайн каждой страницы

        protected function Template($fileName, $vars=[]){

            foreach($vars as $key=>$values){

                $$key=$values;
           
            }

            ob_start();
            include($fileName);

            return ob_get_clean();

        }

        function  CheckForm($value){

            if(is_array($value)){

                foreach($value as $key=>$array){

                    $array = trim($array);
                    $array = stripslashes($array);
                    $array = strip_tags($array);
                    $array = htmlspecialchars($array);

                    $value[$key]=$array;

                }

            } else {

                  $value = trim($value);
                  $value = stripslashes($value);
                  $value = strip_tags($value);
                  $value = htmlspecialchars($value);

            }

            return $value;

        }
                        
        function generateSalt() {

            $salt = '';
            $length = rand(5,10);

            for($i=0; $i<$length; $i++) {

                $salt .= chr(rand(33,126));

            }

            return $salt;

        }

    function Regular($str_email,$str_name){

        $reg_email="/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u";

        $result=preg_match_all($reg_email,$str_email);

        if(!$result){

            $answer['email']= 'Email';

        }


        $reg_name='/^[а-яА-ЯёЁa-zA-Z ]+$/u';

        $result=preg_match_all($reg_name,$str_name);

        if(!$result){

           $answer['name']= 'ФИО';

        }

        return($answer);

     }




                          

    }
    ?>