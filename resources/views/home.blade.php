@extends('layouts.new')

@section('css')
<link href="{{ url('css/forms.css') }}" rel="stylesheet">
@endsection

@section('title')
    Request List
@endsection

@section('content')
<h5>Pending Requests</h5>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Item</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="pendingRequest">
        </tbody>
    </table>
</div>

<h5>Approved Requests</h5>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Item</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="approvedRequest">
        </tbody>
    </table>
</div>

<h5>Rejected Requests</h5>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Item</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="rejectedRequest">
        </tbody>
    </table>
</div>
@endsection

@section('javascript')
<script>
    var items = [];
    var itemIds = [];
    var users = [];
    var userIds = [];

    $.get("{{ url('/api/items').'?page=all' }}")
        .done(function(result) {
            for (var key in result.items) {
                itemIds.push(result.items[key].id);
            }

            items = result.items;
        });

    $.get("{{ url('/api/users') }}")
        .done(function(result) {
            for (var key in result.items) {
                userIds.push(result.items[key].id);
            }

            users = result.items;
        });
    
    $.get("{{ url('/api/requests').'?page=all' }}")
        .done(function(result) {
            for (var key in result.items) {
                var item = items[itemIds.indexOf(result.items[key].item_id)];
                var user = users[userIds.indexOf(result.items[key].user_id)];

                $('#pendingRequest').append(
                    '<tr>'+
                        '<td>'+user.name+'</td>'+
                        '<td>'+item.name+'</td>'+
                        '<td>'+result.items[key].status+'</td>'+
                        '<td><a class="btn btn-success" href="{{ url("/requests") }}/'+result.items[key].id+'">Detail</a></td>'+
                    '</tr>');
            }
        });

    $.get("{{ url('/api/requests').'?status=approved&page=all' }}")
        .done(function(result) {
            for (var key in result.items) {
                var item = items[itemIds.indexOf(result.items[key].item_id)];
                var user = users[userIds.indexOf(result.items[key].user_id)];

                $('#approvedRequest').append(
                    '<tr>'+
                        '<td>'+user.name+'</td>'+
                        '<td>'+item.name+'</td>'+
                        '<td>'+result.items[key].status+'</td>'+
                        '<td><a class="btn btn-success" href="{{ url("/requests") }}/'+result.items[key].id+'">Detail</a></td>'+
                    '</tr>');
            }
        });

    $.get("{{ url('/api/requests').'?status=rejected&page=all' }}")
        .done(function(result) {
            for (var key in result.items) {
                var item = items[itemIds.indexOf(result.items[key].item_id)];
                var user = users[userIds.indexOf(result.items[key].user_id)];

                $('#rejectedRequest').append(
                    '<tr>'+
                        '<td>'+user.name+'</td>'+
                        '<td>'+item.name+'</td>'+
                        '<td>'+result.items[key].status+'</td>'+
                        '<td><a class="btn btn-success" href="{{ url("/requests") }}/'+result.items[key].id+'">Detail</a></td>'+
                    '</tr>');
            }
        });
</script>
@endsection