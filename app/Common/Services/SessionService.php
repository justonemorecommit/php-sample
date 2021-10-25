<?php

namespace App\Common\Services;

class SessionService
{
    public function start()
    {
        session_start();
    }

    public function set(string $key, $value)
    {
        $_SESSION['app_' . $key] = $value;

        return $value;
    }

    public function get(string $key, $defaultValue = null)
    {
        return $_SESSION['app_' . $key] ?? $defaultValue;
    }

    public function has(string $key)
    {
        return isset($_SESSION[$key]);
    }

    public function unset(string $key)
    {
        unset($_SESSION[$key]);
    }

    public function setStatus(array $options)
    {
        $this->set(
            'status',
            [
                'type' => isset($options['status'])
                    ? $options['status']
                    : 'success',
                'message' =>  isset($options['message'])
                    ? $options['message']
                    : 'Successfully done!'
            ]
        );
    }

    public function getStatus()
    {
        return $this->get('status', [
            'type' => null,
            'message' => null
        ]);
    }
}
