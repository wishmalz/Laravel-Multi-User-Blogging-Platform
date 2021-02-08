<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Blog;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();

        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::latest()->get();

        return view('blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
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

        $blog = Blog::create($input);
        if ($request->category_id) {
            $blog->category()->sync($request->category_id);
        }

        return redirect('/blogs');
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);

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
