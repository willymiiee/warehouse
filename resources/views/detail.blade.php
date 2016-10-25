@extends('layouts.new')

@section('title')
    Request Detail
@endsection

@section('content')
<div class="col-md-12">
    <div class="row">
        <form class="form-horizontal" role="form" id="detailForm">

            <div class="form-group">
                <label class="col-sm-2 control-label">User</label>
                <div class="col-sm-10">
                    <span class="form-control" id="user"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Item</label>
                <div class="col-sm-10">
                    <span class="form-control" id="item"></span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <label class="col-sm-10" id="status"></span>
            </div>

            <div class="form-group" id="buttons">
                <div class="col-sm-offset-2 col-sm-10">
                    <a class="btn btn-primary" OnClick="submit('approve')">Approve</a>
                    <a class="btn btn-danger" OnClick="submit('rejected')">Reject</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $.get("{{ url('/api/requests/'.$id) }}")
        .done(function(result) {
            $('#user').html(result.user.name);
            $('#item').html(result.item.name);
            $('#status').html(result.status);
            
            if (result.status !== "pending") {
                $('#buttons').hide();
            }
        });

    function submit(type) {
        $.ajax({
            url : "{{ url('/api/requests/'.$id) }}",
            data : { status: type },
            type : 'PATCH',
            success: function(result) {
                swal("Sukses!", result.message, "success")                
                var delay = 1000; //Your delay in milliseconds
                setTimeout(function(){ window.location = "{{ url('') }}" }, delay);
            }
        });      
    }
</script>

<script src="{{ url('js/forms.js') }}"></script>
@endsection
