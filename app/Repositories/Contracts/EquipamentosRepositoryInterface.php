<?php

namespace App\Repositories\Contracts;

interface EquipamentosRepositoryInterface
{

    public function  getAll();
    public function  getById($id);
    public function  create(array $atributes);
    public function  update($id, array $atributes);
    public function  delete($id);
    public function  getWithStatus($id);
    public function  getStatus();
    public function  getIdentifyEquipamentos();
    
}