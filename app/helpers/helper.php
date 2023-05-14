<?php

// перенаправление страницы

function redirect($page)
{
    header('location: ' . URLROOT . '/' . $page);
}

 function is_post_request(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}

function isLoggedIn(): bool
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}