<?php

namespace App\Auth\Models;

use App\Common\Models\AppModel;
use Doctrine\ORM\EntityManager;

/**
 * @Entity
 * @Table(name="users")
 */
class User extends AppModel
{
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     */
    public $id;

    /**
     * @Column(type="string")
     */
    public $first_name;

    /**
     * @Column(type="string")
     */
    public $last_name;

    /**
     * @Column(type="string")
     */
    public $email;

    /**
     * @Column(type="string")
     */
    public $password;

    public function __construct(array $attributes = [])
    {
        parent::__construct();

        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }

        if (isset($attributes['password']))
            $this->setPassword($attributes['password']);
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function setPassword(string $password_plain)
    {
        $this->password = password_hash(
            $password_plain,
            PASSWORD_BCRYPT
        );
    }

    public function verifyPassword(string $password_plain)
    {
        return password_verify($password_plain, $this->password);
    }

    public static function checkEmailDuplication(
        EntityManager $em,
        string $email
    ) {
        $qb = $em->createQueryBuilder();
        $qb->select('u')
            ->from(self::class, 'u')
            ->where('u.email = :email')
            ->setMaxResults(1)
            ->setParameter('email', $email);
        $results = $qb->getQuery()->getResult();

        return count($results) > 0;
    }
}
