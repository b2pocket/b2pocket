<?php


 //require_once(app_path() . '\Klase\jasper\autoload.dist.php');
require_once 'jasper/autoload.dist.php';
use Jaspersoft\Client\Client;
//use Laravel\cmatMPOApps\nivelacije\objekti as objekti;

    // include(app_path() . '\Klase\jasper\autoload.dist.php');
       //require_once 'jasper/autoload.dist.php';
        //use Jaspersoft\Client\Client;
    
        $c = new Client(
                "http://localhost:8081/jasperserver",
                "jasperadmin",
                "jasperadmin",
                ""
              ); 

          $id=$_REQUEST['id'];

              $controls = array(
              // 'p_orgjed' =>$p_orgjed //'2017.03',//$mesec,
                'p_id' =>$id
                

               );

            $report = $c->reportService()->runReport('/reports/nivelacije', 'pdf', null, null,$controls);
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Description: File Transfer');
            //header('Content-Disposition: attachment; filename=fill_rate.pdf');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . strlen($report));
            header('Content-Type: application/pdf');
           
            echo $report;
         
      
    
    

        
?>