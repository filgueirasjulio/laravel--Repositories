<?php

namespace App\Repositories\Core\Eloquent;

use App\Models\Category;
use App\Repositories\Core\BaseEloquentRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class EloquentCategoryRepository extends BaseEloquentRepository implements CategoryRepositoryInterface
{
    public function entity()
    {
        return Category::class;
    }

    public function search(array $data)
    {
          return  $this->entity
                        ->where(function ($query) use ($data) {
                            if (isset($data['title'])) {
                                $title = $data['title'];
                                $query->where('title',  'LIKE', "%{$title}%");
                            }

                            if (isset($data['url'])) {
                                $url = $data['url'];
                                $query->where('url',  'LIKE', "%{$url}%");
                            }

                            if (isset($data['description'])) {
                                $desc = $data['description'];
                                $query->where('description', 'LIKE', "%{$desc}%");
                            }
                        })
                        ->orderBy('id', 'desc')
                        ->paginate();
    }
}