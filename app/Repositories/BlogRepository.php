<?php
/**
 * Class BlogRepository
 *
 * @author Rafael
 */
namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

/**
 * Class BlogRepository
 *
 * This performs all blog related queries
 */
class BlogRepository
{
    use ModelTrait;

    /**
     * Constructor
     *
     * Initialize all class needed
     *
     * @param \App\Models\Blog $blogModel
     */
    public function __construct(Blog $blogModel)
    {
        $this->setModel($blogModel);
    }

    /**
     * Compose a search condition for the query
     *
     * @param array $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($search)
    {
        $blog = $this->getModel();

        if (array_key_exists('id', $search) && ! empty($search['id'])) {
            $blog = $blog->where('id', $search['id']);
        }

        $blog->with('user');

        return $blog;
    }

    /**
     * Create a single record through model
     *
     * @param array $userInput
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws \Exception $e
     */
    public function create($userInput)
    {
        // holds the list of fields to be updated
        $data = [];

        if (array_key_exists('title', $userInput)) {
            $data['title'] = trim($userInput['title']);
        }

        if (array_key_exists('body', $userInput)) {
            $data['body'] = trim($userInput['body']);
        }

        if (array_key_exists('action', $userInput)) {
            $data['status'] = trim($userInput['action']);
        }

        // get currently logged-in user
        $data['user_id'] = Auth::user()->id;

        try {
            // add record
            return $this->addRecord($data);
        } catch (\Exception $e) {
            throw $e;
        }
    }
    
    /**
     * Update a single record through model
     *
     * @param $id
     * @param $userInput
     * @return bool|\Illuminate\Database\Eloquent\Collection
     */
    public function update($id, $userInput)
    {
        // holds the list of fields to be updated
        $data = [];

        if (array_key_exists('title', $userInput)) {
            $data['title'] = trim($userInput['title']);
        }

        if (array_key_exists('body', $userInput)) {
            $data['body'] = trim($userInput['body']);
        }

        if (array_key_exists('action', $userInput)) {
            $data['status'] = trim($userInput['action']);
        }

        try {
            // update record
            return $this->updateRecord($id, $data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
