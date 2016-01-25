@foreach ($tbl as $row)

    <tr>
        <td>{{ Str::title($row->control_id) }}</td>
        <td>{{ Str::title($row->problem_description) }}</td>
        <td>{{ Str::upper($row->station) }}</td>
        <td>{{ $row->customer }}</td>
        <td>
        {!!
            implode("<br>",array_flatten(
                                $row->involvePerson()
                                    ->select('receiver_name')
                                    ->get()
                                    ->toArray())
                                )
         !!}
         </td>
        <td>{{ Str::title($row->created_at) }}</td>
    </tr>

@endforeach