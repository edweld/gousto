<?php
/**
 * Cuisine Validator
 *
 * As we are unsure where the actual information for allowed 
 * cuisines might come from it is just abstracted here as an array 
 * but managed as a validation object.
 *
 * 
 * @author: Ed Weld <edweld@gmail.com>
 * @package edweld/gousto <https://github.com/edweld/gousto>
 * PHP version 7
 */

 namespace App\Validator;

 class CuisineValidator
 {
    /**
     * @access private
     * @var mixed $cuisines an array of allowed cuisines
     */
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
