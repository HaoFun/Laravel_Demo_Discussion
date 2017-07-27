<?php
namespace App\Repositories;
use App\Discussions;

class DiscussionsRepository
{
    public function getDiscussionsLatest()
    {
        return Discussions::latest()->get(); //按資料庫內新增時間新到舊
    }

    public function getDiscussionsByID($id)
    {
        return Discussions::findOrFail($id);
    }

    public function create($data)
    {
        return Discussions::create($data);
    }
}
?>