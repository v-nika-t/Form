<?php

class C_Base extends C_Controller {

        protected $title;//Заголовок
        protected $fileName;//Имя шаблона
        protected $content;

    
        function render(){

            $this->vars['title']=$this->title;
            $this->vars['content']=$this->content;
            $page=$this->Template($this->fileName, $this->vars);
            echo  $page;
    
        }

        function Form(){//проверка входа в личный кабинет

            $login=parent::CheckForm($_GET['login']);//проверка внесённых данных
            $password=parent::CheckForm($_GET['password']);

            if($login &&  $password){

                 $content=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/users.xml');
                 $users=new SimpleXMLElement($content);

                 foreach($users->user as $item){

                     if($login == $item->login){

                         $result['salt']=$item->salt;
                         $result['password']=$item->password;
                         $result['name']= (string) ($item->name);

                     }

                 }

                if($result){ //есть user c данным логином

                    if(md5($password.$result['salt']) == $result['password']){//совпадает  пароль введенный и с БД


                        session_start();

                        $_SESSION['nameUser_rNzTWBtGEZNozETWvgM7']= $result['name'];

                        $answer['name']=$result['name'];



                    } else { //если пароль неверный

                          $answer['result']='Неверный пароль';

                    }

                } else {// пользователь не найден

                      $answer['result']='Пользователь не найден. Зарегистрируйтесь';

                }

            } else {//Не заполнено одно из полей

                 $answer['result']='Заполните все поля';

            }

           echo json_encode($answer);

        }

        function Registration(){//регистрация пользователя


            $_POST=parent::CheckForm($_POST);


            if($_POST['login'] &&  $_POST['password'] && $_POST['email'] && $_POST['name']){//если все данные заполнены

                $result_regular=parent::Regular($_POST['email'],$_POST['name']);//проверка данных регулярными выражениями

                if($result_regular){

                    $length=count($result_regular)-1;
                    $i=0;

                    foreach($result_regular as $array){

                        if($i == $length){

                            $flag.= $array;
                        } else {

                            $flag.= $array.",";

                        }

                        $i++;

                    }

                    $answer['result']='Введите корректно '.$flag;


                } else {

                    $content=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/users.xml');
                    $users=new SimpleXMLElement($content);

                    foreach($users->user as $item){

                        if($_POST['login'] == $item->login){

                            $result['login']="Пользователь с таким логином уже зарегистрирован";

                        }

                        if($_POST['email'] == $item->email){

                            $result['email']="Пользователь с таким email уже зарегистрирован";

                        }

                    }

                    if(!$result){// если нет юзера, c данным логином, то даем задание на внесение в БД

                        $salt=parent::generateSalt();
                        $password=md5($_POST['password'].$salt);

                        $content=file_get_contents($_SERVER['DOCUMENT_ROOT'].'/users.xml');
                            $xml=new SimpleXMLElement($content);

                            $users=$xml->addChild('user');

                                $users->addChild('login', $_POST['login']);
                                $users->addChild('email', $_POST['email']);
                                $users->addChild('name', $_POST['name']);
                                $users->addChild('password', $password);
                                $users->addChild('salt', $salt);


                        $xml->asXML($_SERVER['DOCUMENT_ROOT'].'/users.xml');

                        session_start();
                        $_SESSION['nameUser_rNzTWBtGEZNozETWvgM7']= $_POST['name'];

                        $answer['name']=$_POST['name'];

                    } else {//если есть юзер, c данным логином


                          $answer['result']=$result['login'].".".$result['email'];

                    }

                }

            } else {//Если есть пустые поля

                  $answer['result']='Заполните все поля';


            }

            echo json_encode($answer);


        }



    }

?>