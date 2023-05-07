<?php
session_start();

// DB Params
const DB_HOST = "your_host";
const DB_USER = "your_user";
const DB_PASS = "your_pass";
const DB_NAME = "your_db_name";

// App Root

define('APPROOT', dirname(__FILE__ , 2) );

// URL root

const URLROOT = 'http://localhost:8000/';

// Site Name
const SITENAME = 'SharePosts';

// Версия сайта

const APPVERSION = '1.0.0';
