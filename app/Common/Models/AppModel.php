<?php

namespace App\Common\Models;

use DateTime;
use Doctrine\ORM\EntityManager;

/** @MappedSuperclass */
class AppModel
{
    /**
     * @Column(type="datetime", options={"default" : "now()"})
     */
    public $created_at;

    /**
     * @Column(type="datetime", options={"default" : "now()"})
     */
    public $updated_at;

    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }

        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
    }

    public static function find(EntityManager $em, $class, $id)
    {
        $qb = $em->createQueryBuilder();
        $qb->select('e')
            ->from($class, 'e')
            ->where('e.id=:id')
            ->setParameter('id', $id);

        $results = $qb->getQuery()->getResult();

        return count($results) > 0 ? $results[0] : null;
    }

    public function setAttributes(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
