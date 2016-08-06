<?php
/**
 * Class BlogController
 *
 * @author Rafael
 */
namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Http\Request;
use App\Repositories\BlogRepository;

/*
 * BlogController
 *
 * This controller process the creation,
 * modification and deletion of blog post.
 */
class BlogController extends Controller
{
    /**
     * all user related queries
     *
     * @var \App\Repositories\BlogRepository
     */
    protected $blogRepository;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\BlogRepository $blog
     */
    public function __construct(BlogRepository $blog)
    {
        $this->blogRepository = $blog;
    }

    /**
     * This display the list of posted and saved blogs.
     *
     * @param \Illuminate\Http\Request $request
     * @return View
     */
    public function index(Request $request)
    {
        // get all blogs
        $blogs = $this->blogRepository->search($request->all())->paginate(5);

        // return composed data
        return response()->view('admin.blog.index', [
            'blogs' => $blogs,
        ]);
    }

    /**
     * Blog creation page
     *
     * This renders the blog creation page
     *
     * @return Response
     */
    public function create()
    {
        // call create form view
        return response()->view('admin.blog.create');
    }

    /**
     * Blog creation page
     *
     * This store a newly created resource in storage
     * once the validation passed.
     *
     * @param \App\Http\Requests\StoreBlogRequest $request
     * @return Response
     */
    public function store(StoreBlogRequest $request)
    {
        try {
            $this->blogRepository->create($request->all());

            // success message
            $request->session()->flash('success', 'Record has been created!');
        } catch (ValidationException $e) {
            // error message
            $request->session()->flash('error', 'Unable to create the record');
        }

        // redirect to the blog list
        return redirect()->route('admin.blog.index');
    }

    /**
     * This show the form for editing the specified blog.
     *
     * @param integer $id
     * @param \App\Http\Requests\StoreBlogRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function edit($id, Request $request)
    {
        // get the record
        $blog = $this->blogRepository->search([
            'id' => $id,
        ])->first();

        // return composed data
        return response()->view('admin.blog.edit', [
            'blog' => $blog,
        ]);
    }

    /**
     * This update the specified blog.
     *
     * @param integer $id
     * @param \App\Http\Requests\UpdateBlogRequest $request
     * @return Response
     */
    public function update($id, UpdateBlogRequest $request)
    {
        try {
            // save the record
            $this->blogRepository->update($id, [
                'title'  => $request->get('title'),
                'body'   => $request->get('body'),
                'action' => $request->get('action')
            ]);

            // success message
            $request->session()->flash('success', 'Record has been updated!');
        } catch (\Exception $e) {
            // error message
            $request->session()->flash('error', 'Unable to update the record');
        }

        // redirect to the blog list page
        return redirect()->route('admin.blog.index');
    }

    /**
     * This remove the specified blog.
     *
     * @param integer $id
     * @param \App\Http\Requests\UpdateBlogRequest $request
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        try {
            $this->blogRepository->deleteRecord($id);

            // success message
            $request->session()->flash('success', 'Record has been updated!');
        } catch (\Exception $e) {
            // error message
            $request->session()->flash('error', 'Unable to update the record');
        }

        // redirect to the blog list page
        return redirect()->route('admin.blog.index');
    }
}
