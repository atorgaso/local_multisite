<?php
/**
 * Plugin Name: Test CSP
 * Description: Добавляет простую Content Security Policy
 */

add_action('send_headers', function() {
    header("Content-Security-Policy: default-src 'self'; script-src 'self'");
});
