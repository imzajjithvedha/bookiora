@if(count($items) > 0)
    @foreach($items as $item)
        <tr>
            <td>{{ $item->name ?? '-' }}</td>
            <td>{{ $item->email }}</td>
            <td>{!! $item->action !!}</td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="3" class="text-center">No data available in the table</td>
    </tr>
@endif