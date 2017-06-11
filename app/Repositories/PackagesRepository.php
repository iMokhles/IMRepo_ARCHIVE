<?php
namespace App\Repositories;

use OzanAkman\RepositoryGenerator\Repository;
use App\Models\Packages;
use App\Repositories\Interfaces\PackagesRepositoryInterface;

class PackagesRepository extends Repository implements PackagesRepositoryInterface
{
    public function __construct(Packages $model)
    {
        parent::__construct($model);
    }
}