<?php

class User
{
    private string $name;

    private string $language;

    public function __construct()
    {
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
        session_start();
        $_SESSION['language'] = $language;
    }
}
