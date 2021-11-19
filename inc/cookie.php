<?php 

// Class that abstracts both the $_COOKIE and setcookie()
class Cookie
{
    // The array that stores the cookie
    protected $data = array();

    // Expiration time from now
    protected $expire;

    // Domain for the website
    protected $domain;

    // Default expiration is 28 days (28 * 3600 * 24 = 2419200).
    // Parameters:
    //   $cookie: $_COOKIE variable
    //   $expire: expiration time for the cookie in seconds
    //   $domain: domain for the application `example.com`, `test.com`
    public function __construct($cookie, $expire = 2419200, $domain = null)
    {
        // Set up the data of this cookie
        $this->data = $cookie;

        $this->expire = $expire;

        if ($domain)
            $this->domain = $domain;
        else
        {
            $this->domain = isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] :
                (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME']);
        }
    }

    public function __get($name) {

        return (isset($this->data[$name])) ? $this->data[$name] : "";
    }

    public function __set($name, $value = null) {

        // Check whether the headers are already sent or not
        if (headers_sent())
            throw new Exception("Can't change cookie " . $name . " after sending headers.");

        // Delete the cookie
        if (!$value)
        {
            setcookie($name, null, time() - 10, '/', '.' . $this->domain, false, true);
            unset($this->data[$name]);
            unset($_COOKIE[$name]);
        }
        else {
            // Set the actual cookie
            setcookie($name, $value, time() + $this->expire, '/', $this->domain, false, true);
            $this->data[$name] = $value;
            $_COOKIE[$name] = $value;
        }
    }
}

// $Cookie = new Cookie($_COOKIE);
// $User = $Cookie->user;
// $LastVisit = $Cookie->last;
// $Cookie->last = time();

?>