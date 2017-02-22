<?php

/**
 * This file contains all the classes used by the PHP code created by WebSite X5
 *
 * @category  X5engine
 * @package   X5engine
 * @copyright 2013 - Incomedia Srl
 * @license   Copyright by Incomedia Srl http://incomedia.eu
 * @version   WebSite X5 Free 10.0.0
 * @link      http://websitex5.com
 */

@session_start();

$imSettings = Array();
$l10n = Array();
$phpError = false;
$ImMailer = new ImSendEmail();

@include_once "imemail.inc.php";		// Email class - Static
@include_once "x5settings.php";			// Basic settings - Dynamically created by WebSite X5
@include_once "access.inc.php";			// Private area data - Dynamically created by WebSite X5
@include_once "l10n.php";				// Localizations - Dynamically created by WebSite X5
@include_once "search.inc.php" ;		// Search engine data - Dynamically created by WebSite X5




/**
 * Captcha handling class
 * @access public
 */
class imCaptcha {

    /**
     * Show the captcha chars
     */
    function show($sCode)
    {
        global $oNameList;
        global $oCharList;

        $text = "<!DOCTYPE HTML>
            <html>
          <head>
          <meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">
          <meta http-equiv=\"pragma\" content=\"no-cache\">
          <meta http-equiv=\"cache-control\" content=\"no-cache, must-revalidate\">
          <meta http-equiv=\"expires\" content=\"0\">
          <meta http-equiv=\"last-modified\" content=\"\">
          </head>
          <body style=\"margin: 0; padding: 0; border-collapse: collapse;\">";

        for ($i=0; $i<strlen($sCode); $i++)
            $text .= "<img style=\"margin:0; padding:0; border: 0; border-collapse: collapse; width: 24px; height: 24px; position: absolute; top: 0; left: " . (24 * $i) . "px;\" src=\"imcpa_".$oNameList[substr($sCode, $i, 1)].".gif\" width=\"24\" height=\"24\">";

        $text .= "</body></html>";

        return $text;
    }

    /**
     * Check the sent data
     * @param sCode The correct code (string)
     * @param dans The user's answer (string)
     */
    function check($sCode, $ans)
    {
        global $oCharList;
        if ($ans == "")
            return '-1';
        for ($i=0; $i<strlen($sCode); $i++)
          if ($oCharList[substr(strtoupper($sCode), $i, 1)] != substr(strtoupper($ans), $i, 1))
            return '-1';
        return '0';
    }
}











/**
 * Private area
 * @access public
 */
class imPrivateArea
{

    var $session_uname;
    var $session_uid;
    var $session_page;
    var $cookie_name;

    // PHP 5
    function __contruct()
    {
        $this->session_uname = "im_access_uname";
        $this->session_real_name = "im_access_real_name";
        $this->session_page = "im_access_request_page";
        $this->session_uid = "im_access_uid";
        $this->cookie_name = "im_access_cookie_uid";
    }

    // PHP 4
    function imPrivateArea()
    {
        $this->session_uname = "im_access_uname";
        $this->session_real_name = "im_access_real_name";
        $this->session_page = "im_access_request_page";
        $this->session_uid = "im_access_uid";
        $this->cookie_name = "im_access_cookie_uid";
    }

    /**
     * Encode the string
     * @param  string $string The string to encode
     * @param  $key The encryption key
     * @return string    The encoded string
     */
    function _encode($s, $k)
    {
        $r = array();
        for($i = 0; $i < strlen($s); $i++)
            $r[] = ord($s[$i]) + ord($k[$i % strlen($k)]);

        // Try to encode it using base64
        if (function_exists("base64_encode") && function_exists("base64_decode"))
            return base64_encode(implode('.', $r));

        return implode('.', $r);
    }

    /**
     * Decode the string
     * @param  string $s The string to decode
     * @param  string $k The encryption key
     * @return string    The decoded string
     */
    function _decode($s, $k)
    {

        // Try to decode it using base64
        if (function_exists("base64_encode") && function_exists("base64_decode"))
            $s = base64_decode($s);

        $s = explode(".", $s);
        $r = array();
        for($i = 0; $i < count($s); $i++)
            $r[$i] = chr($s[$i] - ord($k[$i % strlen($k)]));
        return implode('', $r);
    }

    /**
     * Login
     * @access public
     * @param uname Username (string)
     * @param pwd Password (string)
     */
    function login($uname, $pwd)
    {
        global $imSettings;

        // Check if the user exists
        if (isset($imSettings['access']['users'][$uname]) && $imSettings['access']['users'][$uname]['password'] == $pwd) {
            // Save the session
            session_regenerate_id();
            $_SESSION[$this->session_uid] = $this->_encode($imSettings['access']['users'][$uname]['id'], $imSettings['general']['salt']);
            $_SESSION[$this->session_uname] = $this->_encode($uname, $imSettings['general']['salt']);
            $_SESSION[$this->session_real_name] = $this->_encode($imSettings['access']['users'][$uname]['name'], $imSettings['general']['salt']);
            $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT'] . $imSettings['general']['salt']);
            setcookie($this->cookie_name, $this->_encode($imSettings['access']['users'][$uname]['id'], $imSettings['general']['salt']), time() + 60 * 60 * 24 * 30, "/");
            return true;
        }

        return false;
    }

    /**
     * Logout
     * @access public
     */
    function logout() {
        $_SESSION[$this->session_uname] = "";
        $_SESSION[$this->session_uid] = "";
        $_SESSION[$this->session_page] = "";
        $_SESSION['HTTP_USER_AGENT'] = "";
        setcookie($this->cookie_name, "", time() - 3600, "/");
        $_COOKIE[$this->cookie_name] = "";
    }

    /**
     * Save the referrer page
     * @access public
     */
    function save_page() {
        global $imSettings;
        $url = basename($_SERVER['PHP_SELF']);
        if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']))
            $url .= "?" . $_SERVER['QUERY_STRING'];
        $_SESSION[$this->session_page] = $this->_encode($url, $imSettings['general']['salt']);
    }

    /**
     * Return to the referrer page
     * @access public
     */
    function saved_page() {
        global $imSettings;
        if (isset($_SESSION[$this->session_page]) && $_SESSION[$this->session_page] != "")
            return $this->_decode($_SESSION[$this->session_page], $imSettings['general']['salt']);
        return false;
    }

