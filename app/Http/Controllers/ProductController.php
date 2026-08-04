<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Product::query();

        if ($request->filled('search')) {
            # code...
            $searchItem = $request->input('search');
            $query->where('name', 'like', "%{$searchItem}%");
        }
        if ($request->filled('category')) {
            # code...
            $categorySlug = $request->input('category');
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }
        if ($request->filled('tags')) {
            # code...
            $tagSlug = $request->input('tags');
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
        }
        $products = $query->with('category', 'tags')->paginate(15)->withQueryString();
        return Inertia::render('products', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all('id', 'name');
        $tag = Tag::all('id', 'name');
        return Inertia::render('dashboard/product/AddProduct', [
            'category' => $category,
            'tag' => $tag
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
        ]);
        $slug = Str::slug($request->name) . '-' . Str::random(10);

        $product = Product::create([
            'name' =>$validated['name'],
            'description' => $validated['description'] ,
            'price' => $validated['price'],
            'stock' =>$validated['stock'],
            'category_id' => $validated['category_id'],
            'slug' => $slug
        ]);
        $product->tags()->sync($validated['tags'] ?? []);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $images) {
                # code...
                $image_path = $images->store('products', 'public');

                $product->productImages()->create([
                    'image_path' => $image_path
                ]);
            }
        }
        return redirect('dashboard')->with('success', 'added product successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
        $products = $product->load('category', 'tags', 'productImages');


        return Inertia::render('ProductDetails', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $products = $product;
        $category = Category::all('id', 'name');
        $tags = Tag::all('id', 'name');
        return Inertia::render('dashboard/product/EditProduct', [
            'products' => $products,
            'tags' => $tags,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //

        $validated=$request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slug = $product->name === $request->name ? $product->slug : Str::slug($request->name) . '-' . Str::random(10);

        $product->update([
            'name' =>$validated['name'],
            'description' => $validated['description'] ,
            'price' => $validated['price'],
            'stock' =>$validated['stock'],
            'category_id' => $validated['category_id'],
            'slug' => $slug
        ]);
        if ($request->filled('tags')) {
            $product->tags()->sync($request->tags);
        };
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $images) {
                # code...
                $image_path = $images->store('products', 'public');

                $product->productImages()->create([
                    'image_path' => $image_path
                ]);
            }
        }
        return redirect('dashboard')->with('success', 'updated product successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        foreach ($product->productImages as $image) {
            # code...
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        }
        $product->tags()->detach();
        $product->delete();

        return redirect('Dashboard')->with('success', 'deleted product successfully');
    }
}
