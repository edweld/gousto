<?php
/**
 * Cuisine Validator
 * @author: Ed Weld <edweld@gmail.com>
 * @package edweld/gousto <https://github.com/edweld/gousto>
 * PHP version 7
 */

 namespace App\Validator;

 class CuisineValidator
 {
    private $cuisines = ['british', 'asian', 'italian','mediteranean','mexican'];

    /**
     * validate 
     * @access public
     * @param string recipe_cuisine
     * @return boolean 
     */
    public function validate( $recipe_cuisine)
    {
    	return in_array($recipe_cuisine, $this->cuisines);
    }
 }
