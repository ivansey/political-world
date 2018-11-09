<?php
if (!isset($noheader)) { ?>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter51057068 = new Ya.Metrika2({ id:51057068, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/tag.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks2"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/51057068" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
    </head>
    <?php
    $user_design = $conn->query("SELECT * FROM `styles` WHERE `id` = '" . $user[style] . "' LIMIT 1")->fetch();
    echo '<link rel="stylesheet" href="../design/'.$user_design[path].'" type="text/css">';
    ?>
    <div class="block">
<hr>
        <?php
        echo "$user[lvl] lvl( $user[exp]/$user[nexp] exp)<br>$user[energy]/$user[max_energy] energy<br>$user[money] RUB/$user[gold] SCR";
        ?>
        <hr>
    </div><br>
    <?php
}
if ($user['exp'] >= $user['nexp']) {
    $conn->query("UPDATE users SET lvl = lvl + 1,exp = exp - nexp, nexp = nexp + 1000 WHERE id = $user[id]");
    echo 'Level up<hr>';
}
?>
