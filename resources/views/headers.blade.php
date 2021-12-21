<thead class="bg-gray-50 text-center text-sm font-bold">
  <tr>
    @foreach($headers as $key => $header)
      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        @if(! $header['sortable'])
          {{ $header['title'] }}
        @else
          @if(request('sort') == $key)
            {{ $header['title'] }}
            @if(request('direction') == 'asc')
              <span>
                <a href="?sort={{ $key }}&direction=desc">
                  &#x25B2
                </a>
              </span>
            @else
              <span>
                <a href="?sort={{ $key }}&direction=asc">
                  &#x25BC
                </a>
              </span>
            @endif
          @else
            <a href="?sort={{ $key }}&direction=asc">
              {{ $header['title'] }}
            </a>
          @endif
        @endif
      </th>
    @endforeach
  </tr>
</thead>