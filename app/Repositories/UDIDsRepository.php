<?php
namespace App\Repositories;

use OzanAkman\RepositoryGenerator\Repository;
use App\Models\UDIDs;
use App\Repositories\Interfaces\UDIDsRepositoryInterface;

class UDIDsRepository extends Repository implements UDIDsRepositoryInterface
{
    public function __construct(UDIDs $model)
    {
        parent::__construct($model);
    }
}