    /**
     * Get an array of data about the logged user
     * @access public
     */
    function who_is_logged() {
        global $imSettings;
        if (isset($_SESSION[$this->session_uname]) && $_SESSION[$this->session_uname] != "" && isset($_SESSION[$this->session_uname]))
            return array(
                "username" => $this->_decode($_SESSION[$this->session_uname], $imSettings['general']['salt']),
                "uid" => $this->_decode($_SESSION[$this->session_uid], $imSettings['general']['salt']),
                "realname" => $this->_decode($_SESSION[$this->session_real_name], $imSettings['general']['salt'])
            );
        return false;
    }

    /**
     * Check if the logged user can access to a page
     * @access public
     * @param page The page id (string)
     */
    function checkAccess($page) {
        global $imSettings;

        //
        // The session can live only in the same browser
        //

        if (!isset($_SESSION['HTTP_USER_AGENT']) || $_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT'] . $imSettings['general']['salt']))
            return -1;

        if (!isset($_SESSION[$this->session_uname]) || !isset($_COOKIE[$this->cookie_name]) || $_SESSION[$this->session_uname] == null || $_SESSION[$this->session_uname] == '' || $_SESSION[$this->session_uid] == null || $_SESSION[$this->session_uid] == '')
            return -1; // Wrong login data

        $uid = $this->_decode($_SESSION[$this->session_uid], $imSettings['general']['salt']);
        if (!@in_array($uid, $imSettings['access']['pages'][$page]) && !@in_array($uid, $imSettings['access']['admins']))
            return -2; // The user cannot access to this page
        return 0;
    }

    /**
     * Get the user's landing page
     * @access public
     */
    function getLandingPage() {
        global $imSettings;
        if ($_SESSION[$this->session_uname] === null || $_SESSION[$this->session_uname] === '' || $_SESSION[$this->session_uid] === null || $_SESSION[$this->session_uid] === '')
            return false;

        return $imSettings['access']['users'][$this->_decode($_SESSION[$this->session_uname], $imSettings['general']['salt'])]['page'];
    }
}

/**
 * Contains the methods used by the search engine
 * @access public
 */
class imSearch {

    var $scope;
    var $page;
    var $results_per_page;

    function __construct()
    {
        $this->setScope();
        $this->results_per_page = 10;
    }

    function imSearch()
    {
        $this->setScope();
        $this->results_per_page = 10;
    }

    /**
     * Loads the pages defined in search.inc.php  to the search scope
     * @access public
     */
    function setScope()
    {
        global $imSettings;
        $scope = $imSettings['search']['general']['defaultScope'];

        // Logged users can search in their private pages
        $pa = new imPrivateArea();
        if ($user = $pa->who_is_logged()) {
            foreach ($imSettings['search']['general']['extendedScope'] as $key => $value) {
                if (in_array($user['uid'], $imSettings['access']['pages'][$key]))
                    $scope[] = $value;
            }
        }

        $this->scope = $scope;
    }

