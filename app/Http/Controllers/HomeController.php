<?php
/**
 * Class BlogController
 *
 * @author Rafael
 */
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

/*
 * HomeController
 *
 * Home display for published blogs.
 */
class HomeController extends Controller
{
    /**
     * all user related queries
     *
     * @var \App\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\BlogRepository $blog
     */
    public function __construct(UserRepository $user)
    {
        $this->userRepository = $user;
        $this->auth           = Auth::user();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->search([])->paginate(5);

        return view('home', [
            'users' => $users,
            'user'  => $this->auth,
        ]);
    }
}
