<?php
namespace App\Helper;

class Session {

    /**
     * Cookie live time
     *
     * @var time
     */
    private static $cookieTime;

    /**
     * Starts a session
     *
     * @return void
     */
    public static function start()
    {
        session_start();
        self::$cookieTime = strtotime('+30 days');
    }

    /**
     * Sets a session
     * 
     * @param string $key
     * @param string $value
     * @return void
     */
    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    } 

    /**
     * Returns a session variable
     *
     * @param string $key
     * @return mixed
     */
    public static function get(string $key)
    {
        if(!isset($_SESSION[$key])){
            return false;
        }

        return $_SESSION[$key];
    }

    /**
     * Kills a session variable
     *
     * @param string $key
     * @return void
     */
    public static function kill(string $key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Destroy session
     *
     * @return void
     */
    public static function killAll()
    {
        session_destroy();
    }
    
    /**
     * Set cookie
     *
     * @param string $name
     * @param string $value
     * @return void
     */
    public static function setCookie(string $name, string $value)
    {
        $secureCookie = getenv('RELEASE') === 'dev' ? false : true;
        setcookie($name, $value, self::$cookieTime, '', '', $secureCookie, true);
    }

    /**
     * Retuns a cookie
     *
     * @param string $name
     * @return moxed
     */
    public static function getCookie(string $name)
    {
        return $_COOKIE[$name];
    }

    /**
     * Deletes a cookie
     *
     * @param string $name
     * @return void
     */
    public static function killCookie(string $name)
    {
        unset($_COOKIE[$name]);
        setcookie($name, null, -1, '/');
    }

     /**
     * @param string $name
     * @return bool
     */
    public static function isSession(string $name): bool
    {
        return isset($_SESSION[$name]);
    }

    /**
     * @param string $name
     * @return bool
     */
    public static function isCookie(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }
}