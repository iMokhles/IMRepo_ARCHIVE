<?php
namespace App\Repositories;

use OzanAkman\RepositoryGenerator\Repository;
use App\Models\Comments;
use App\Repositories\Interfaces\CommentsRepositoryInterface;

class CommentsRepository extends Repository implements CommentsRepositoryInterface
{
    public function __construct(Comments $model)
    {
        parent::__construct($model);
    }
}