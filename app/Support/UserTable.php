<?php

namespace App\Support;

use App\Support\Table;

class UserTable extends Table
{
  protected $headers = [
    'id' => [
      'sortable' => true,
      'title' => 'ID'
    ],
    'name' => [
      'sortable' => true,
      'title' => 'Name'
    ],
    'email' => [
      'sortable' => true,
      'title' => 'Email'
    ],
    'role_id' => [
      'sortable' => true,
      'title' => 'Role'
    ],
    'posts.title' => [
      'sortable' => false,
      'title' => 'Post'
    ],
    'phone' => [
      'sortable' => true,
      'title' => 'Teléfono'
    ],
    'options' => [
      'sortable' => false,
      'title' => 'Acciones'
    ],
  ];
}