<?php
switch (Request::input('status')) {
case 'p.e. verification':
	$link = 'qdn_link';
	break;
case 'incomplete fill-up':
	$link = 'ForIncompleteFillUp';
	break;
case 'incomplete approval':
	$link = 'approval';
	break;
case 'q.a. verification':
	$link = 'qa_verification';
	break;

default:
	# code...
	break;
}
?>
@foreach ($tbl as $row)

    <tr>
        <td>
        @if (Gate::allows('mod-qdn', $row->info->slug))
            <a href="{{ route($link, ['slug' => $row->info->slug]) }}">
                {{ Str::title($row->info->control_id) }}
            </a>
            @else
                {{ Str::title($row->info->control_id) }} <em>(is active at the moment)</em>
        @endif
        </td>
        <td>{{ Str::title($row->info->problem_description) }}</td>
        <td>{{ Str::upper($row->info->station) }}</td>
        <td>{{ Str::upper($row->info->customer) }}</td>
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
        <td>{{ Carbon::parse($row->info->created_at)->diffForHumans() }}</td>
    </tr>

@endforeach