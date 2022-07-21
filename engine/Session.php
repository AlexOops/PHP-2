<?php

namespace app\engine;

class Session
{
    public function getId()
    {
        return session_id();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function destroy()
    {
        session_destroy();
    }

    public function regenerate()
    {
        session_regenerate_id();
    }
}