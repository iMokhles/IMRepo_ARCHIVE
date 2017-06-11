<?php
namespace App\Repositories;

use OzanAkman\RepositoryGenerator\Repository;
use App\Models\Activities;
use App\Repositories\Interfaces\ActivitiesRepositoryInterface;

class ActivitiesRepository extends Repository implements ActivitiesRepositoryInterface
{
    public function __construct(Activities $model)
    {
        parent::__construct($model);
    }
}