<?php

namespace App\Traits;

trait Search
{
  /**
   * Limpiar el término de búsqueda
   */
  private function buildWildCards($term)
  {
    if ($term == "") {
      return $term;
    }

    // Eliminar símbolos reservados de MySQL
    $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
    $term = str_replace($reservedSymbols, '', $term);
    $words = explode(' ', $term);

    foreach ($words as $idx => $word) {
      // Agregar caracteres comodín de MySQL ( +y *) al término 
      // de búsqueda. Esto le ayuda a aprovechar el modo booleano
      // de MySQL
      $words[$idx] = "+" . $word . "*";
    }

    $term = implode(' ', $words);

    return $term;
  }

  protected function scopeSearch($query, $term)
  {
    $columns = implode(',', $this->searchable);

    // El modo booleano nos permite hacer coincidir john * 
    // para palabras que comienzan con john
    // (https://dev.mysql.com/doc/refman/5.6/en/fulltext-boolean.html)
    $query->whereRaw(
      "MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)",
      $this->buildWildCards($term)
    );

    return $query;
  }
}
