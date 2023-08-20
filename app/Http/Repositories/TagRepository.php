<?php
namespace App\Http\Repositories;

use App\Tag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class TagRepository extends BaseRepository
{
    function __construct(Tag $model)
    {
        $this->model = $model;
    }
    public function saveNewlyCreatedTags($array)
    {
        $collect_tag = [];
        foreach($array as $tag){
            $collect_tag[] = [
                'name' => $tag,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        $data = $collect_tag;
        Tag::insert($data);
    }
}
