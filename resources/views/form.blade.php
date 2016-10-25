@extends('layouts.new')

@section('css')
<link href="vendors/select/bootstrap-select.min.css" rel="stylesheet">
<link href="css/forms.css" rel="stylesheet">
@endsection

@section('title')
    Form Request
@endsection

@section('content')
<div>
    <form id="requestForm">        
        <h4>Pilih barang</h4>
        <p>
            <select id="selectItem" class="selectpicker" required>
                <option disabled selected>Pilih salah satu barang</option>
            </select>
        </p>

        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
@endsection

@section('javascript')
<script>
    $.get("{{ url('/api/items').'?page=all' }}", function(result) {
        for (var key in result.items) {
            var option = new Option(result.items[key].name, result.items[key].id);
            $('#selectItem').append($(option));
        }
        $('#selectItem').selectpicker('refresh');
    });

    $('#requestForm').submit(function(e) {
        e.preventDefault();
        var selected = $('#selectItem').val();

        if (selected === null) {
            sweetAlert("Oops...", "Pilih barang terlebih dahulu!", "error");
        } else {
            $.post("{{ url('/api/requests') }}", { user_id: {{ Auth::user()->id }}, item_id: selected })
                .done(function(data) {
                    swal("Sukses!", data.message, "success")
                    var delay = 1000; //Your delay in milliseconds
                    setTimeout(function(){ window.location = "{{ url('') }}" }, delay);
                });
        }
    });
</script>

<script src="vendors/select/bootstrap-select.min.js"></script>
<script src="js/forms.js"></script>
@endsection