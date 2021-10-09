<table class="table table-bordered table-hover mt-3">
    <thead class="thead-themed">
    <tr>
        <th style="width: 20%;">When</th>
        <th style="width: 30%;">Action By</th>
        <th style="width: 50%;">Action Description</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($histories as $k => $history)
{{--        @if($history->actionBy == null) {{ dd($history) }} @endif--}}
        <tr>
            <td>{{ $history->created_at->format('d-m-Y h:iA') }}</td>
            <td>{{ ucwords(strtolower($history->actionBy->fullname)) }}</td>
            <td>{{ $history->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
