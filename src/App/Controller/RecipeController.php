<?php

/**
 * Recipe Controller
 * @author: Ed Weld <edweld@gmail.com>
 * @package edweld/gousto <https://github.com/edweld/gousto>
 * PHP version 7
 */


namespace App\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Validator\CuisineValidator;
use App\Exception\RecipeInvalidException;

class RecipeController
{
	/**
	 * @var resource RecipeService API
	 * @access protected
	 */
	protected $recipeService;

	/**
     * Class constructor
     * @param resource recipe service handle
     * @return void
     * @access public
     */
    public function __construct($service){
        $this->recipeService = $service;
    }

    /**
     * Fetch one record 
     * @access public
     * @param int $id the recipe id
     * @return object JsonResonse object
     */
    public function getOneById( $id )
    {
    	$res = $this->recipeService->fetchOneById( (int) $id);
        if($res){
        	return new JsonResponse($res);
        }
        return new JsonResponse('Error: Id not found', 400);
    }

    
    /**
     * Fetch all records for a specific cuisine,
     * implements CuisineValidator 
     * @access public
     * @param string $cuisine the recipe_cuisine
     * @param int $perpage number of results per page
     * @param int $page pagination page
     * @return object JsonResonse object, with error on invalid request
     */
    public function getAllByCuisine($cuisine, $page, $perpage)
    {
    	$validator = new CuisineValidator;

    	if($validator->validate($cuisine)){
    		$res = $this->recipeService->fetchAllByCuisine($cuisine, $perpage, $page);
    		return new JsonResponse($res);
    	}
    	return new JsonResponse('Error: invalid cuisine', 400);
    }
    
    /**
     * add recipe to application
     * @access public
     * @param object HttpRequest object populated with array data
     * @return object JsonResponse object populated with results or error on invalid data
     */
    public function addRecipe(Request $request)
    {
    	try{
    	    $data = $this->getValidatedRecipeDataFromRequest($request);
    	    $res = $this->recipeService->addRecipe($data);
            return new JsonResponse(['id'=>$res]);
    	} catch(RecipeInvalidException $e){
    		return new JsonResponse('Error: ' . $e->getMessage(), 400);
    	}
    }

    /**
     * @access public
     * @param object HttpRequest object containing recipe and id
     * @return object JsonResponse object populated with insert id or error
     */
    public function updateRecipe(Request $request)
    {
    	try{
    		$data = $this->getValidatedRecipeDataFromRequest($request);
            $res = $this->recipeService->updateRecipe( (int) $request->get('id'), $data );
            return new JsonResponse('Update Successful');
    	} catch(RecipeInvalidException $e){
    		return new JsonResponse('Error: ' . $e->getMessage(), 400);
    	}
    }

    /**
     * adds a rating to a recipe
     * @access public
     * @param object HttpRequest object
     * @return JsonResponse object populated with insert id
     */
    public function addRating(Request $request, $recipe_id)
    {
        $id = (int) $request['recipe_id'];
        $rating = $request['rating'];
        $res = $this->recipeService->addRatingById($recipe_id, $rating);
        return new JsonResponse(["id"=>$res]);
    }

    /**
     * validate request data has the correct fields to assert against the database
     * @access protected
     * @param object HttpRequest 
     * @return mixed recipe data
     */
    protected function getValidatedRecipeDataFromRequest( Request $request )
    {
    	$data = $request->request->all();
    	$validator = new CuisineValidator;

        if(array_key_exists('id', $data)){
        	unset($data['id']);
        }

    	if(!array_key_exists('title', $data) || empty($data['title'])){
            throw new RecipeInvalidException('Recipe title is required');
    	}

    	if(!$validator->validate($data['recipe_cuisine']))
    	{
    	    throw new RecipeInvalidException('Recipe does not have a valid cuisine');
    	}
        //get data from request
    	return $data;
    }

}
