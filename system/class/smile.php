<?php
/**
 * Created by PhpStorm.
 * User: ivansey
 * Date: 30.11.18
 * Time: 6:57
 */

namespace text;


class smile
{
    public static function tosmile($text) {
        $text = str_ireplace(":)))", "<img src='/design/images/smile/:super_smile.png'>", $text);
        $text = str_ireplace(":)", "<img src='/design/images/smile/:smile.png'>", $text);
        $text = str_ireplace(":(((", "<img src='/design/images/smile/:(((.png'>", $text);
        $text = str_ireplace(":#", "<img src='/design/images/smile/:ups.png'>", $text);
        $text = str_ireplace(":()", "<img src='/design/images/smile/:().png'>", $text);
        $text = str_ireplace(":*", "<img src='/design/images/smile/:*.png'>", $text);
        $text = str_ireplace(":00", "<img src='/design/images/smile/:00.png'>", $text);
        $text = str_ireplace(":;", "<img src='/design/images/smile/:;.png'>", $text);
        $text = str_ireplace(":>>>", "<img src='/design/images/smile/:>>>.png'>", $text);
        $text = str_ireplace(":>", "<img src='/design/images/smile/:>.png'>", $text);
        $text = str_ireplace(":???", "<img src='/design/images/smile/:???.png'>", $text);
        $text = str_ireplace(":aaa", "<img src='/design/images/smile/:aaa.png'>", $text);
        $text = str_ireplace(":baz", "<img src='/design/images/smile/:baz.png'>", $text);
        $text = str_ireplace(":boom", "<img src='/design/images/smile/:boom.png'>", $text);
        $text = str_ireplace(":botton", "<img src='/design/images/smile/:botton.png'>", $text);
        $text = str_ireplace(":brrr", "<img src='/design/images/smile/:brrr.png'>", $text);
        $text = str_ireplace(":hello", "<img src='/design/images/smile/:hello.png'>", $text);
        $text = str_ireplace(":love", "<img src='/design/images/smile/:love.png'>", $text);
        $text = str_ireplace(":n", "<img src='/design/images/smile/:n.png'>", $text);
        $text = str_ireplace(":noc", "<img src='/design/images/smile/:noc.png'>", $text);
        $text = str_ireplace(":phone", "<img src='/design/images/smile/:phone.png'>", $text);
        $text = str_ireplace(":tsss", "<img src='/design/images/smile/:tsss.png'>", $text);
        $text = str_ireplace(":z-z-z", "<img src='/design/images/smile/:z-z-z.png'>", $text);
        $text = str_ireplace(":zzzzzz", "<img src='/design/images/smile/:zzzzzz.png'>", $text);
        $text = str_ireplace(":zzz", "<img src='/design/images/smile/:zzz.png'>", $text);
        $text = str_ireplace(":|", "<img src='/design/images/smile/:|.png'>", $text);
        $text = str_ireplace(":~", "<img src='/design/images/smile/:~.png'>", $text);
        $text = str_ireplace(":gif/boo-fnaf", "<img src='/design/images/smile/boo-fnaf.gif'>", $text);
        return $text;
    }

    public static function smile_look() {
        echo ':) <img src=\'/design/images/smile/:smile.png\'><br>
    :))) <img src=\'/design/images/smile/:super_smile.png\'><br>
    :((( <img src=\'/design/images/smile/:(((.png\'><br>
    :# <img src=\'/design/images/smile/:ups.png\'><br>
    :() <img src=\'/design/images/smile/:().png\'><br>
    :* <img src=\'/design/images/smile/:*.png\'><br>
    :00 <img src=\'/design/images/smile/:00.png\'><br>
    :; <img src=\'/design/images/smile/:;.png\'><br>
    :> <img src=\'/design/images/smile/:>.png\'><br>
    :>>> <img src=\'/design/images/smile/:>>>.png\'><br>
    :??? <img src=\'/design/images/smile/:???.png\'><br>
    :aaa <img src=\'/design/images/smile/:aaa.png\'><br>
    :baz <img src=\'/design/images/smile/:baz.png\'><br>
    :boom <img src=\'/design/images/smile/:boom.png\'><br>
    :botton <img src=\'/design/images/smile/:botton.png\'><br>
    :brrr <img src=\'/design/images/smile/:brrr.png\'><br>
    :hello <img src=\'/design/images/smile/:hello.png\'><br>
    :love <img src=\'/design/images/smile/:love.png\'><br>
    :n <img src=\'/design/images/smile/:n.png\'><br>
    :noc <img src=\'/design/images/smile/:noc.png\'><br>
    :phone <img src=\'/design/images/smile/:phone.png\'><br>
    :tsss <img src=\'/design/images/smile/:tsss.png\'><br>
    :z-z-z <img src=\'/design/images/smile/:z-z-z.png\'><br>
    :zzz <img src=\'/design/images/smile/:zzz.png\'><br>
    :zzzzzz <img src=\'/design/images/smile/:zzzzzz.png\'><br>
    :| <img src=\'/design/images/smile/:|.png\'><br>
    :~ <img src=\'/design/images/smile/:~.png\'><br>
    :gif/boo-fnaf <img src=\'/design/images/smile/boo-fnaf.gif\'><br>
    ';
    }
}