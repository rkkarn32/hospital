<?php
    class Logger{
        static private $filename="log.php";
        
        static public function LogInformation($message){
            $file = fopen(Logger::$filename ,"a+");
            date_default_timezone_set('Asia/Katmandu');
            fputs($file,  date("Y-M-d  H:i:s")." ==> ".$message."\r\n" );
            fclose($file);
        }
    }
?>
