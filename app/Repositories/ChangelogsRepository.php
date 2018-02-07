<?php
namespace App\Repositories;

use OzanAkman\RepositoryGenerator\Repository;
use App\Models\Changelogs;
use App\Repositories\Interfaces\ChangelogsRepositoryInterface;

class ChangelogsRepository extends Repository implements ChangelogsRepositoryInterface
{
    public function __construct(Changelogs $model)
    {
        parent::__construct($model);
    }
}