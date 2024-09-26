<?php

namespace App\Repositories\Contracts;

interface DevolucaoRepositoryInterface
{

    public function  getAll();
    public function  getById($id);
    public function  create(array $atributes);
    public function  delete($id);
    public function  getTodos();
}