<?php
namespace App\Repositories;

use OzanAkman\RepositoryGenerator\Repository;
use App\Models\Payments;
use App\Repositories\Interfaces\PaymentsRepositoryInterface;

class PaymentsRepository extends Repository implements PaymentsRepositoryInterface
{
    public function __construct(Payments $model)
    {
        parent::__construct($model);
    }
}