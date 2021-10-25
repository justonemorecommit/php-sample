<?php

namespace App\Expense\Models;

use App\Common\Models\AppModel;
use Doctrine\ORM\EntityManager;

/**
 * @Entity
 * @Table(name="expenses")
 */
class Expense extends AppModel
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
    public $category;

    /**
     * @Column(type="decimal")
     */
    public $amount;

    /**
     * @Column(type="date")
     */
    public $date;

    /**
     * @Column(type="integer")
     */
    public $user_id;

    /**
     * @Column(type="text")
     */
    public $description;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public static function getByUser(EntityManager $em, $user_id)
    {
        $qb = $em->createQueryBuilder();
        $qb->select('e')
            ->from(\App\Expense\Models\Expense::class, 'e')
            ->where('e.user_id=:user_id')
            ->orderBy('e.created_at', 'desc')
            ->setParameter('user_id', $user_id);
        $expenses = $qb->getQuery()->getResult();

        return $expenses;
    }
}
