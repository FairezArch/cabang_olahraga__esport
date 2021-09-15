@extends('master')
@section('title', '- Forms')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Edit Form</h2>
        <form id="myForm">
            <div class="form-group">
                <label for="name">Header Title</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $form->header_title }}" placeholder="Nama Form" autofocus />
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="branch">Cabang</label>
                <select name="branch" id="branch" class="form-control">
                    @foreach($branchs as $branch)
                    <option value="{{$branch->id}}" {{($branch->id == $form->branch_id) ? 'selected="selected"' : ''}}>{{$branch->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-100 text-right">
                <div class="plus btn btn-primary" id="plus">
                    Tambah list pertanyaan
                </div>
            </div>
            <div class="form-group mt-3 mb-3" id="wrapper-question">
                @php($num = 1)
                @foreach (json_decode($form->question_n_answer) as $area)
                <div class="rounded shadow-lg p-2 list-question" id="list-question">
                    <div class="question-wrap col-sm-12 mt-2 mb-2" id="question-wrap_{{$num}}">
                        <div class="row">
                            <label for="question" class="col-sm-11">
                                <h5 class="text-dark">Pertanyaan <span class="text-danger">*</span></h5>
                            </label>
                            @if($num > 1)
                            <span class="text-danger" id="removeRow">Remove</span>
                            @endif
                        </div>
                        <input type="text" value="{{$area->A_Pertanyaan}}" class="form-control mb-1 question" name="question" id="question" placeholder="Input pertanyaan..." />
                    </div>
                    <div class="const-dom col-sm-12 mt-2 mb-2" id="const-dom">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="input_tool" id="input_tool_{{$num}}">
                                        @foreach($area->C_Jawaban as $jawabannya)
                                        <div class="select_tool_{{$num}} selectlclass" id="select_tool_{{$num}}">
                                            <div class="form-group">
                                                <input type="text" value="{{$jawabannya}}" name="answer[]" id="answer" class="form-control answer" placeholder="Jawaban Singkat" />
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-2 {{ ($area->B_TypeJawaban == 't_text') ? 'd-none' : '' }} show_more_answer" id="show_more_answer_{{$num}}" onclick="moreanswer({{$num}})">
                                    <div class="btn btn-success add_answer" id="add_answer">Tambah jawaban</div>
                                </div>
                                <div class="col-sm-2">
                                    <select name="toolhtml" id="toolhtml_{{$num}}" class="form-control toolhtml" onChange="changetype({{$num}})">
                                        <option value="t_text" {{ ($area->B_TypeJawaban == 't_text') ? 'selected' : '' }}>Text</option>
                                        <option value="t_select" {{ ($area->B_TypeJawaban == 't_select') ? 'selected' : '' }}>Select</option>
                                        <option value="t_checkbox" {{ ($area->B_TypeJawaban == 't_checkbox') ? 'selected' : '' }}>Checkbox</option>
                                        <option value="t_radio" {{ ($area->B_TypeJawaban == 't_radio') ? 'selected' : '' }}>Radio</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php($num++)
                @endforeach
            </div>
            <div class="newRow" id="newRow"></div>
            <div class="button-grup">
                <a href="{{route('forms.index')}}" class="btn btn-danger m-1">Back</a>
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@section('script-footer')
<script>
    $(document).ready(function() {
        $('.selectlclass').removeClass('d-none');
    });
</script>
<script type="text/javascript">
    let one = $('#wrapper-question').children('div.list-question').length;
    let i = one;

    $("#plus").click(function() {
        i++;
        var html = '<div class="rounded shadow-lg p-2 list-question" id="list-question">    <div class="question-wrap col-sm-12 mt-2 mb-2" id="question-wrap_' + i + '">        <div class="row">            <label for="question" class="col-sm-11">                <h5 class="text-dark">Pertanyaan <span class="text-danger">*</span></h5>            </label>       <span class="text-danger" id="removeRow">Remove</span> </div>        <input type="text" class="form-control mb-1 question" name="question" id="question" placeholder="Input pertanyaan..." />    </div>    <div class="const-dom col-sm-12 mt-2 mb-2" id="const-dom">        <div class="form-group">            <div class="row">                <div class="col-sm-8">                    <div class="input_tool" id="input_tool_' + i + '">                        <div class="select_tool_' + i + '" id="select_tool_' + i + '">                            <div class="form-group">                                <input type="text" name="answer[]" id="answer" class="form-control answer" placeholder="Jawaban Singkat" />                            </div>                        </div>                    </div>                </div>                <div class="col-sm-2 d-none show_more_answer" id="show_more_answer_' + i + '" onclick="moreanswer(' + i + ')">                    <div class="btn btn-success add_answer" id="add_answer">Tambah jawaban</div>                </div>                <div class="col-sm-2">                    <select name="toolhtml" id="toolhtml_' + i + '" class="form-control toolhtml" onChange="changetype(' + i + ')">                        <option value="t_text">Text</option>                        <option value="t_select">Select</option>                        <option value="t_checkbox">Checkbox</option>                        <option value="t_radio">Radio</option>                    </select>                </div>            </div>        </div>    </div></div>';
        $('#newRow').append(html);
    });

    $(document).on('click', '#removeRow', function() {
        $(this).closest('#list-question').remove();
    });

    function changetype(num) {
        $('#show_more_answer_' + num).removeClass('d-none');
        let html = '';
        let component = $('#toolhtml_' + num).val();
        if (component == 't_text') {
            html += '<div class="select_tool_' + num + '" id="select_tool_' + num + '"><div class="form-group"><input type="text" name="answer[]" id="answer" class="form-control answer" placeholder="Jawaban Singkat" /></div></div>';
            $('#toolhtml_' + num + ' option[value="' + component + '"]').attr("selected", true);
            $('#show_more_answer_' + num).addClass('d-none');
        } else {
            html += '<div class="select_tool_' + num + '" id="select_tool_' + num + '"><div class="form-group"><input type="text" class="form-control answer" name="answer[]" id="answer" placeholder="Jawaban Singkat" /></div></div>';
            $('#toolhtml_' + num + ' option[value="' + component + '"]').attr("selected", true);
        }
        $(".select_tool_" + num).each(function(item) {
            $(this).remove();
        })
        $('#input_tool_' + num).append(html);
    }

    function moreanswer(num) {
        $('#show_more_answer_' + num).removeClass('d-none');
        let html = '';
        let component = $('#toolhtml_' + num).val();
        if (component == 't_text') {
            html += '<div class="select_tool_' + num + '" id="select_tool_' + num + '"><div class="form-group"><input type="text" name="answer[]" id="answer" class="form-control answer" placeholder="Jawaban Singkat" /></div></div>';
            $('#toolhtml_' + num + ' option[value="' + component + '"]').attr("selected", true);
            $('#show_more_answer_' + num).addClass('d-none');
        } else {
            html += '<div class="select_tool_' + num + '" id="select_tool_' + num + '"><div class="form-group"><input type="text" class="form-control answer" name="answer[]" id="answer" placeholder="Jawaban Singkat" /></div></div>';
            $('#toolhtml_' + num + ' option[value="' + component + '"]').attr("selected", true);
        }
        $('#input_tool_' + num).append(html);
    }

    $('#myForm').submit(function(e) {
        e.preventDefault();

        let two = $('#newRow').children('div.list-question').length;
        var satusemua = [];

        for (let pageOne = 0; pageOne <= one; pageOne++) {
            let cek = [];
            $('#wrapper-question').find('#input_tool_' + [pageOne] + ' input[name="answer[]"]').map(function() {
                return cek.push($(this).val())
            }).get()
            satusemua.push({
                'A_Pertanyaan': $('#wrapper-question').find('#question-wrap_' + [pageOne] + ' input[name="question"]').val(),
                'B_TypeJawaban': $('#wrapper-question').find('#toolhtml_' + [pageOne] + '').val(),
                'C_Jawaban': cek
            });
        }

        if (two > 0) {
            let addRows = one;
            for (let yes = 0; yes < two; yes++) {
                let cek2 = [];
                addRows++;
                $('#newRow').find('#input_tool_' + [addRows] + ' input[name="answer[]"]').map(function() {
                    return cek2.push($(this).val())
                }).get()
                satusemua.push({
                    'A_Pertanyaan': $('#newRow').find('#question-wrap_' + [addRows] + ' input[name="question"]').val(),
                    'B_TypeJawaban': $('#newRow').find('#toolhtml_' + [addRows] + '').val(),
                    'C_Jawaban': cek2
                })
            }
        }

        let formData = {
            'titleheader': $('#name').val(),
            'listquestions': satusemua,
            'branch': $('#branch').val()
        }

        $.ajax({
            type: 'PUT',
            url: "{{route('forms.update',$form->id)}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            dataType: 'json',
            success: function(data) {
                if (data.success == true) {
                    window.history.back();
                }
            },
            error: function(data) {
                console.log(data)
            }
        })
    })
</script>
@endsection
@endsection