    /**
     * Do the pages search
     * @access public
     * @param queries The search query (array)
     */
    function searchPages($queries)
    {
        
        global $imSettings;
        $html = "";
        $found_content = array();
        $found_count = array();

        if (is_array($this->scope)) {
            foreach ($this->scope as $filename) {
                $count = 0;
                $weight = 0;
                $file_content = @implode("\n", file($filename));

                // Remove the page menu
                while (stristr($file_content, "<div id=\"imPgMn\"") !== false) {
                    $style_start = imstripos($file_content, "<div id=\"imPgMn\"");
                    $style_end = imstripos($file_content, "</div", $style_start);
                    $style = substr($file_content, $style_start, $style_end - $style_start);
                    $file_content = str_replace($style, "", $file_content);
                }

                // Remove the breadcrumbs
                while (stristr($file_content, "<div id=\"imBreadcrumb\"") !== false) {
                    $style_start = imstripos($file_content, "<div id=\"imBreadcrumb\"");
                    $style_end = imstripos($file_content, "</div", $style_start);
                    $style = substr($file_content, $style_start, $style_end - $style_start);
                    $file_content = str_replace($style, "", $file_content);
                }

                // Remove CSS
                while (stristr($file_content, "<style") !== false) {
                    $style_start = imstripos($file_content, "<style");
                    $style_end = imstripos($file_content, "</style", $style_start);
                    $style = substr($file_content, $style_start, $style_end - $style_start);
                    $file_content = str_replace($style, "", $file_content);
                }

                // Remove JS
                while (stristr($file_content, "<script") !== false) {
                    $style_start = imstripos($file_content, "<script");
                    $style_end = imstripos($file_content, "</script", $style_start);
                    $style = substr($file_content, $style_start, $style_end - $style_start);
                    $file_content = str_replace($style, "", $file_content);
                }

                // Remove PHP
                while (stristr($file_content, "<?php") !== false) {
                    $style_start = imstripos($file_content, "<?php");
                    $style_end = imstripos($file_content, "?>", $style_start) !== false ? imstripos($file_content, "?>", $style_start) + 2 : strlen($file_content);
                    $style = substr($file_content, $style_start, $style_end - $style_start);
                    $file_content = str_replace($style, "", $file_content);
                }
                $file_title = "";

                // Get the title of the page
                preg_match('/\<title\>([^\<]*)\<\/title\>/', $file_content, $matches);
                if (count($matches) > 1)
                    $file_title = $matches[1];
                else {
                    preg_match('/\<h2\>([^\<]*)\<\/h2\>/', $file_content, $matches);
                    if (count($matches) > 1)
                        $file_title = $matches[1];
                }

                if ($file_title != "") {
                    foreach ($queries as $query) {
                        $title = imstrtolower($file_title);
                        while (($title = stristr($title, $query)) !== false) {
                            $weight += 5;
                            $count++;
                            $title = substr($title, strlen($query));
                        }
                    }
                }

                // Get the keywords
                preg_match('/\<meta name\=\"keywords\" content\=\"([^\"]*)\" \/>/', $file_content, $matches);
                if (count($matches) > 1) {
                    $keywords = $matches[1];
                    foreach ($queries as $query) {
                        $tkeywords = imstrtolower($keywords);
                        while (($tkeywords = stristr($tkeywords, $query)) !== false) {
                            $weight += 4;
                            $count++;
                            $tkeywords = substr($tkeywords, strlen($query));
                        }
                    }
                }

                // Get the description
                preg_match('/\<meta name\=\"description\" content\=\"([^\"]*)\" \/>/', $file_content, $matches);
                if (count($matches) > 1) {
                    $keywords = $matches[1];
                    foreach ($queries as $query) {
                        $tkeywords = imstrtolower($keywords);
                        while (($tkeywords = stristr($tkeywords, $query)) !== false) {
                            $weight += 3;
                            $count++;
                            $tkeywords = substr($tkeywords, strlen($query));
                        }
                    }
                }

                // Remove the page title from the result
                while (stristr($file_content, "<h2") !== false) {
                    $style_start = imstripos($file_content, "<h2");
                    $style_end = imstripos($file_content, "</h2", $style_start);
                    $style = substr($file_content, $style_start, $style_end - $style_start);
                    $file_content = str_replace($style, "", $file_content);
                }

                $page_pos = strpos($file_content, "<div id=\"imContent\">") + strlen("<div id=\"imContent\">");
                $page_end = strpos($file_content, "<div id=\"imBtMn\">");
                if ($page_end == false)
                    $page_end = strpos($file_content, "</body>");

                $file_content = strip_tags(substr($file_content, $page_pos, $page_end-$page_pos));
                $t_file_content = imstrtolower($file_content);

                foreach ($queries as $query) {
                    $file = $t_file_content;
                    while (($file = stristr($file, $query)) !== false) {
                        $count++;
                        $weight++;
                        $file = substr($file, strlen($query));
                    }
                }

                if ($count > 0) {
                    $found_count[$filename] = $count;
                    $found_weight[$filename] = $weight;
                    $found_content[$filename] = $file_content;
                    if ($file_title == "")
                        $found_title[$filename] = $filename;
                    else
                        $found_title[$filename] = $file_title;
                }
            }
        }

        if (count($found_count)) {
            arsort($found_weight);
            $i = 0;
            foreach ($found_weight as $name => $weight) {
                $count = $found_count[$name];
                $i++;
                if (($i > $this->page*$this->results_per_page) && ($i <= ($this->page+1)*$this->results_per_page)) {
                    $title = strip_tags($found_title[$name]);
                    $file = $found_content[$name];
                    $file = strip_tags($file);
                    $ap = 0;
                    $filelen = strlen($file);
                    $text = "";
                    for ($j=0; $j<($count > 6 ? 6 : $count); $j++) {
                        $minpos = $filelen;
                        foreach ($queries as $query) {
                            if ($ap < $filelen && ($pos = strpos(strtoupper($file), strtoupper($query), $ap)) !== false) {
                                if ($pos < $minpos) {
                                    $minpos = $pos;
                                    $word = $query;
                                }
                            }
                        }
                        $prev = explode(" ", substr($file, $ap, $minpos-$ap));
                        if (count($prev) > ($ap > 0 ? 9 : 8))
                            $prev = ($ap > 0 ? implode(" ", array_slice($prev, 0, 8)) : "") . " ... " . implode(" ", array_slice($prev, -8));
                        else
                            $prev = implode(" ", $prev);
                        $text .= $prev . "<strong>" . substr($file, $minpos, strlen($word)) . "</strong>";
                        $ap = $minpos + strlen($word);
                    }
                    $next = explode(" ", substr($file, $ap));
                    if (count($next) > 9)
                        $text .= implode(" ", array_slice($next, 0, 8)) . "...";
                    else
                        $text .= implode(" ", $next);
                    $text = str_replace("|", "", $text);
                    $text = str_replace("<br />", " ", $text);
                    $text = str_replace("<br>", " ", $text);
                    $text = str_replace("\n", " ", $text);
                    $html .= "<div class=\"imSearchPageResult\"><h3><a class=\"imCssLink\" href=\"" . $name . "\">" . strip_tags($title, "<b><strong>") . "</a></h3>" . strip_tags($text, "<b><strong>") . "<div class=\"imSearchLink\"><a class=\"imCssLink\" href=\"" . $name . "\">" . $imSettings['general']['url'] . "/" . $name . "</a></div></div>\n";
                }
            }
            $html = preg_replace_callback('/\\s+/', create_function('$matches', 'return implode(\' \', $matches);'), $html);
            $html .= "<div class=\"imSLabel\">&nbsp;</div>\n";
        }

        return array("content" => $html, "count" => count($found_content));
    }

