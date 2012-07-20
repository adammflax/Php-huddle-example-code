<?php
session_start();
const CLIENT_ID     = 'FileAdminProjectHuddleOob';
const CLIENT_SECRET = '';

const REDIRECT_URI           = 'http://127.0.0.1:8181/auth/callback';
const AUTHORIZATION_ENDPOINT = 'http://login.huddle.dev/request/';
const TOKEN_ENDPOINT         = 'http://login.huddle.dev/token/';

$_SESSION['code']= $_GET['code'];
header("Location: http://127.0.0.1:8181");
?>