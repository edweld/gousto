<?php
/**
 * Recipe Service
 * @author: Ed Weld <edweld@gmail.com>
 * @package edweld/gousto <https://github.com/edweld/gousto>
 * PHP version 7
 */

namespace App\Service;

class RecipeService extends BaseService {

    /**
     * Return one record by database id
     * @access public
     * @param int $id the recipe id
     * @return mixed 
     */
	public function fetchOneById( int $id)
	{
        return $this->db->fetchAssoc("SELECT * FROM recipe WHERE id=?", [(int) $id]);
	}

	/**
     * Return all records by recipe_cuisine
     * @access public
     * @param int $id the recipe id
     * @param int $perpage the number of results per page to return
     * @param int $page the page of pagination
     * @return mixed data
     */
	public function fetchAllByCuisine( $recipe_cuisine, $perpage, $page)
	{

	}

	/**
	 * Return total number of reviews for recipe_id
	 * @access public
	 * @param int $recipe_id recipe id
	 * @return int total number of records
	 */
	public function countRatingsForId( int $recipe_id)
	{

	}

	/**
	 * Add rating for recipe
	 * @access public
	 * @param int $recipe_id 
	 * @param mixed $recipe Recipe data
	 * @return int last insert id
	 */
	public function fetchAllRatingsForRecipe( int $recipe_id, $recipe)
	{

	}

	/**
	 * Update existing recipe
	 * @access public
	 * @param int $id recipe id
	 * @param mixed $recipe array of recipe data
	 * @return int last insert id
	 */
	public function updateRecipeById(int $id, $recipe)
	{

	}

	/**
	 * Add new recipe
	 * @access public 
	 * @param mixed $recipe array of recipe data
	 * @return int last insert id
	 */
	public function addRecipe($recipe)
	{

	}

}