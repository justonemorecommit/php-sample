<?php

namespace App\Common\Models;

use DateTime;

/** @MappedSuperclass */
class AppModel
{
    /**
     * @Column(type="date", options={"default" : "now()"})
     */
    public $created_at;

    /**
     * @Column(type="date", options={"default" : "now()"})
     */
    public $updated_at;

    public function __construct()
    {
        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
    }
}
