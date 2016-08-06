<?php
/**
 * Class UserRepository
 *
 * @author Rafael
 */
namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 *
 * This performs all user related queries
 */
class UserRepository
{
    use ModelTrait;

    /**
     * Constructor
     *
     * Initialize all class needed
     *
     * @param \App\Models\User $userModel
     */
    public function __construct(User $userModel)
    {
        $this->setModel($userModel);
    }

    /**
     * Compose a search condition for the query
     *
     * @param Array $search
     * @return \Illuminate\Database\Eloquent\Collection $search
     */
    public function search($search)
    {
        return $this->getModel()
            ->with('blogs')
            ->orderBy('created_at', 'desc');
    }
}
