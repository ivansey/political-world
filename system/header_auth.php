<?php
if (!isset($noheader)) { ?>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <hr>
    <div style="text-align: center;">
        <?php
        echo "$user[lvl] lvl( $user[exp]/$user[nexp] exp)<br>$user[energy]/$user[max_energy] energy<br>$user[money] RUB/$user[gold] G";
        ?>
        <hr>
    </div>
    <?php
}
if ($user['exp'] >= $user['nexp']) {
    $conn->query("UPDATE users SET lvl = lvl + 1,exp = exp - nexp, nexp = nexp + 1000 WHERE id = $user[id]");
    echo 'Level up<hr>';
}
?>
