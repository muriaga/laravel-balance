<?php

namespace CawaKharkov\LaravelBalance\Repositories;


use CawaKharkov\LaravelBalance\Interfaces\BalanceTransactionInterface;
use CawaKharkov\LaravelBalance\Interfaces\TransactionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BalanceTransactionRepository implements TransactionRepositoryInterface
{

    protected $model;

    /**
     * BalanceTransactionRepository constructor.
     * @param BalanceTransactionInterface $model
     */
    public function __construct(BalanceTransactionInterface $model)
    {
        $this->model = $model;
    }

    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    public function allAcceptedForUser($columns = array('*'))
    {
        return $this->model->where([
            'user_id' => Auth::user()->id,
            'accepted' => 1
        ])->get($columns);
    }

    public function allForUser($columns = array('*'))
    {
        return $this->model
            ->where('user_id',Auth::user()->id)
            ->get($columns);
    }

    /**
     * Create transaction
     * @param array $data
     */
    public function create(array $data)
    {
        //@todo implement some notification, calculation, etc.
    }
}