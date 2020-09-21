<?php

namespace App\Model;

use Core\Model\Model as Model;

class Sale extends Model{
    protected $fields = [ 'id_client', 'code', 'product_name', 'value', 'quantity', 'date_sale'];

}