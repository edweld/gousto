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
	/**
	 * @access protected
	 * @var resource Database handle Silex\Provider\DoctrineServiceProvider
	 */
    protected $db;

    /**
     * Class constructor, calls instantiateControllers() method
     * @param object Silex\Provider\DoctrineServiceProvider $db 
     * @return void
     * @access public
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

}