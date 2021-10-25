<?php

namespace App\Auth\Services;

use App\Auth\Models\User;
use App\Common\Services\SessionService;

class AuthService
{
    /**
     * @var SessionService
     */
    private $session;

    public function __construct(SessionService $session)
    {
        $this->session = $session;
    }

    public function setUser(User $user)
    {
        return $this->session->set('auth_user', $user);
    }

    public function getUser()
    {
        return $this->session->get('auth_user', null);
    }

    public function user()
    {
        return $this->getUser();
    }

    public function authenticated()
    {
        return boolval($this->getUser());
    }
}
