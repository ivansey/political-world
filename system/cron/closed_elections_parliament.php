<?php
include "../system/func.php";
//CRON-скрипт для закрытия выборов в парламент и подсчёта голосов
//***************
//Дорогой программист, этот скрипт работает очень не очень
//Если решил им заняться, то добавь ниже количество часов работы над ним
//P.S. Да, идея считалки на моя
//P.S.S. Считалка существует с 08:57 UTC+3 21 Ноя 2018
//$H = 7;
//***************
$test = 'test';
$usr = 2;
//Закрытие выборов
$sql1 = $conn->query("UPDATE goverment SET elec_par = 0");
//Подготовка
$parl_sum = $conn->query("SELECT COUNT(*) FROM parlament WHERE sum = 7")->fetch()['COUNT(*)'];
$i = 0;
//echo 'Сумма ' . $parl_sum . '<br>';
//Процесс посчёта
while ($i < $parl_sum) {
    $gover = $conn->query("SELECT * FROM parlament WHERE sum = 7 LIMIT " . $i . ",1")->fetch();
    $elec = $conn->query("SELECT COUNT(*) FROM elections_par WHERE gover = " . $gover['gover'])->fetch()['COUNT(*)'];
    $vote_sum = $conn->query("SELECT SUM(vote) FROM elections_par WHERE gover = " . $gover['gover'])->fetch()['SUM(vote)'];
    $proc = 100;
    $res = 0;
    echo 'Парламент' . $elec . '<br>';
    if ($elec == 1) {
        $i2 = 0;
        while ($i2 < $elec) {
//            echo 'ТЕСТ ' . $i2 . '<br>';
            $elec_sql = $conn->query("SELECT * FROM elections_par WHERE gover = " . $gover['gover'] . " LIMIT " . $i2 . ",1")->fetch();
            $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
            $math = $vote_sum * 100 / $elec;
            $sum = $elec_sql['sum'];
//            echo $math;
            $i2++;
//            Порог баллов для семи местного парламента
//            **********************
//            7-местный парламент
//            **********************
            if ($sum == 7) {
                if ($math >= 100) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 6) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 85) {
                    echo 'Случай 2<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 5) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 71) {
                    echo 'Случай 3<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 4) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 57) {
                    echo 'Случай 4<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 3) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 42) {
                    echo 'Случай 5<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 2) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 28) {
                    echo 'Случай 6<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $user1 = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT 0,1")->fetch();
                    $conn->query("UPDATE parlament SET `2` = " . $user1['id'] . " WHERE gover = " . $gover['gover']);
                } elseif ($math >= 14) {
                    echo 'Случай 7<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                }
//                ********************
//                13-местный парламент
//                ********************
            } elseif ($sum == 13) {
                if ($math >= 100) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 12) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 91) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 11) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 83) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 10) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 76) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 9) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 68) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 8) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 60) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 7) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 53) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 6) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 45) {
                    echo 'Случай 2<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 5) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 38) {
                    echo 'Случай 3<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 4) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 30) {
                    echo 'Случай 4<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 3) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 22) {
                    echo 'Случай 5<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 2) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 15) {
                    echo 'Случай 6<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $user1 = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT 0,1")->fetch();
                    $conn->query("UPDATE parlament SET `2` = " . $user1['id'] . " WHERE gover = " . $gover['gover']);
                } elseif ($math >= 8) {
                    echo 'Случай 7<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                }
            } elseif ($sum == 15) {
                if ($math >= 100) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 14) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 92) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 13) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 86) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 12) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 79) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 11) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 72) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 10) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 66) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 9) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 59) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 8) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 53) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 7) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 46) {
                    echo 'Случай 1<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 6) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                        echo 'USERS<br>';
                        echo $user['id'] . '<br>';
                    }
                } elseif ($math > 40) {
                    echo 'Случай 2<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 5) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 33) {
                    echo 'Случай 3<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 4) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 26) {
                    echo 'Случай 4<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 3) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 20) {
                    echo 'Случай 5<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $iii = 0;
                    $usr = 2;
                    while ($iii < 2) {
                        $pos = $conn->query("SELECT * FROM parlament WHERE gover = " . $gover['gover'])->fetch();
                        if ($pos[$usr] != 0) {
                            $user = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT " . $iii . ",1")->fetch();
                            $conn->query("UPDATE parlament SET `" . $usr . "` = " . $user['id'] . " WHERE gover = " . $gover['gover']);
                        }
                        $iii++;
                        $usr++;
                    }
                } elseif ($math > 13) {
                    echo 'Случай 6<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                    $user1 = $conn->query("SELECT * FROM users WHERE party = " . $elec_sql['id_party'] . " AND id != " . $party['leader'] . " LIMIT 0,1")->fetch();
                    $conn->query("UPDATE parlament SET `2` = " . $user1['id'] . " WHERE gover = " . $gover['gover']);
                } elseif ($math >= 7) {
                    echo 'Случай 7<br>';
                    $party = $conn->query("SELECT * FROM party WHERE id = " . $elec_sql['id_party'])->fetch();
                    $conn->query("UPDATE parlament SET `1` = " . $party['leader'] . " WHERE gover = " . $gover['gover']);
                }
            }
        }
    } else {
        echo 'Парламента нет <br>';
    }
    $i++;
}