<?php
namespace App\Repositories;

use OzanAkman\RepositoryGenerator\Repository;
use App\Models\Screenshots;
use App\Repositories\Interfaces\ScreenshotsRepositoryInterface;

class ScreenshotsRepository extends Repository implements ScreenshotsRepositoryInterface
{
    public function __construct(Screenshots $model)
    {
        parent::__construct($model);
    }
}