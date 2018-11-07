<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 02.11.18
 * Time: 16:19
 */
include('../system/func.php');
auth();
banned($user);
?>
<div class="a"><a href="market.php?type=metal">Искать Железо</a></div>
<div class="a"><a href="market.php?type=metal_ore">Искать Железную Руду</a></div>
<div class="a"><a href="market.php?type=tin">Искать Олово</a></div>
<div class="a"><a href="market.php?type=tin_ore">Искать Оловянную руду</a></div>
<div class="a"><a href="market.php?type=steel">Искать Сталь</a></div>
<div class="a"><a href="market.php?type=oil">Искать Нефть</a></div>
<div class="a"><a href="market.php?type=fuel">Искать Топливо</a></div>
<div class="a"><a href="market.php?type=food">Искать Еду</a></div>
<div class="a"><a href="../game.php">На главную</a></div>