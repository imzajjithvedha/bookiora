@if(count($items) > 0)
    @foreach($items as $item)
        <tr>
            <td>{!! $item->thumbnail !!}</td>
            <td>{{ $item->custom_name }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->type }}</td>
            <td>{{ $item->number_of_guests }}</td>
            <td>{{ $item->charge_per_night }}</td>
            <td>{!! $item->status !!}</td>
            <td>{!! $item->action !!}</td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" style="text-align: center;">No data available in the table</td>
    </tr>
@endif