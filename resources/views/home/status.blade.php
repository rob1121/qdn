@foreach ($tbl as $row)

    <tr>
        <td>{{ Str::title($row->info->control_id) }}</td>
        <td>{{ Str::title($row->info->problem_description) }}</td>
        <td>{{ Str::upper($row->info->station) }}</td>
        <td>{{ $row->info->customer }}</td>
        <td>
        {!!
            implode("<br>",array_flatten(
                                $row->info->involvePerson()
                                    ->select('receiver_name')
                                    ->get()
                                    ->toArray())
                                )
         !!}
         </td>
        <td>{{ Str::title($row->info->created_at) }}</td>
    </tr>

@endforeach