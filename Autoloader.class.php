<?php 

    class Autoloader{

        public static function register(){
        
            ini_set('unserialize_callback_func','spl_autoload_call');
            spl_autoload_register([new self,'autoload']);
                                 
        }
    
        public static function autoload($className) {

            $array_dir=[
      
                'controller'
                
                        ];

                foreach($array_dir as $array){
    
                    $filename=$_SERVER['DOCUMENT_ROOT']."/".$array."/".$className.".class.php";

                    if(is_file($filename)){

                        require_once($filename);
        
                    }

                }
    
        }
    
    }




?>