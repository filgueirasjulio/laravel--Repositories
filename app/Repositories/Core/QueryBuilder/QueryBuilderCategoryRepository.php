<?php

namespace App\Repositories\Core\QueryBuilder;

use App\Repositories\Core\BaseQueryBuilderRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use DB;

class QueryBuilderCategoryRepository extends BaseQueryBuilderRepository implements CategoryRepositoryInterface
{
  protected $table = 'categories';

  public function search(array $data)
  {
                return DB::table('categories')
                          ->where(function ($query) use ($data) {
                              if (isset($data['title'])) {
                                  $query->where('title', $data['title']);
                              }
                              if (isset($data['url'])) {
                                  $query->where('url', $data['url']);
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