<div>
  <!-- 
      Searchable trait to search in multiple columns with Laravel
      https://echebaby.com/blog/2021-02-13-searchable-trait-to-search-in-multiple-columns-with-laravel/
  -->
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <div class="flex items-center justify-center text-sm text-gray-500 bg-white px-4 py-6 gap-x-2 border-t border-gray-200 sm:px-6">
            <!-- Buscar -->
            <div class="flex-1 pr-4">
              <div class="relative md:w-2/3">
                <input type="search"
                  class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                  placeholder="Buscar..." wire:model.debounce.300ms="searchTerm">
                <div class="absolute top-0 left-0 inline-flex items-center p-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                    <circle cx="10" cy="10" r="7" />
                    <line x1="21" y1="21" x2="15" y2="15" />
                  </svg>
                </div>
              </div>
              <div wire:loading.delay class="col-12 alert alert-info">
                {{ __('Loading...') }}
              </div>
            </div>
          </div>

          <table class="sortable min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 text-center text-sm font-bold">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">
                  Id
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ __('Name') }}
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  {{ __('Email') }}
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider">
                  {{ __('Role') }}
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider">
                  {{ __('Post') }}
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs text-gray-500 uppercase tracking-wider">
                  {{ __('Phone') }}
                </th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Editar</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm">
              @foreach ($users as $item)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $item->id }}</td>
                  <td class="px-6 py-4">{{ $item->name }}</td>
                  <td class="px-6 py-4">{{ $item->email }}</td>
                  <td class="px-6 py-4">{{ $item->role->name }}</td>
                  <td class="px-6 py-4">
                    @foreach($item->posts as $key => $entry)
                      {{ $entry->title }}
                    @endforeach
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $item->phone }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">
                      <i class="fas fa-edit"></i>
                    </a>
                    
                    @if ($item->posts->count() === 0)
                      <a href="#" class="text-red-600 hover:text-red-900" wire:loading.attr="disabled" title="Eliminar">
                        <i class="fas fa-trash mr-2"></i>
                      </a>
                    @endif
                
                    {{-- @if ($item->posts->count() === 0)
                      <a href="javascript:void(0)" class="text-red-600 hover:text-red-900" wire:click="confirm('delete', {{ $item->id }})" wire:loading.attr="disabled" title="Eliminar">
                        <i class="fas fa-trash mr-2"></i>
                      </a>
                    @endif --}}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
  <div class="px-4 mt-4">
    {{ $users->links() }}
  </div>
</div>

@push('scripts')
    
  <script type="text/javascript" src="js/sortable.js"></script>
@endpush