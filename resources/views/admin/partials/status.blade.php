@php
    switch ($status)
    {
        case 2:
        echo '<span class="badge badge-danger">Rejected</span>';
        break;
        case 1:
        echo '<span class="badge badge-info">Pending</span>';
        break;
        case 3:
        echo '<span class="badge badge-success">Approved</span>';
        break;
    }
    
@endphp