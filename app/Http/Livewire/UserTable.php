<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridEloquent;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;

final class UserTable extends PowerGridComponent
{
  use ActionButton;

  //Messages informing success/error data is updated.
  public bool $showUpdateMessages = true;
    
  public string $primaryKey = 'users.id';
  public string $sortField  = 'users.name';
  
  /**
   * El método setup() controla las características generales presentes
   * en su tabla
   */
  public function setUp(): void
  {
    $this->showCheckBox()
      ->showPerPage()
      ->showSearchInput()
      ->showExportOption('download', ['excel', 'csv'])
      ->showRecordCount('full')
      ->showToggleColumns();
  }

  /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */
  public function datasource(): ?Builder
  {
    return User::query()
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->select('users.*', 'roles.name as role_name');
  }

  /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

  /**
   * Relationship search.
   *
   * @return array<string, array<int, string>>
   */
  public function relationSearch(): array
  {
    return [
      'role' => ['name']
    ];
  }

  /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    */
  public function addColumns(): ?PowerGridEloquent
  {
    return PowerGrid::eloquent()
      ->addColumn('id')
      ->addColumn('name')
      ->addColumn('email')
      ->addColumn('gender', function (User $model) {
        return ($model::GENDER_SELECT[$model->gender] ?? '');
      })
      ->addColumn('phone')
      // ->addColumn('role')
      /*** ROLE ***/
      ->addColumn('role_id', function (User $model) {
          return $model->role_id;
      })
      ->addColumn('role_name', function (User $model) {
          return $model->role->name;
      })
      ->addColumn('created_at_formatted', function (User $model) {
        return Carbon::parse($model->created_at)->format('d/m/Y H:i:s');
      })
      ->addColumn('updated_at_formatted', function (User $model) {
        return Carbon::parse($model->updated_at)->format('d/m/Y');
      });
  }

  /**
   * Incluir las columnas agregadas, haciéndolas visibles en la Tabla.
   * Cada columna se puede configurar con propiedades, filtros, acciones ...
   * PowerGrid Columns.
   *
   * @return array<int, Column>
   */
  public function columns(): array
  {
    return [
      Column::add()
        ->title('ID')
        ->field('id')
        ->sortable()
        ->headerAttribute('text-center'),

      Column::add()
        ->title(__('Name'))
        ->field('name')
        ->sortable()
        ->searchable()
        ->headerAttribute('text-center'),

      Column::add()
        ->title(__('Email'))
        ->field('email')
        ->sortable()
        ->searchable()
        ->headerAttribute('text-center'),

      Column::add()
        ->title(__('Gender'))
        ->field('gender')
        ->sortable()
        ->searchable()
        ->headerAttribute('text-center'),

      Column::add()
        ->title(__('Phone'))
        ->field('phone')
        ->sortable()
        ->searchable()
        ->headerAttribute('text-center'),

      Column::add()
        ->title(__('Role'))
        ->field('role_name', 'roles.name')
        ->placeholder('Role placeholder')
        ->makeInputSelect(Role::all(), 'name', 'role_id', ['live-search' => true])
        ->sortable()
        ->headerAttribute('text-center'),

      Column::add()
        ->title(__('Created'))
        ->field('created_at_formatted', 'created_at')
        ->searchable()
        ->sortable()
        ->headerAttribute('text-center')
        ->bodyAttribute('text-center'),

      Column::add()
        ->title(__('Updated'))
        ->field('updated_at_formatted', 'updated_at')
        ->searchable()
        ->sortable()
        ->headerAttribute('text-center')
        ->bodyAttribute('text-center'),
        // ->makeInputDatePicker('updated_at'),
    ];
  }

  /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable this section only when you have defined routes for these actions.
    |
    */

  /**
   * PowerGrid User action buttons.
   *
   * @return array<int, \PowerComponents\LivewirePowerGrid\Button>
   */

  /*
    public function actions(): array
    {
       return [
           Button::add('edit')
               ->caption('Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('user.edit', ['user' => 'id']),

           Button::add('destroy')
               ->caption('Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('user.destroy', ['user' => 'id'])
               ->method('delete')
        ];
    }
    */

  /*
    |--------------------------------------------------------------------------
    | Edit Method
    |--------------------------------------------------------------------------
    | Enable this section to use editOnClick() or toggleable() methods.
    | Data must be validated and treated (see "Update Data" in PowerGrid doc).
    |
    */

  /**
   * PowerGrid User Update.
   *
   * @param array<string,string> $data
   */

  /*
    public function update(array $data ): bool
    {
       try {
           $updated = User::query()->findOrFail($data['id'])
                ->update([
                    $data['field'] => $data['value'],
                ]);
       } catch (QueryException $exception) {
           $updated = false;
       }
       return $updated;
    }

    public function updateMessages(string $status = 'error', string $field = '_default_message'): string
    {
        $updateMessages = [
            'success'   => [
                '_default_message' => __('Data has been updated successfully!'),
                //'custom_field'   => __('Custom Field updated successfully!'),
            ],
            'error' => [
                '_default_message' => __('Error updating the data.'),
                //'custom_field'   => __('Error updating custom field.'),
            ]
        ];

        $message = ($updateMessages[$status][$field] ?? $updateMessages[$status]['_default_message']);

        return (is_string($message)) ? $message : 'Error!';
    }
    */
}