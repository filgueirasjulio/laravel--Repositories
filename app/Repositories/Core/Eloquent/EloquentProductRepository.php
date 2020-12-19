<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Product;
use App\Repositories\Core\BaseEloquentRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;

class EloquentProductRepository extends BaseEloquentRepository implements ProductRepositoryInterface
{
    public function entity()
    {
        return Product::class;
    }

    
    public function search(array $data)
    {
          return  $this->entity
                    ->with('category')
                    ->where(function ($query) use ($data) {
                        if (isset($data['name'])) {
                            $filter = $data['name'];
                            $query->where('name', 'LIKE', "%{$filter}%");   
                        }

                        if (isset($data['url'])) {
                            $filter = $data['url'];
                            $query->where('url', 'LIKE', "%{$filter}%");   
                        }

                        if (isset($data['description'])) {
                            $filter = $data['description'];
                            $query->where('description', 'LIKE', "%{$filter}%");   
                        }

                        if (isset($data['price'])) {
                            $query->where('price', ($data['price']));
                        }

                        if (isset($data['category'])) {
                            $query->where('category_id', $data['category']);
                        }
                    })
                    ->paginate();
    }
}