<?php

namespace MyApp\Utils;

class SweetAlertDisplay
{
    public static function showSessionSweetAlert()
    {
        $message = $_SESSION["message"] ?? false;
        if ($message) :
?>
            <script>
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "<?= $message ?>",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
<?php
            unset($_SESSION["message"]);
        endif;
    }
}
