@extends('master')
@section('title', '- Forms')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h2>Tambah Form</h2>
        <form id="myForm"> <?php /*{{route('forms.store')}}*/ ?>
            <div class="form-group">
                <label for="name">Header Title</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Nama Form" autofocus />
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="branch">Cabang</label>
                <select name="branch" id="branch" class="form-control">
                    @foreach($branchs as $branch)
                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-100 text-right">
                <div class="plus btn btn-primary" id="plus">
                    Tambah list pertanyaan
                </div>
            </div>
            <div class="form-group mt-3 mb-3" id="wrapper-question">
                <div class="rounded shadow-lg p-2 list-question" id="list-question">
                    <div class="question-wrap col-sm-12 mt-2 mb-2" id="question-wrap_1">
                        <div class="row">
                            <label for="question" class="col-sm-11">
                                <h5 class="text-dark">Pertanyaan <span class="text-danger">*</span></h5>
                            </label>
                        </div>
                        <input type="text" class="form-control mb-1 question" name="question" id="question" placeholder="Input pertanyaan..." />
                    </div>
                    <div class="const-dom col-sm-12 mt-2 mb-2" id="const-dom">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="input_tool" id="input_tool_1">
                                        <div class="select_tool_1 selectlclass" id="select_tool_1">
                                            <!-- <div class="row"> -->
                                            <div class="form-group" id="toolofform_1_1">
                                                <input type="text" name="answer[]" id="answer" class="form-control answer" placeholder="Jawaban Singkat" />
                                            </div>
                                            <!-- <div class="form-group col-sm-2 text-center d-none">
                                                    <div id="removerow_answer" class="rounded badge badge-danger p-2 m-1 text-light" onclick="removerowanswer(1,1)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                            <path d="M1.293 1.293a1 1 0 0 1 1.414 0L8 6.586l5.293-5.293a1 1 0 1 1 1.414 1.414L9.414 8l5.293 5.293a1 1 0 0 1-1.414 1.414L8 9.414l-5.293 5.293a1 1 0 0 1-1.414-1.414L6.586 8 1.293 2.707a1 1 0 0 1 0-1.414z" />
                                                        </svg>
                                                    </div>
                                                </div> -->
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2 d-none show_more_answer" id="show_more_answer_1" onclick="moreanswer(1)">
                                    <div class="btn btn-success add_answer" id="add_answer">Tambah jawaban</div>
                                </div>
                                <!-- <div class="col-sm-2 d-none" id="r_row_answer_1_1">
                                    <div id="removerow_answer_1_1">
                                        <span class="text-danger">x</span>
                                    </div>
                                </div> -->
                                <div class="col-sm-2">
                                    <select name="toolhtml" id="toolhtml_1" class="form-control toolhtml" onChange="changetype(1)">
                                        <option value="t_text">Text</option>
                                        <option value="t_select">Select</option>
                                        <option value="t_checkbox">Checkbox</option>
                                        <option value="t_radio">Radio</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        // console.log("{{route('forms.store')}}")
        $('.show_more_answer').addClass('d-none');
        $('.selectlclass').removeClass('d-none');
    });
</script>
<script type="text/javascript">
    let i = 1;

    $("#plus").click(function() {
        i++;
        var html = '<div class="rounded shadow-lg p-2 list-question" id="list-question">    <div class="question-wrap col-sm-12 mt-2 mb-2" id="question-wrap_' + i + '">        <div class="row">            <label for="question" class="col-sm-11">                <h5 class="text-dark">Pertanyaan <span class="text-danger">*</span></h5>            </label>       <span class="text-danger" id="removeRow">Remove</span> </div>        <input type="text" class="form-control mb-1 question" name="question" id="question" placeholder="Input pertanyaan..." />    </div>    <div class="const-dom col-sm-12 mt-2 mb-2" id="const-dom">        <div class="form-group">            <div class="row">                <div class="col-sm-8">                    <div class="input_tool" id="input_tool_' + i + '">                        <div class="select_tool_' + i + '" id="select_tool_' + i + '">                            <div class="form-group" id="toolofform_' + i + '_1">                                <input type="text" name="answer[]" id="answer" class="form-control answer" placeholder="Jawaban Singkat" />                            </div>                        </div>                    </div>                </div>                <div class="col-sm-2 d-none show_more_answer" id="show_more_answer_' + i + '" onclick="moreanswer(' + i + ')">                    <div class="btn btn-success add_answer" id="add_answer">Tambah jawaban</div>                </div>                <div class="col-sm-2">                    <select name="toolhtml" id="toolhtml_' + i + '" class="form-control toolhtml" onChange="changetype(' + i + ')">                        <option value="t_text">Text</option>                        <option value="t_select">Select</option>                        <option value="t_checkbox">Checkbox</option>                        <option value="t_radio">Radio</option>                    </select>                </div>            </div>        </div>    </div></div>';
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
</script>
<script>
    $('#myForm').submit(function(e) {
        e.preventDefault();

        let one = $('#wrapper-question').children('div.list-question').length;
        let two = $('#newRow').children('div.list-question').length;

        var satusemua = [];
        let cek = [];

        let pertanyaanPertama = $('#wrapper-question').find('#question-wrap_1 input[name="question"]').val();
        let typePertama = $('#wrapper-question').find('#toolhtml_1').val();
        let jawabanPertama = $('#wrapper-question').find('#input_tool_1 input[name="answer[]"]').map(function() {
            return cek.push($(this).val())
        }).get()
        satusemua.push({
            'A_Pertanyaan': pertanyaanPertama,
            'B_TypeJawaban': typePertama,
            'C_Jawaban': cek
        });

        if (two > 0) {
            for (let yes = 2; yes <= i; yes++) {
                let cek2 = [];
                $('#newRow').find('#input_tool_' + [yes] + ' input[name="answer[]"]').map(function() {
                    return cek2.push($(this).val())
                }).get()
                satusemua.push({
                    'A_Pertanyaan': $('#newRow').find('#question-wrap_' + [yes] + ' input[name="question"]').val(),
                    'B_TypeJawaban': $('#newRow').find('#toolhtml_' + [yes] + '').val(),
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
            type: 'POST',
            url: "{{route('forms.store')}}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                if (data.success == true) {
                    window.history.back();
                }
            },
            error: function(data) {
                console.log(data)
            }
        })

        // $(document).on('click', '#removerow_answer', function() {
        //     $(this).closest('#list-question').remove();
        // });

        // $('#add_answer').click(function() {
        //     document.getElementById("myForm").reset();
        // });
        // $('#newRow').children('div.list-question').find('input[name="question"]').val();
        // console.log(two)
        //var parent = [];
        //var list_jawabannya = [];
        // parent.push({ 'A_Pertanyaan':  $('#wrapper-question').children('div.list-question').find('#question').val(), 'B_TipeJawaban':  $('#wrapper-question').children('div.list-question').find('#toolhtml_1').val(), 'C_ListJawaban': list_jawabannya });

        // $('.question').each( function(e){
        //     cr.push(e.val());
        // });
        // console.log(cr);
        // $('#myForm').submit(function() {
        //     var cek = $('#wrapper-question').children('div.list-question').length;
        //     alert(cek)
        // // })
        // console.log($('#newRow').children('div.list-question').length);
        // let one = $('#wrapper-question').children('div.list-question').length;

        //catatan:
        // semua element di beri nomor untuk looping untuk di masukkan ke array parent

        // var num_elem = 1;
        // let parent = [];
        // for (var num_elem = 1; num_elem <= ii; num_elem++) {

        // }
    })
</script>
@endsection
@endsection