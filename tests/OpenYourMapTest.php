<?php
use PHPUnit\Framework\TestCase;

class OpenYourMapTest extends TestCase
{
    protected function setUp(): void
    {
        // Mock server variables
        $_SERVER['HTTP_HOST'] = 'localhost';
        $_SERVER['HTTPS'] = 'off';
        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'en';
    }

    public function testHttpProtocol()
    {
        $_SERVER['HTTPS'] = 'off';
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $this->assertEquals('http://', $protocol);

        $_SERVER['HTTPS'] = 'on';
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $this->assertEquals('https://', $protocol);
    }

    public function testBaseUrl()
    {
        $protocol = 'http://';
        $base_url = $protocol . $_SERVER['HTTP_HOST'] . '/';
        $this->assertEquals('http://localhost/', $base_url);
    }

    public function testLanguageDetection()
    {
        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'en';
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $title = ($lang === "fr") ? "📍C'est par ici !" : "📍It's over here!";
        $this->assertEquals("📍It's over here!", $title);

        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'fr';
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $title = ($lang === "fr") ? "📍C'est par ici !" : "📍It's over here!";
        $this->assertEquals("📍C'est par ici !", $title);
    }

    public function testDescription()
    {
        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'en';
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $description = ($lang === "fr") ? "Ouvrez votre lieu dans les applications cartographiques natives des smartphones, ce qui améliore l'expérience de l'utilisateur et simplifie la navigation." : "Open web-based content to native map apps on smartphones, enhancing user experience and simplifying navigation.";
        $this->assertEquals("Open web-based content to native map apps on smartphones, enhancing user experience and simplifying navigation.", $description);

        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'fr';
        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $description = ($lang === "fr") ? "Ouvrez votre lieu dans les applications cartographiques natives des smartphones, ce qui améliore l'expérience de l'utilisateur et simplifie la navigation." : "Open web-based content to native map apps on smartphones, enhancing user experience and simplifying navigation.";
        $this->assertEquals("Ouvrez votre lieu dans les applications cartographiques natives des smartphones, ce qui améliore l'expérience de l'utilisateur et simplifie la navigation.", $description);
    }
}
