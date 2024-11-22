<?php

namespace MyApp\Utils;

class HandlerSweetAlert
{
    public static function DisplaySweetAlert()
    {
        $message = $_SESSION["message"] ?? false;
        if ($message) {
            echo <<< TXT
                <script>
                    Swal.fire({
                      position: "center",
                      icon: "success",
                      title: "$message",
                      showConfirmButton: false,
                      timer: 2000
                    });                
                </script>            
            TXT;
            unset($_SESSION["message"]);
        }
    }
}
