<?php

class inputManager {

    public function __construct() {

        if (function_exists('get_magic_quotes_runtime') && get_magic_quotes_runtime()) {
            set_magic_quotes_runtime(false);
        }

        $this->post = $_POST;
        $this->get = $_GET;
        $this->cookie = $_COOKIE;

        if (get_magic_quotes_gpc()) {
            $this->array_stripslashes($this->post);
            $this->array_stripslashes($this->get);
            $this->array_stripslashes($this->cookie);
        }

        $this->cleanPosts();
        $this->cleanGets();
        $this->cleanCookies();
    }

    private function cleanPosts() {
        foreach ($this->post as $key => $value) {
            if (is_array($value)) {
                $value_cleaned = $value;
            } else {
                $value = trim($value);
                $value_cleaned = htmlspecialchars($value);
            }
            $this->p[$key] = $value;
            $this->pc[$key] = $value_cleaned;
            $this->r[$key] = $value;
            $this->rc[$key] = $value_cleaned;
        }
    }

    private function cleanGets() {
        foreach ($this->get as $key => $value) {
            if (is_array($value)) {
                $value_cleaned = $value;
            } else {
                $value = trim($value);
                $value_cleaned = htmlspecialchars($value);
            }
            $this->g[$key] = $value;
            $this->gc[$key] = $value_cleaned;
            $this->r[$key] = $value;
            $this->rc[$key] = $value_cleaned;
        }
    }

    private function cleanCookies() {
        foreach ($this->cookie as $key => $value) {
            if (is_array($value)) {
                $value_cleaned = $value;
            } else {
                $value = trim($value);
                $value_cleaned = htmlspecialchars($value);
            }
            $this->c[$key] = $value;
            $this->cc[$key] = $value_cleaned;
        }
    }

    private function array_stripslashes(&$array) {
        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (is_array($array[$key])) {
                    $this->array_stripslashes($array[$key]);
                } else {
                    $array[$key] = stripslashes($array[$key]);
                }
            }
        }
    }

}
