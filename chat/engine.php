<!doctype html>
<html lang="ru">
<head>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <meta name="description" content="Сайт об HTML и создании сайтов"/>
     <meta name="keywords" content="игра, game, играть онлайн, стрелялка, выживание онлайн, монстры"/>
     <link rel="stylesheet" type="text/css" href="smiles/font/flaticon.css">
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <style>

     </style>
</head>

<body style="font-size: 15px">

<!--PRELOADER-->


                    <div class="wrapper-for-preload" style="font-size: 0px; display: none">
                   <?php
                   include('../system/func.php');
                   auth();
                   banned($user);
                   banned_chat($user);

                   $count = intval($conn->query("SELECT COUNT(*) FROM `chat`")->fetch()[0]);
                   $arr = $conn->query("SELECT * FROM `chat` LIMIT ".($count > 20 ? $count - 20 : 20).", 20");

                   if ($count > 20) {
                       foreach ($arr as $element) {
                           if (strlen($element['text']) > 150)
                               $msg = $element['name'] . " [" . $element['time'] . "] " . ": " ."<div style='width: 600px; word-wrap:break-word;'>".$element['text']."</div><br/>";
                           else $msg = $element['name'] . " [" . $element['time'] . "] " . ": " . $element['text'] . "<br/>";

                           echo($msg);
                       }
                   }

                   else {
                       $messages = $conn->query("SELECT * FROM `chat`");

                       echo "<meta http-equiv=\"Refresh\" content=\"5\" />";

                       while($message=$messages->fetch()){
                           if (strlen($message['text']) > 150)
                               $msg = $message['name'] . " [" . $message['time'] . "] " . ": " ."<div style='width: 550px; word-wrap:break-word;'>".$message['text']."</div><br/>";

                           else $msg = $message['name'] . " [" . $message['time'] . "] " . ": " . $message['text'] . "<br/>";

                           echo($msg);
                       }
                   }
                   ?>

               <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
                         <div class="circle-clipper left">
                              <div class="circle"></div>
                         </div><div class="gap-patch">
                              <div class="circle"></div>
                         </div><div class="circle-clipper right">
                              <div class="circle"></div>
                         </div>
                    </div>
               </div>
                    <!--PRELOADER-->
           </div>


     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
     <script src="../scripts/chat.js"></script>
</body>
</html>
