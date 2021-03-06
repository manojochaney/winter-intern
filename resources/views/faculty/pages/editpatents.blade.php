@extends('faculty.layouts.dashboard')

@section('section')
<div class="page-container">
<form action="{{url('/staff/editpatents')}}" method='post'> 
    {{csrf_field()}}
    <h1>Patent</h1>
    <input type="text" value="{{$patent->id}}" name="patentid" hidden>

    <div class="row">
        <div class="col-sm-5">
            <div class="form-group">
                <label>Patent Name:</label>
                <input type="text" name="name" class='form-control' placeholder="name" value="{{$patent->name}}" required>
            </div>             
        </div>
        
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Patent Inventor name:</label>
                <input type="text" name="patent_inventor_name" class='form-control' value="{{$patent->inventor}}" placeholder="inventor name" required>
            </div>             
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group field_wrapper2">
                <label>Co-Inventor (if any)</label>
                @foreach($patent->coinventors as $coinventor)
                <div style="margin-top:5px">
                    <input type="text" name="co_inventor[]" class="form-control" value="{{ $coinventor }}" style="display:inline-block;width:83%" placeholder="Co-inventor Name">
                    <button class="btn remove_button2" type="button" style="display:inline-block;width:15%">&#10006</button>
                </div>
                @endforeach
                {{-- <div></div> --}}
                <a href="#" class="btn btn-default btn-block add_button2" style="margin-top:10px;" title="Add field2">Add more</a>
            </div>             
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-5">
            <div class="form-group">
                <label>Application Number:</label>
                <input type="text" name="application_number" class='form-control' value="{{$patent->application_no}}" placeholder="application number" required>
            </div>             
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Application Date:</label>
                <input type="date" name="application_date" class='form-control' value="{{ date($patent->application_date) }}" required>
            </div>             
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Publication Date:</label>
                <input type="date" name="publication_date" class='form-control' value="{{ date($patent->publication_date) }}" required>
            </div>             
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Type of User:</label>
                <input type="text" name="type_of_user" class='form-control' placeholder="Type" required value="{{$patent->type_of_user}}">
            </div>             
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <div class="form-group">
                <label>Status:</label>
                <input type="text" name="status" class='form-control' placeholder="Status" required value="{{$patent->status}}">
            </div>             
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Academic Year:</label>
                {{-- <input type="text" name="academic_year[]" class='form-control' required> --}}
                <div class="row">
                    <div class="col-sm-5">
                        <select name="year[]" class="form-control" id="from-year" required>
                            <option value="">From</option>
                            @foreach($from_years as $from_year)
                            <option value="{{ $from_year }}" @if($from_year == $patent->from_year) selected @endif> {{ $from_year }} </option>
                            @endforeach
                        </select>
                    </div>
                    <span class="col-sm-1">&#8211</span>
                    <div class="col-sm-5">
                        {{-- <select name="year[]" class="form-control" id="to-year" required>
                            <option value="">To</option>
                            @foreach($to_years as $to_year)
                            <option value="{{ $to_year }}" @if($to_year == $paper->to_year) selected @endif> {{ $to_year }} </option>
                            @endforeach
                        </select> --}}
                        <input type="text" class="form-control" name="year[]" value="{{ $patent->to_year }}" id="to-year" readonly>
                    </div>
                </div>
            </div>             
        </div>
    </div>

    {{-- {{Form::hidden('_method', 'PATCH')}} --}}
    <div class="row">
        <div class="col-sm-4">
            {{Form::submit('Submit', ['class' =>'btn btn-primary'])}}
        </div>
    </div>
    {{-- {{Form::submit('Submit', ['class' =>'btn btn-primary'])}} --}}
    {!! Form::close() !!}
</div>

<style>
    .input-group-addon{

  background-color:#d9534f;
  color:white;
}
    </style>


<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button2'); //Add button selector
    var wrapper = $('.field_wrapper2'); //Input field wrapper
    // var fieldHTML2 = '<div><input type="text" name="field_name2[]" value="" placeholder="name"/><a href="" class="btn btn-default remove_button2">Remove</a></div>'; //New input field html 
    var fieldHTML2 = `<div style="margin-top:5px">
                        <input type="text" name="co_inventor[]" class="form-control" style="display:inline-block;width:83%" placeholder="Co-inventor Name">
                        <button class="btn remove_button2" type="button" style="display:inline-block;width:15%">&#10006</button>
                      </div>`; //New input field html 
    var y = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(y < maxField){ 
            y++; //Increment field counter
            $(addButton).before(fieldHTML2); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button2', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        y--; //Decrement field counter
    });

    $('#from-year').on('change', function() {
        value = $(this).val();
        $('#to-year').val(parseInt(value)+1);
    });
});
</script>
 @endsection
 
 