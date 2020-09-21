<?php

namespace App\Model;

use Core\Model\Model as Model;

class Product extends Model{
    protected $fields = [ 'code', 'name', 'value', 'description'];

}