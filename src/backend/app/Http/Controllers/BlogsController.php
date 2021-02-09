<?php

namespace App\Http\Controllers;

use App\Category;
use App\Mail\BlogPublished;
use App\User;
use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class BlogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('author', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('admin', ['only' => ['delete', 'trash', 'restore', 'permanentDelete']]);
    }

    public function index()
    {
        $blogs = Blog::where('status', 1)->latest()->paginate(2);

        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::latest()->get();

        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        //validate
        $rules = [
            'title' => ['required', 'min:20', 'max:150'],
            'body' => ['required', 'min:120'],
        ];
        $this->validate($request, $rules);

        $input = $request->all();
        // meta
        $input['slug'] = str_slug($request->title);
        $input['meta_title'] = str_limit($request->title, 55, '...');
        $input['meta_description'] = str_limit($request->body, 155, '...');
        // img upload
        if ($file = $request->file('featured_img')) {
            $filename = uniqid('img', true). $file->getClientOriginalName();
            $file->move('images/featured_imgs/', $filename);
            $input['featured_img'] = $filename;
        }

        $blog = $request->user()->blogs()->create($input);
        if ($request->category_id) {
            $blog->category()->sync($request->category_id);
        }

        //mail
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->queue(new BlogPublished($blog, $user));
        }

        Session::flash('blog_created_msg', 'Blog has been created!');

        return redirect('/blogs');
    }

    public function show($slug)
    {
        $blog = Blog::whereSlug($slug)->first();

        return view('blogs.show', compact('blog'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Category::latest()->get();
        $filteredCategories = [];
        foreach ($blog->category as $category) {
            $filteredCategories[] = $category->id;
        }
        $filtered = array_except($categories, $filteredCategories);

        return view('blogs.edit', compact('blog', 'categories', 'filtered'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $blog = Blog::findOrFail($id);
        $blog->update($input);
        if ($request->category_id) {
            $blog->category()->sync($request->category_id);
        }

        return redirect('blogs');
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect('blogs');
    }

    public function trash()
    {
        $trashedBlogs = Blog::onlyTrashed()->get();

        return view('blogs.trash', compact('trashedBlogs'));
    }

    public function restore($id)
    {
        $trashedBlog = Blog::onlyTrashed()->findOrFail($id);
        $trashedBlog->restore($trashedBlog);

        return redirect('blogs');
    }

    public function permanentDelete($id)
    {
        $permanentDeleteBlog = Blog::onlyTrashed()->findOrFail($id);
        $permanentDeleteBlog->forceDelete($permanentDeleteBlog);

        return back();
    }
}
