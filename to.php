<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 06.12.18
 * Time: 10:51
 */
$url = $_GET['url'];

echo '
    <script>
        top.location.assign("' . $url . '");
    </script>
';