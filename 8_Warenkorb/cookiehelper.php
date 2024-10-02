<?php
class CookieHelper
{

    public static function setCookie()
    {
        $gueltigbis = time() + 3600 * 24 * 365;
        setcookie('allowed', 'true', $gueltigbis, '/', '', false, true);
    }


    public static function isCookieSet()
    {
        if(isset($_COOKIE['allowed']) && $_COOKIE['allowed'] == 'true') {
            return true;
        } else {
            return false;
    }
}

}