    function searchBlog($queries)
    {
        
        global $imSettings;
        $html = "";
        $found_content = array();
        $found_count = array();

        if (isset($imSettings['blog']) && is_array($imSettings['blog']['posts'])) {
            foreach ($imSettings['blog']['posts'] as $key => $value) {
                $count = 0;
                $weight = 0;
                $filename = 'blog/index.php?id=' . $key;
                $file_content = $value['body'];
                // Rimuovo le briciole dal contenuto
                while (stristr($file_content, "<div id=\"imBreadcrumb\"") !== false) {
                    $style_start = imstripos($file_content, "<div id=\"imBreadcrumb\"");
                    $style_end = imstripos($file_content, "</div", $style_start);
                    $style = substr($file_content, $style_start, $style_end - $style_start);
                    $file_content = str_replace($style, "", $file_content);
                }

                // Rimuovo gli stili dal contenuto
                while (stristr($file_content, "<style") !== false) {
                    $style_start = imstripos($file_content, "<style");
                    $style_end = imstripos($file_content, "</style", $style_start);
                    $style = substr($file_content, $style_start, $style_end - $style_start);
                    $file_content = str_replace($style, "", $file_content);
                }
                // Rimuovo i JS dal contenuto
                while (stristr($file_content, "<script") !== false) {
                    $style_start = imstripos($file_content, "<script");
                    $style_end = imstripos($file_content, "</script", $style_start);
                    $style = substr($file_content, $style_start, $style_end - $style_start);
                    $file_content = str_replace($style, "", $file_content);
                }
                $file_title = "";

                // Rimuovo il titolo dal risultato
                while (stristr($file_content, "<h2") !== false) {
                    $style_start = imstripos($file_content, "<h2");
                    $style_end = imstripos($file_content, "</h2", $style_start);
                    $style = substr($file_content, $style_start, $style_end - $style_start);
                    $file_content = str_replace($style, "", $file_content);
                }

                // Conto il numero di match nel titolo
                foreach ($queries as $query) {
                    $t_count = @preg_match_all('/' . preg_quote($query, '/') . '/', imstrtolower($value['title']), $matches);
                    if ($t_count !== false) {
                        $weight += ($t_count * 4);
                        $count += $t_count;
                    }
                }

                // Conto il numero di match nei tag
                foreach ($queries as $query) {
                    if (in_array($query, $value['tag'])) {
                        $count++;
                        $weight += 4;
                    }
                }

                $title = "Blog &gt;&gt; " . $value['title'];

                // Cerco nel contenuto
                foreach ($queries as $query) {
                    $file = imstrtolower($file_content);
                    while (($file = stristr($file, $query)) !== false) {
                        $count++;
                        $weight++;
                        $file = substr($file, strlen($query));
                    }
                }

                if ($count > 0) {
                    $found_count[$filename] = $count;
                    $found_weight[$filename] = $weight;
                    $found_content[$filename] = $file_content;
                    $found_breadcrumbs[$filename] = "<div class=\"imBreadcrumb\" style=\"display: block; padding-bottom: 3px;\">" . l10n('blog_published_by') . "<strong> " . $value['author'] . " </strong>" . l10n('blog_in') . " <a href=\"blog/index.php?category=" . $value['category'] . "\" target=\"_blank\" rel=\"nofollow\">" . $value['category'] . "</a> &middot; " . $value['timestamp'] . "</div>";
                    if ($title == "")
                        $found_title[$filename] = $filename;
                    else
                        $found_title[$filename] = $title;
                }
            }
        }

        if (count($found_count)) {
            arsort($found_weight);
            $i = 0;
            foreach ($found_weight as $name => $weight) {
                $count = $found_count[$name];
                $i++;
                if (($i > $this->page*$this->results_per_page) && ($i <= ($this->page+1)*$this->results_per_page)) {
                    $title = strip_tags($found_title[$name]);
                    $file = $found_content[$name];
                    $file = strip_tags($file);
                    $ap = 0;
                    $filelen = strlen($file);
                    $text = "";
                    for ($j=0;$j<($count > 6 ? 6 : $count);$j++) {
                        $minpos = $filelen;
                        foreach ($queries as $query) {
                            if ($ap < $filelen && ($pos = strpos(strtoupper($file), strtoupper($query), $ap)) !== false) {
                                if ($pos < $minpos) {
                                    $minpos = $pos;
                                    $word = $query;
                                }
                            }
                        }
                        $prev = explode(" ", substr($file, $ap, $minpos-$ap));
                        if(count($prev) > ($ap > 0 ? 9 : 8))
                            $prev = ($ap > 0 ? implode(" ", array_slice($prev, 0, 8)) : "") . " ... " . implode(" ", array_slice($prev, -8));
                        else
                            $prev = implode(" ", $prev);
                        $text .= $prev . "<strong>" . substr($file, $minpos, strlen($word)) . "</strong> ";
                        $ap = $minpos + strlen($word);
                    }
                    $next = explode(" ", substr($file, $ap));
                    if(count($next) > 9)
                        $text .= implode(" ", array_slice($next, 0, 8)) . "...";
                    else
                        $text .= implode(" ", $next);
                    $text = str_replace("|", "", $text);
                    $html .= "<div class=\"imSearchBlogResult\"><h3><a class=\"imCssLink\" href=\"" . $name . "\">" . strip_tags($title, "<b><strong>") . "</a></h3>" . strip_tags($found_breadcrumbs[$name], "<b><strong>") . "\n" . strip_tags($text, "<b><strong>") . "<div class=\"imSearchLink\"><a class=\"imCssLink\" href=\"" . $name . "\">" . $imSettings['general']['url'] . "/" . $name . "</a></div></div>\n";
                }
            }
            echo "  <div class=\"imSLabel\">&nbsp;</div>\n";
        }

        $html = preg_replace_callback('/\\s+/', create_function('$matches', 'return implode(\' \', $matches);'), $html);
        return array("content" => $html, "count" => count($found_content));
    }

    // Di questa funzione manca la paginazione!
    function searchProducts($queries)
    {
        
        global $imSettings;
        $html = "";
        $found_products = array();
        $found_count = array();

        foreach ($imSettings['search']['products'] as $id => $product) {
            $count = 0;
            $weight = 0;
            $t_title = strip_tags(imstrtolower($product['name']));
            $t_description = strip_tags(imstrtolower($product['description']));

            // Conto il numero di match nel titolo
            foreach ($queries as $query) {
                $t_count = preg_match_all('/' . preg_quote($query, '/') . '/', $t_title, $matches);
                if ($t_count !== false) {
                    $weight += ($t_count * 4);
                    $count += $t_count;
                }
            }

            // Conto il numero di match nella descrizione
            foreach ($queries as $query) {
                $t_count = preg_match_all('/' . preg_quote($query, '/') . '/', $t_description, $matches);
                if ($t_count !== false) {
                    $weight++;
                    $count += $t_count;
                }
            }

            if ($count > 0) {
                $found_products[$id] = $product;
                $found_weight[$id] = $weight;
                $found_count[$id] = $count;
            }
        }

        if (count($found_count)) {
            arsort($found_weight);
            $i = 0;
            foreach ($found_products as $id => $product) {
                $i++;
                if (($i > $this->page*$this->results_per_page) && ($i <= ($this->page+1)*$this->results_per_page)) {
                    $count = $found_count[$id];
                    $html .= "<div class=\"imSearchProductResult\">
                    <h3 style=\"clear: both;\">" . $product['name'] . "</h3>";
                    $html .= "<div class=\"imSearchProductDescription\">";
                    $html .= $product['image'];
                    $html .= strip_tags($product['description']) . "</div>";
                    $html .= "<div class=\"imSearchProductPrice\">" . $product['price'];
                    $html .= "&nbsp;<img src=\"cart/images/cart-add.png\" onclick=\"x5engine.cart.ui.addToCart('" . $id . "', 1);\" style=\"cursor: pointer; vertical-align: middle;\" /></div>";
                    $html .= "</div>";
                }
            }
        }

        return array("content" => $html, "count" => count($found_products));
    }

