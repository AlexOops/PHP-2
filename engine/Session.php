<?php

namespace app\engine;

class Session
{
    public function sessionId()
    {
        return session_id();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function destroy()
    {
        session_destroy();
    }

    public function sessionRegenerateId()
    {
        session_regenerate_id();
    }
}