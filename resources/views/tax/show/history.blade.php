<table class="table table-responsive-sm table-sm mt-3">
    <thead>
    <tr>
        <th style="width: 20%;">When</th>
        <th style="width: 30%;">Action By</th>
        <th style="width: 50%;">Action Description</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($histories as $k => $history)
        <tr>
            <td>{{ $history->created_at->format('d-m-Y h:iA') }}</td>
            <td>{{ ucwords(strtolower($history->actionBy->fullname)) }}</td>
            <td>{{ $history->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