    // Di questa funzione manca la paginazione!
    function searchImages($queries)
    {
        
        global $imSettings;
        $id = 0;
        $html = "";
        $found_images = array();
        $found_count = array();

        foreach ($imSettings['search']['images'] as $image) {
            $count = 0;
            $weight = 0;
            $t_title = strip_tags(imstrtolower($image['title']));
            $t_description = strip_tags(imstrtolower($image['description']));

            // Conto il numero di match nel titolo
            foreach ($queries as $query) {
                $t_count = preg_match_all('/' . preg_quote($query, '/') . '/', $t_title, $matches);
                if ($t_count !== false) {
                    $weight += ($t_count * 4);
                    $count += $t_count;
                }
            }

            // Conto il numero di match nella location
            foreach ($queries as $query) {
                $t_count = preg_match_all('/' . preg_quote($query, '/') . '/', imstrtolower($image['location']), $matches);
                if ($t_count !== false) {
                    $weight += ($t_count * 2);
                    $count += $t_count;
                }
            }

            // Conto il numero di match nella descrizione
            foreach ($queries as $query) {
                $t_count = preg_match_all('/' . preg_quote($query, '/') . '/', $t_description, $matches);
                if ($t_count !== false) {
                    $weight++;
                    $count += $t_count;
                }
            }

            if ($count > 0) {
                $found_images[$id] = $image;
                $found_weight[$id] = $weight;
                $found_count[$id] = $count;
            }

            $id++;
        }

        if (count($found_count)) {
            arsort($found_weight);
            $i = 0;
            foreach ($found_images as $id => $image) {
                $i++;
                if (($i > $this->page*$this->results_per_page) && ($i <= ($this->page+1)*$this->results_per_page)) {
                    $count = $found_count[$id];
                    $html .= "<div class=\"imSearchImageResult\">";
                    $html .= "<div class=\"imSearchImageResultContent\"><a href=\"" . $image['page'] . "\"><img src=\"" . $image['src'] . "\" /></a></div>";
                    $html .= "<div class=\"imSearchImageResultContent\">";
                    $html .= "<h3>" . $image['title'];
                    if ($image['location'] != "")
                        $html .= "&nbsp;(" . $image['location'] . ")";
                    $html .= "</h3>";
                    $html .= strip_tags($image['description']);
                    $html .= "</div>";
                    $html .= "</div>";
                }
            }
        }

        return array("content" => $html, "count" => count($found_images));
    }

    // Di questa funzione manca la paginazione!
    function searchVideos($queries)
    {
        
        global $imSettings;
        $id = 0;
        $found_count = array();
        $found_videos = array();
        $html = "";
        $month = 7776000;

        foreach ($imSettings['search']['videos'] as $video) {
            $count = 0;
            $weight = 0;
            $t_title = strip_tags(imstrtolower($video['title']));
            $t_description = strip_tags(imstrtolower($video['description']));

            // Conto il numero di match nei tag
            foreach ($queries as $query) {
                $t_count = preg_match_all('/\\s*' . preg_quote($query, '/') . '\\s*/', imstrtolower($video['tags']), $matches);
                if ($t_count !== false) {
                    $weight += ($t_count * 10);
                    $count += $t_count;
                }
            }

            // I video più recenti hanno maggiore peso in proporzione
            $time = strtotime($video['date']);
            $ago = strtotime("-3 months");
            if ($time - $ago > 0)
                $weight += 5 * max(0, ($time - $ago)/$month);

            // Conto il numero di match nel titolo
            foreach ($queries as $query) {
                $t_count = preg_match_all('/' . preg_quote($query, '/') . '/', $t_title, $matches);
                if ($t_count !== false) {
                    $weight += ($t_count * 4);
                    $count += $t_count;
                }
            }

            // Conto il numero di match nella categoria
            foreach ($queries as $query) {
                $t_count = preg_match_all('/' . preg_quote($query, '/') . '/', imstrtolower($video['category']), $matches);
                if ($t_count !== false) {
                    $weight += ($t_count * 2);
                    $count += $t_count;
                }
            }

            // Conto il numero di match nella descrizione
            foreach ($queries as $query) {
                $t_count = preg_match_all('/' . preg_quote($query) . '/', $t_description, $matches);
                if ($t_count !== false) {
                    $weight++;
                    $count += $t_count;
                }
            }

            if ($count > 0) {
                $found_videos[$id] = $video;
                $found_weight[$id] = $weight;
                $found_count[$id] = $count;
            }

            $id++;
        }

        if ($found_count) {
            arsort($found_weight);
            foreach ($found_videos as $id => $video) {
                $i++;
                if (($i > $this->page*$this->results_per_page) && ($i <= ($this->page+1)*$this->results_per_page)) {
                    $count = $found_count[$id];
                    $html .= "<div class=\"imSearchVideoResult\">";
                    $html .= "<div class=\"imSearchVideoResultContent\"><a href=\"" . $video['page'] . "\"><img src=\"" . $video['src'] . "\" /></a></div>";
                    $html .= "<div class=\"imSearchVideoResultContent\">";
                    $html .= "<h3>" . $video['title'];
                    if (!$video['familyfriendly'])
                        $html .= "&nbsp;<span style=\"color: red; text-decoration: none;\">[18+]</span>";
                    $html .= "</h3>";
                    $html .= strip_tags($video['description']);
                    if ($video['duration'] > 0) {
                        if (function_exists('date_default_timezone_set'))
                            date_default_timezone_set('UTC');
                        $html .= "<span class=\"imSearchVideoDuration\">" . l10n('search_duration') . ": " . date("H:i:s", $video['duration']) . "</span>";
                    }
                    $html .= "</div>";
                    $html .= "</div>";
                }
            }
        }

        return array("content" => $html, "count" => count($found_videos));
    }

