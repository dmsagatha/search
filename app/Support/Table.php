<?php

namespace App\Support;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\HtmlString;

class Table extends LengthAwarePaginator
{
  public function __construct($paginator)
  {
    $this->total       = $paginator->total;
    $this->perPage     = $paginator->perPage;
    $this->lastPage    = $paginator->lastPage;
    $this->path        = $paginator->path;
    $this->currentPage = $paginator->currentPage;
    $this->items       = $paginator->items;
  }

  public function headers($viewPath = 'headers')
  {
    return new HtmlString(view($viewPath, [
      'headers' => $this->headers
    ])->render());
  }
}