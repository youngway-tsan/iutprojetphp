<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil - F.C. WOIPPY</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/FCWoippy-logo.png">
    </head>

    <?php
        require_once("header.php");
        
        session_start();
        if ($_SESSION["connected"] != True){
            header('Location: index.php');
        }
        $header = new header();

        $random = random_int(0, 5);
        switch ($random) {
            case 0: 
                $vid = "uefa_intro.mp4";
                break;
            case 1:
                $vid = "panenkaBenzema.mp4";
                break;
            case 2:
                $vid = "joseMourinho.mp4";
                break;
            case 3: 
                $vid = "mbappe.mp4";
                break;
            case 4:
                $vid = "messi.mp4";
                break;
            case 5:
                $vid = "ronaldo.mp4";
                break;
        }

    ?>

    <body>
        <div class="containerAccueil">

            <div class="video-container">
                <video autoplay muted loop id="maVideo" class="maVideo">
                    <source src = <?php echo $vid;?> type="video/mp4">
                </video>
            </div>

            <div class="home-title">
                <h1>Bienvenue Manager !</h1>
                <span>Application de gestion du F.C WOIPPY</span>
            </div>

        </div>
    </body>


</html>