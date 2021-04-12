<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository {

    public function __construct(Model $model) {
        $this->model = $model;
    }


    public function filter($filter) {
        $filter = explode(';', $filter);
        
        foreach($filter as $key => $condicao) {

            $c = explode(':', $condicao);
            $this->model = $this->model->where($c[0], $c[1], $c[2]);
            //a query está sendo montada
        
        }
    }

    public function selectAttributes($attribute) {
        $this->model = $this->model->selectRaw($attribute);
    }

    public function getResult() {
        return $this->model->get();
    }
}

?>