    /**
     * Start the site search
     * 
     * @param array  $keys The search keys as string (string)
     * @param string $page Page to show (integer)
     *
     * @return void
     */
    function search($keys, $page = 0)
    {
        
        global $imSettings;

        $html = "";
        $content = "";

        //$html .= "<h2 id=\"imPgTitle\" class=\"searchPageTitle\">" . l10n('search_results') . "</h2>\n";
        $html .= "<div class=\"searchPageContainer\">";
        $html .= "<div class=\"imPageSearchField\"><form method=\"get\" action=\"imsearch.php\">";
        $html .= "<input style=\"width: 200px; font: 8pt Tahoma; color: rgb(0, 0, 0); background-color: rgb(255, 255, 255); padding: 3px; border: 1px solid rgb(0, 0, 0); vertical-align: middle;\" class=\"search_field\" value=\"" . $keys . "\" type=\"text\" name=\"search\" />";
        $html .= "<input style=\"height: 21px; font: 8pt Tahoma; color: rgb(0, 0, 0); background-color: rgb(211, 211, 211); margin-left: 6px; padding: 3px 3px; border: 1px solid rgb(0, 0, 0); vertical-align: middle; cursor: pointer;\" type=\"submit\" value=\"" . l10n('search_search') . "\">";
        $html .= "</form></div>\n";

        if ($keys == "" || $keys == null) {
            $html .= "<div style=\"margin-top: 15px; text-align: center; font-weight: bold;\">" . l10n('search_empty') . "</div>\n";
            echo $html;
            return false;
        }

        $search = trim(imstrtolower($keys));
        $this->page = $page;

        if ($search != "") {
            $queries = explode(" ", $search);
            $blog = array("count" => 0);
            $products = array("count" => 0);
            $images = array("count" => 0);
            $videos = array("count" => 0);

            // Pages
            $pages = $this->searchPages($queries);
            if ($pages['count'] > 0) {
                $content .= "<div id=\"imSearchWebPages\">" . $pages['content'] . "</div>\n";
            }

            // Blog
            if (isset($imSettings['blog']) && is_array($imSettings['blog']['posts']) && count($imSettings['blog']['posts']) > 0) {
                $blog = $this->searchBlog($queries);
                if ($blog['count'] > 0) {
                    $content .= "<div id=\"imSearchBlog\">" . $blog['content'] . "</div>\n";
                }
            }

            // Products
            if (is_array($imSettings['search']['products']) && count($imSettings['search']['products']) > 0) {
                $products = $this->searchProducts($queries);
                if ($products['count'] > 0) {
                    $content .= "<div id=\"imSearchProducts\">" . $products['content'] . "</div>\n";
                }
            }

            // Images
            if (is_array($imSettings['search']['images']) && count($imSettings['search']['images']) > 0) {
                $images = $this->searchImages($queries);
                if ($images['count'] > 0) {
                    $content .= "<div id=\"imSearchImages\">" . $images['content'] . "</div>\n";
                }
            }

            // Videos
            if (is_array($imSettings['search']['videos']) && count($imSettings['search']['videos']) > 0) {
                $videos = $this->searchVideos($queries);
                if ($videos['count'] > 0) {
                    $content .= "<div id=\"imSearchVideos\">" . $videos['content'] . "</div>\n";
                }
            }

            $results_count = max($pages['count'], $blog['count'], $products['count'], $images['count'], $videos['count']);

            if ($pages['count'] == 0 && $blog['count'] == 0 && $products['count'] == 0 && $images['count'] == 0 && $videos['count'] == 0) {
                $html .= "<div style=\"text-align: center; font-weight: bold;\">" . l10n('search_empty') . "</div>\n";
            } else {
                $sidebar = "<ul>\n";
                if ($pages['count'] > 0)
                    $sidebar .= "\t<li><span class=\"imScMnTxt\"><a href=\"#imSearchWebPages\" onclick=\"return x5engine.imSearch.Show('#imSearchWebPages')\">" . l10n('search_pages') . " (" . $pages['count'] . ")</a></span></li>\n";
                if ($blog['count'] > 0)
                    $sidebar .= "\t<li><span class=\"imScMnTxt\"><a href=\"#imSearchBlog\" onclick=\"return x5engine.imSearch.Show('#imSearchBlog')\">" . l10n('search_blog') . " (" . $blog['count'] . ")</a></span></li>\n";
                if ($products['count'] > 0)
                    $sidebar .= "\t<li><span class=\"imScMnTxt\"><a href=\"#imSearchProducts\" onclick=\"return x5engine.imSearch.Show('#imSearchProducts')\">" . l10n('search_products') . " (" . $products['count'] . ")</a></span></li>\n";
                if ($images['count'] > 0)
                    $sidebar .= "\t<li><span class=\"imScMnTxt\"><a href=\"#imSearchImages\" onclick=\"return x5engine.imSearch.Show('#imSearchImages')\">" . l10n('search_images') . " (" . $images['count'] . ")</a></span></li>\n";
                if ($videos['count'] > 0)
                    $sidebar .= "\t<li><span class=\"imScMnTxt\"><a href=\"#imSearchVideos\" onclick=\"return x5engine.imSearch.Show('#imSearchVideos')\">" . l10n('search_videos') . " (" . $videos['count'] . ")</a></span></li>\n";
                $sidebar .= "</ul>\n";

                $html .= "<div id=\"imSearchResults\">\n";
                if ($imSettings['search']['general']['menu_position'] == "left") {
                    $html .= "\t<div id=\"imSearchSideBar\" style=\"float: left;\">" . $sidebar . "</div>\n";
                    $html .= "\t<div id=\"imSearchContent\" style=\"float: right;\">" . $content . "</div>\n";
                } else {
                    $html .= "\t<div id=\"imSearchContent\" style=\"float: left;\">" . $content . "</div>\n";
                    $html .= "\t<div id=\"imSearchSideBar\" style=\"float: right;\">" . $sidebar . "</div>\n";
                }
                $html .= "</div>\n";
            }

            // Pagination
            if ($results_count > $this->results_per_page) {
                $html .= "<div style=\"text-align: center; clear: both;\">";
                // Back
                if ($page > 0) {
                    $html .= "<a href=\"imsearch.php?search=" . implode("+", $queries) . "&amp;page=" . ($page - 1) . "\">&lt;&lt;</a>&nbsp;";
                }

                // Central pages
                $start = max($page - 5, 0);
                $end = min($page + 10 - $start, ceil($results_count/$this->results_per_page));

                for ($i = $start; $i < $end; $i++) {
                    if ($i != $this->page)
                        $html .= "<a href=\"imsearch.php?search=" . implode("+", $queries) . "&amp;page=" . $i . "\">" . ($i + 1) . "</a>&nbsp;";
                    else
                        $html .= ($i + 1) . "&nbsp;";
                }

                // Next
                if ($results_count > ($page + 1) * $this->results_per_page) {
                    $html .= "<a href=\"imsearch.php?search=" . implode("+", $queries) . "&amp;page=" . ($page + 1) . "\">&gt;&gt;</a>";
                }
                $html .= "</div>";
            }

        } else
            $html .= "<div style=\"margin-top: 15px; text-align: center; font-weight: bold;\">" . l10n('search_empty') . "</div>\n";

        $html .= "</div>";

        echo $html;
    }
}


/**
 * Contains the methods used to style and send emails
 * @access public
 */
class ImSendEmail
{

