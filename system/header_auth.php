<?php
if ($_SERVER['REQUEST_URI'] == "/chat/engine.php") return 1;


$user_design = $conn->query("SELECT * FROM `styles` WHERE `id` = '" . $user[style] . "' LIMIT 1")->fetch();
echo '<link rel="stylesheet" href="' . $user_design["path"] . '" type="text/css">';
echo "
<div class='block'>
     <!--<div class='col xl2 l2 z-depth-5 white hide-on-small-only hide-on-med-only' style='position: fixed; right: 0px; border-radius: 2px;'>-->
     <span style='font-weight: bold'>Информация</span>
          <br>
               $user[lvl] lvl ($user[exp]/$user[nexp] exp)
          <br>
               $user[energy]/$user[max_energy] energy
          <br>
               $user[money] RUB/$user[gold] SCR
     </div>
     <br>       
</div>

";

if ($user['exp'] >= $user['nexp']) {
    $conn->query("UPDATE users SET lvl = lvl + 1,exp = exp - nexp, nexp = nexp + 1000 WHERE id = $user[id]");
    echo "
          <div class='center'>
               <h3>Уровень повышен!</h3>
          </div>
     ";
}
echo '
<!doctype html>
<html lang="en">
<head>
     <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-->
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="' . $user_design["path"] . '" type="text/css">
     <meta name="description" content="Захватывающая игра - Political World!"/>
     <meta name="keywords" content="игра, game, играть онлайн, стрелялка, выживание онлайн, монстры"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<script type="text/javascript">
    (function (d, w, c) { (w[c] = w[c] || []).push(
        function() {
            try {
                w.yaCounter51057068 = new Ya.Metrika2({
                    id:51057068, clickmap:true, trackLinks:true, accurateTrackBounce:true
                });
            } catch(e)
            { }
        });
    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () {
        n.parentNode.insertBefore(s, n);
    };

    s.type = "text/javascript";
    s.async = true; s.src = "https://mc.yandex.ru/metrika/tag.js";

    if (w.opera == "[object Opera]")
    { d.addEventListener("DOMContentLoaded", f, false);
    } else {
        f();
      }

    })
    (document, window, "yandex_metrika_callbacks2");
</script>
<noscript>
     <div>
          <img src="https://mc.yandex.ru/watch/51057068" style="position:absolute; left:-9999px;" alt="" />
     </div>
</noscript>

</body>
</html>
';