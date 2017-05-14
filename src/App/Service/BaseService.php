<?php
/**
 * Base Database service
 * @author: Ed Weld <edweld@gmail.com>
 * @package edweld/gousto <https://github.com/edweld/gousto>
 * PHP version 7
 */

namespace App\Service;

class BaseService
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

}