    var $header;
    var $footer;
    var $bodyBackground;
    var $bodyBackgroundEven;
    var $bodyBackgroundOdd;
    var $bodyBackgroundBorder;
    var $bodySeparatorBorderColor;
    var $emailBackground;
    var $emailContentStyle;
    var $emailType = "html";

    function setHTMLHeader($header)
    {
        $this->header = $header;
    }

    function setHTMLFooter($footer)
    {
        $this->footer = $footer;
    }

    function setBodyBackground($val)
    {
        $this->bodyBackground = $val;
    }

    function setBodyBackgroundEven($val)
    {
        $this->bodyBackgroundEven = $val;
    }

    function setBodyBackgroundOdd($val)
    {
        $this->bodyBackgroundOdd = $val;
    }

    function setBodyBackgroundBorder($val)
    {
        $this->bodyBackgroundBorder = $val;
    }

    function setEmailBackground($val)
    {
        $this->emailBackground = $val;
    }

    function setEmailContentStyle($val)
    {
        $this->emailContentStyle = $val;
    }

    function setBodySeparatorBorderColor($val)
    {
        $this->bodySeparatorBorderColor = $val;
    }

    function setEmailType($type) {
        $this->emailType = $type;
    }

    /**
     * Apply the CSS style to the HTML code
     * @param  string $html The HTML code
     * @return string       The styled HTML code
     */
    function styleHTML($html)
    {
        $html = str_replace("[email:contentStyle]", $this->emailContentStyle, $html);
        $html = str_replace("[email:bodyBackground]", $this->bodyBackground, $html);
        $html = str_replace("[email:bodyBackgroundBorder]", $this->bodyBackgroundBorder, $html);
        $html = str_replace("[email:bodyBackgroundOdd]", $this->bodyBackgroundOdd, $html);
        $html = str_replace("[email:bodyBackgroundEven]", $this->bodyBackgroundEven, $html);
        $html = str_replace("[email:bodySeparatorBorderColor]", $this->bodySeparatorBorderColor, $html);
        $html = str_replace("[email:emailBackground]", $this->emailBackground, $html);
        return $html;
    }

    /**
     * Send an email
     * 
     * @param string $from        Self explanatory
     * @param string $to          Self explanatory
     * @param string $subject     Self explanatory
     * @param string $text        Self explanatory
     * @param string $html        Self explanatory
     * @param array  $attachments Self explanatory
     * 
     * @return boolean
     */
    function send($from = "", $to = "", $subject = "", $text = "", $html = "", $attachments = array())
    {
        $email = new imEMail($from, $to, $subject, "utf-8");
        $email->setText($text);
        $email->setHTML($this->header . $this->styleHTML($html) . $this->footer);
        $email->setStandardType($this->emailType);
        foreach ($attachments as $a) {
            if (isset($a['name']) && isset($a['content']) && isset($a['mime'])) {
                $email->attachFile($a['name'], $a['content'], $a['mime']);
            }
        }
        return $email->send();
    }

    /**
     * Restore some special chars escaped previously in WSX5
     * 
     * @param string $str The string to be restored
     *
     * @return string
     */
    function restoreSpecialChars($str)
    {
        $str = str_replace("{1}", "'", $str);
        $str = str_replace("{2}", "\"", $str);
        $str = str_replace("{3}", "\\", $str);
        $str = str_replace("{4}", "<", $str);
        $str = str_replace("{5}", ">", $str);
        return $str;
    }

    /**
     * Decode the Unicode escaped chars like %u1239
     * 
     * @param string $str The string to be decoded
     *
     * @return string
     */
    function decodeUnicodeString($str)
    {
        $res = '';

        $i = 0;
        $max = strlen($str) - 6;
        while ($i <= $max) {
            $character = $str[$i];
            if ($character == '%' && $str[$i + 1] == 'u') {
                $value = hexdec(substr($str, $i + 2, 4));
                $i += 6;

                if ($value < 0x0080) // 1 byte: 0xxxxxxx
                    $character = chr($value);
                else if ($value < 0x0800) // 2 bytes: 110xxxxx 10xxxxxx
                    $character = chr((($value & 0x07c0) >> 6) | 0xc0) . chr(($value & 0x3f) | 0x80);
                else // 3 bytes: 1110xxxx 10xxxxxx 10xxxxxx
                $character = chr((($value & 0xf000) >> 12) | 0xe0) . chr((($value & 0x0fc0) >> 6) | 0x80) . chr(($value & 0x3f) | 0x80);
            } else
                $i++;

            $res .= $character;
        }
        return $res . substr($str, $i);
    }
}

/**
 * Server Test Class
 * @access public
 */
class imTest {

    /*
     * Session check
     */
    function session_test()
    {
        
        if (!isset($_SESSION))
            return false;
        $_SESSION['imAdmin_test'] = "test_message";
        return ($_SESSION['imAdmin_test'] == "test_message");
    }

    /*
     * Writable files check
     */
    function writable_folder_test($dir)
    {
        if (!file_exists($dir) && $dir != "" && $dir != "./.")
            @mkdir($dir, 0777, true);

        $fp = @fopen(pathCombine(array($dir, "imAdmin_test_file")), "w");
        if (!$fp)
            return false;
        if (@fwrite($fp, "test") === false)
            return false;
        @fclose($fp);
        if (!@file_exists(pathCombine(array($dir, "imAdmin_test_file"))))
            return false;
        @unlink(pathCombine(array($dir, "imAdmin_test_file")));
        return true;
    }

    /*
     * PHP Version check
     */
    function php_version_test()
    {   
        if (!function_exists("version_compare") || version_compare(PHP_VERSION, '4.0.0') < 0)
            return false;
        return true;
    }

    /*
     * MySQL Connection check
     */
    function mysql_test($host, $user, $pwd, $name)
    {
        $db = new ImDb($host, $user, $pwd, $name);
        if (!$db->testConnection())
            return false;
        $db->closeConnection();
        return true;
    }

