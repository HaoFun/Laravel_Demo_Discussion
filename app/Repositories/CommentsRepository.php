<?php
namespace App\Repositories;
use App\Comments;
use App\Discussions;

class CommentsRepository
{
    public function create($data)
    {
        return Comments::create($data);
    }
}
?>