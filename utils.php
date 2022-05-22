<?php

const BASENAME = 'http://localhost/';
const APP_NAME = 'Awesome Blog';

/**
 * @param string $name
 * @return string|void
 */
function post(string $name)
{
    if (isset($_POST[$name]))
        return htmlspecialchars(trim($_POST[$name]));
}

/**
 * @param string $name
 * @return string|void
 */
function get(string $name)
{
    if (isset($_GET[$name]))
        return htmlspecialchars(trim($_GET[$name]));
}

/**
 * @param string $name
 * @return mixed|void
 */
function session(string $name)
{
    if (isset($_SESSION[$name]))
        return $_SESSION[$name];
}

/**
 * @param string|null $url
 * @return string
 */
function site_url(string $url = null): string
{
    return BASENAME . $url;
}

/**
 * @param string $title
 * @return string
 */
function doc_name(string $title): string
{
    return $title . ' | ' . APP_NAME;
}