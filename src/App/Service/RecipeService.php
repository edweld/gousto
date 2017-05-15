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
        $page = ($page <= 1) ? 1 : $page;
        $offset = ($page -1) * $perpage;
        return $this->db->fetchAll("SELECT * FROM recipe WHERE recipe_cuisine=? LIMIT $offset, $perpage", [$recipe_cuisine]);
	}

	/**
	 * Fetch all ratings for recipe
	 * @access public
	 * @param int $recipe_id 
	 * @return mixed all ratings for recipe
	 */
	public function fetchRating( int $recipe_id)
	{
        return $this->db->fetchAll("SELECT * from rating WHERE recipe_id =?",[$recipe_id]);
	}

	/**
	 * Update existing recipe
	 * @access public
	 * @param int $id recipe id
	 * @param mixed $recipe_update array of recipe data
	 * @return int last insert id
	 */
	public function updateRecipeById(int $recipe_id, $recipe)
	{
         return $this->db->update('recipe', $recipe, ['id' => $recipe_id]);
	}

	/**
	 * Add new recipe
	 * @access public 
	 * @param mixed $recipe array of recipe data
	 * @return int last insert id
	 */
	public function addRecipe($recipe)
	{
        $this->db->insert("recipe", $recipe);
        return $this->db->lastInsertId();
	}

	/**
	 * Add rating to recipe
	 * @access public
	 * @param int $id recipe id to update
	 * @param int $rating rating of recipe
	 * @return int the last db insert id
	 */
	public function addRatingById( int $recipe_id, int $rating)
	{
		$this->db->insert("rating",['recipe_id'=>$recipe_id, 'rating'=>$rating]);
		return $this->db->lastInsertId();
	}
}