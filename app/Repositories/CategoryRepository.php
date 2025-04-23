<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all()
    {
        return Category::paginate(5);
    }

    public function find($id)
    {  
        
        return Category::findOrFail($id);
    }

    public function create(array $data)
    {
        
        return Category::create($data);
    }

    public function update($id, array $data)
    {
        // dd($data);
        // dd($id);
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        return Category::destroy($id);
    }

}