@extends('master')
@section('title', '- Forms')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <form id="myForm">
            <div class="form-group">
                <h2 class="text-center">{{$lists->header_title}}</h2>
            </div>
            <div class="form-group mt-3 mb-3" id="wrapper-question">
                @php($num = 1)
                @foreach(json_decode($lists->question_n_answer) as $area)
                <div class="rounded shadow-lg p-2 list-question" id="list-question">
                    <div class="question-wrap col-sm-12 mt-2 mb-2" id="question-wrap_{{$num}}">
                        <h4>{{ucfirst($area->A_Pertanyaan)}}</h4>
                    </div>
                    <div class="const-dom col-sm-12 mt-2 mb-2">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="input_tool" id="input_tool_{{$num}}">
                                        <div class="select_tool_{{$num}} selectlclass" id="select_tool_{{$num}}">
                                            <div class="form-group" id="toolofform_{{$num}}">
                                                @if( $area->B_TypeJawaban == 't_select' )
                                                    <select name="y_answer[]" id="y_answer" class="form-control">
                                                @endif
                                                @foreach($area->C_Jawaban as $jawabannya)
                                                    @if( $area->B_TypeJawaban == 't_checkbox' )
                                                        <input type="checkbox" name="y_answer[]" id="y_answer" value="{{$jawabannya}}" />
                                                        <label for="y_answer">{{ucfirst($jawabannya)}}</label><br />
                                                    @elseif( $area->B_TypeJawaban == 't_radio' )
                                                        <input type="radio" name="y_answer[]" id="y_answer" value="{{$jawabannya}}" />
                                                        <label for="y_answer">{{ucfirst($jawabannya)}}</label><br />
                                                    @elseif( $area->B_TypeJawaban == 't_select' )
                                                        <option value="{{$jawabannya}}">{{$jawabannya}}</option>
                                                    @else
                                                        <input type="text" name="y_answer[]" id="y_answer[]" class="form-control" placeholder="Jawaban pertanyaan" />
                                                    @endif
                                                @endforeach
                                                @if( $area->B_TypeJawaban == 't_select' )
                                                </select>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php($num++)
                @endforeach
            </div>
            <div class="button-grup">
                <button type="submit" class="btn btn-primary m-1">Save</button>
            </div>
        </form>
    </div>
</div>
@section('script-footer')
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
            'listquestions': satusemua
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
                console.log(data);
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