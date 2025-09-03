@if(count($items) > 0)
    @foreach($items as $item)
        <tr>
            <td>{!! $item->thumbnail !!}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->address }}</td>
            <td>{{ $item->city }}</td>
            <td>{{ $item->post_code }}</td>
            <td>{{ $item->country }}</td>
            <td>{!! $item->status !!}</td>
            <td>{!! $item->action !!}</td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" style="text-align: center;">No data available in the table</td>
    </tr>
@endif