    /*
     * Do the test
     */
    function doTest($expected, $value, $title, $message)
    {
        if ($expected == $value)
            echo "<div class=\"imTest pass\">" . $title . "<span>PASS</span></div>";
        else
            echo "<div class=\"imTest fail\">" . $title . "<span>FAIL</span><p>" . $message . "</p></div>";
    }
}




/**
 * XML Handling class
 * @access public
 */
class imXML 
{
    var $tree = array();
    var $force_to_array = array();
    var $error = null;
    var $parser;
    var $inside = false;

    // PHP 5
    function __construct($encoding = 'UTF-8')
    {
        $this->setUp($encoding);
    }

    // PHP 4
    function imXML($encoding = 'UTF-8')
    {
        $this->setUp($encoding);   
    }

    function setUp($encoding = 'UTF-8')
    {
        $this->parser = xml_parser_create($encoding);
        xml_set_object($this->parser, $this); // $this was passed as reference &$this
        xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($this->parser, XML_OPTION_SKIP_WHITE, 1);
        xml_set_element_handler($this->parser, "startEl", "stopEl");
        xml_set_character_data_handler($this->parser, "charData");
        xml_parser_set_option($this->parser, XML_OPTION_TARGET_ENCODING, 'UTF-8');
    }

    function parse_file($file)
    {
        $fp = @fopen($file, "r");
        if (!$fp)
            return false;
        while ($data = fread($fp, 4096)) {
            if (!xml_parse($this->parser, $data, feof($fp))) {
                return false;
            }
        }
        fclose($fp);
        return $this->tree[0]["content"];
    }

    function parse_string($str)
    {
        if (!xml_parse($this->parser, $str))
            return false;
        if (isset($this->tree[0]["content"]))
            return $this->tree[0]["content"];
        return false;
    }

    function startEl($parser, $name, $attrs)
    {
        array_unshift($this->tree, array("name" => $name));
        $this->inside = false;
    }

    function stopEl($parser, $name)
    {
        if ($name != $this->tree[0]["name"])
            return false;
        if (count($this->tree) > 1) {
            $elem = array_shift($this->tree);
            if (isset($this->tree[0]["content"][$elem["name"]])) {
                if (is_array($this->tree[0]["content"][$elem["name"]]) && isset($this->tree[0]["content"][$elem["name"]][0])) {
                    array_push($this->tree[0]["content"][$elem["name"]], $elem["content"]);
                } else {
                    $this->tree[0]["content"][$elem["name"]] = array($this->tree[0]["content"][$elem["name"]],$elem["content"]);
                }
            } else {
                if (in_array($elem["name"], $this->force_to_array)) {
                    $this->tree[0]["content"][$elem["name"]] = array($elem["content"]);
                } else {
                    if (!isset($elem["content"])) $elem["content"] = "";
                    $this->tree[0]["content"][$elem["name"]] = $elem["content"];
                }
            }
        }
        $this->inside = false;
    }

    function charData($parser, $data)
    {
        if (!preg_match("/\\S/", $data))
                return false;
        if ($this->inside) {
            $this->tree[0]["content"] .= $data;
        } else {
            $this->tree[0]["content"] = $data;
        }
        $this->inside_data = true; 
    }
}


/**
 * Some useful functions
 *
 * @category X5engine
 * @package  X5engine
 * @license  Copyright by Incomedia http://incomedia.eu
 * @link     http://websitex5.com
 */

/**
 * Prints an error about not active JS
 *
 * @param $docType True to use the meta redirect with a complete document. False to use a javascript code.
 * 
 * @return void
 */
function imPrintJsError($docType = true)
{
    if ($docType) {
        $html = "<DOCTYPE><html><head><meta http-equiv=\"Refresh\" content=\"5;URL=" . $_SERVER['HTTP_REFERER'] . "\"></head><body>";
        $html .= l10n('form_js_error');
        $html .= "</body></html>";
    } else {
        $html = "<meta http-equiv=\"Refresh\" content=\"5;URL=" . $_SERVER['HTTP_REFERER'] . "\">";
        $html .= l10n('form_js_error');
    }
    return $html;
}

/**
 * Check the user's access to $page
 * 
 * @param string $page The page to check
 * 
 * @return void
 */
function imCheckAccess($page)
{
    $pa = new imPrivateArea();
    $stat = $pa->checkAccess($page);
    if ($stat !== 0) {
        $pa->save_page();
        header("Location: imlogin.php" . ($stat == -2 ? "?err=1" : ""));
        exit;
    }
}


/**
 * Shuffle an associate array
 * 
 * @param array $list The array to shuffle
 * 
 * @return array       The shuffled array
 */
function shuffleAssoc($list)
{
    if (!is_array($list))
        return $list;
    $keys = array_keys($list);
    shuffle($keys);
    $random = array();
    foreach ($keys as $key)
        $random[$key] = $list[$key];
    return $random;
}

/**
 * Provide a fallback for the PHP5 stripos function
 * 
 * @param string  $haystack Where to search
 * @param string  $needle   What to replace
 * @param integer $offset   Start searching from here
 * 
 * @return integer          The position of the searched string
 */
function imstripos($haystack, $needle , $offset = 0)
{
    if (function_exists('stripos')) // Is PHP5+
        return stripos($haystack, $needle, $offset);

    // PHP4 fallback
    return strpos(strtolower($haystack), strtolower($needle), $offset);
}

/**
 * Provide a localization helper
 * 
 * @param string $id      The localization key
 * @param string $default The default string
 * 
 * @return string          The localization
 */
function l10n($id, $default = "")
{
    global $l10n;

    if (!isset($l10n[$id]))
        return $default;

    return $l10n[$id];
}

/**
 * Combine paths
 * 
 * @param  array  $paths
 * 
 * @return string
 */
function pathCombine($paths = array())
{
    $s = array();
    foreach ($paths as $path) {
        if (strlen($path))
            $s[] = trim($path, "/\\ ");
    }
    return implode("/", $s);
}

/**
 * Try to convert a string to lowercase using multibyte encoding
 * 
 * @param  string $str
 * 
 * @return string
 */
function imstrtolower($str) {
    return (function_exists("mb_convert_case") ? mb_convert_case($str, MB_CASE_LOWER, "UTF-8") : strtolower($str));
}


// End of file