@forelse($tickets as $ticket)
<tr role="row">
    <td>{{ $ticket->ticket }}</td>
    <td>{{ ($ticket->user_id) ? $ticket->user->name : '-' }}</td>
    <td>{{ ($ticket->created_at) ? \Carbon\Carbon::parse($ticket->created_at)->format('Y/m/d') : '--/--/--' }}</td>
    <td>
        @php
            $status = $ticket->status;
        @endphp
        @include('admin.status')
    </td>
    <td>@include('admin.companies')</td>
    <td>{{ $ticket->priority }}</td>
    <td>{{ \Carbon\Carbon::parse($ticket->duedate)->format('Y/m/d') }}</td>
    <td>{{ $ticket->newprojecttitle }}</td>
    <td>
        @if($ticket->orderfiles1)
        <a href="{{ my_asset('tickets/'.$ticket->orderfiles1) }}" target="_blank" style="text-decoration: underline; margin-right: 5px;">
            Attach-I
        </a>
        @else
        -
        @endif
        @if($ticket->orderfiles2)
        <a href="{{ my_asset('tickets/'.$ticket->orderfiles2) }}" target="_blank" style="text-decoration: underline; margin-right: 5px;">
            Attach-II
        </a>
        @else
        -
        @endif
        @if($ticket->orderfiles3)
        <a href="{{ my_asset('tickets/'.$ticket->orderfiles3) }}" target="_blank" style="text-decoration: underline;">
            Attach-III
        </a>
        @else
        -
        @endif
    </td>
    <td>
        <a href="{{ route('ticket.show',$ticket->id) }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
    </a>
    @if(Auth::user()->as_admin == 1)
    <a href="{{ route('ticket.edit',$ticket->id) }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 edit" style="cursor: pointer;"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
</a>
<svg data-toggle="modal" data-target="#exampleModal" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-toggle="tooltip" data-placement="top" data-original-title="Delete" class="feather feather-trash-2" style="cursor: pointer;" onclick="deleteTicket('{{ $ticket->id }}')"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
@endif
</td>
</tr>
@empty
    <tr role="row">
        <td colspan="10">
            No record found.
        </td>
    </tr>
@endforelse