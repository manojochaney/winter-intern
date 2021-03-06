@extends('faculty.layouts.dashboard')
@section('page_heading','Profile')
@section('section')

<style>
    .collapsible::after{
        content: '\25bc';
        float: right;
    }

    .collapsible {
        padding: 5px;
    }

    .collapsible:hover {
        cursor: pointer;
        background-color: rgb(240, 240, 240);
        /* border: 1px solid black; */
        /* box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24); */
    }

    hr {
        margin: 10px;
    }
</style>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-3">
            <div style="position: relative">
                @if($pic !== null)
                <img src="data:image/png;base64,{{base64_encode($pic->image)}}" style="width:100%;">
                @else
                <img class="img-rounded" src="http://zoom.trus.co.id/plugintracker/images/pp-default.jpg" style="width:100%;">
                @endif
                <div style="position: absolute;width: 30px;right: 0;bottom: 0;transform: translate(30%,30%);">
                    <a href="{{ url ('/staff/uploadImage') }}">
                        <img src="https://cdn0.iconfinder.com/data/icons/social-messaging-ui-color-shapes/128/write-circle-blue-512.png" style="width:100%">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-9" style="border-left: 1px solid gray;">
            <h1><b> {{ $staff->first_name.' '.$staff->last_name }} </b></h1>
            <h4><b>Email</b> : {{ $staff->email }} </h4>
            <h4><b>Employee Number</b> : {{ $staff->e_id }} </h4>
            <h4><b>Designation</b> : {{ $staff->designation }} </h4>
            <h4><b>Department</b> : {{ $department->dept_name }} </h4>
            <h4><b>Date of joining</b> : {{ date("M jS, Y", strtotime($staff->doj)) }} </h4>
            <h4><b>Date of leaving</b> : {{ date("M jS, Y", strtotime($staff->dol)) }} </h4>
        </div>
    </div>
    <hr>
    <div class="row">
        <h3 class="text-danger"><b>Personal Details</b></h3>
        <div class="col-sm-4">
            <h4><b>Contact</b></h4>
            <h5> {{ $staff->mobile }} </h5>
        </div>
        <div class="col-sm-4">
            <h4><b>Date of Birth</b></h4>
            <h5> {{ date("M jS, Y", strtotime($staff->dob)) }} </h5>
        </div>
        <div class="col-sm-4">
            <h4><b>Aadhar Number</b></h4>
            <h5> {{ $staff->aadhaar_id }} </h5>
        </div>
        <div class="col-sm-4">
            <h4><b>Gender</b></h4>
            @if($staff->gender == 'M')
                <h5>MALE</dd>
            @elseif($staff->gender == 'F')
                <h5>FEMALE</dd>
            @endif
        </div>
        <div class="col-sm-4">
            <h4><b>Concol Number</b></h4>
            <h5> {{ $staff->concol }} </h5>
        </div>
        <div class="col-sm-4">
            <h4><b>PAN Number</b></h4>
            <h5> {{ $staff->pancard }} </h5>
        </div>
        <div class="col-sm-6">
            <h4><b>Address</b></h4>
            <h5> {{ $staff->address }} </h5>
        </div>
    </div>
    <hr>
    <div class="row">
        <h3 class="text-danger collapsible" data-toggle="collapse" data-target="#educational-details"><b>Educational Details</b></h3>
        <div id="educational-details" class="collapse">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla delectus accusantium animi laudantium aliquid, voluptates, consequatur placeat, libero a recusandae magni error facilis suscipit cum illo excepturi voluptatem quod modi cumque aliquam praesentium. Iure minus harum mollitia. Harum aliquam eum voluptates, temporibus itaque dignissimos dolorem nesciunt soluta fugiat explicabo delectus dolor, inventore, voluptatem nisi. Officia distinctio placeat facilis ratione itaque incidunt repellendus, fugit saepe? Magni mollitia asperiores id esse minus ipsum dignissimos iusto nam eaque tempore! Inventore expedita sunt nobis facilis dolores enim cum exercitationem delectus accusamus! Obcaecati nesciunt cumque non earum. Dolore, amet eveniet perspiciatis reprehenderit impedit magnam nulla!</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <h3 class="text-danger collapsible" data-toggle="collapse" data-target="#paper-publications"><b>Paper Publications</b></h3>
        <div id="paper-publications" class="collapse">
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-offset-7 text-right">Academic Year</label>
                    <select class="col-sm-2" name="year" data-category="paper-publications">
                        @foreach($academic_years as $academic_year)
                        <option value="{{ $academic_year }}"> {{ $academic_year }} </option>
                        @endforeach
                    </select> 
                </div>
                <div class="col-sm-12" id="paper-publications-container">
                    @if(count($paper_publications))
                    @foreach($paper_publications as $paper_publication)
                    <div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                        <h4 class="col-sm-12"><b> {{ $paper_publication->title }} </b></h4>
                        <p class="col-sm-12"> <b>Authors</b> : {{ $paper_publication->author_names }} </p>
                        <p class="col-sm-12"> <b>Co-authors</b> : {{ $paper_publication->coauthor_names }} </p>
                        <p class="col-sm-12"><b>Publication Date</b> : {{ date("M jS, Y", strtotime($paper_publication->dop)) }} </p>
                        <p class="col-sm-3"><b>Type</b> : {{ $paper_publication->type }} </p>
                        <p class="col-sm-3"><b>Place</b> : {{ $paper_publication->place }} </p>
                        <p class="col-sm-12"><b>DOI</b> : {{ $paper_publication->doi }} </p>
                        <p class="col-sm-12"><b>ISBN/ISSN</b> : {{ $paper_publication->issn_isbn }} </p>
                        <p class="col-sm-12"><b>Link</b> : <a href="{{ $paper_publication->link }}" target="_blank">{{ $paper_publication->link }}</a> </p>
                        <p class="col-sm-12 text-right"><a href=" {{ url('/staff/editpaperpublications/'.$paper_publication->id) }} ">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="{{ $paper_publication->id }}">Delete</a></p>
                    </div>
                    <br>
                    @endforeach
                    @else
                    <div class="row">
                        <h4>No data available yet</h4>
                    </div>
                    @endif
                </div>
                <div class="col-sm-12" style="margin-top: 20px;">
                    <a class="btn btn-primary col-sm-1 col-sm-offset-10" href=" {{ url('/staff/addpaperpublications') }} ">Add New</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <h3 class="text-danger collapsible" data-toggle="collapse" data-target="#courses-conducted"><b>Courses Conducted</b></h3>
        <div id="courses-conducted" class="collapse">
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-offset-7 text-right">Academic Year</label>
                    <select class="col-sm-2" name="year" data-category="courses-conducted">
                        @foreach($academic_years as $academic_year)
                        <option value=" {{ $academic_year }} "> {{ $academic_year }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12" id="courses-conducted-container">
                    @if(count($courses))
                    @foreach($courses as $course)
                    @if($course->conducted_attended == 1)
                    <div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                        <h4 class="col-sm-12"><b> {{ $course->description }} </b></h4>
                        <p class="col-sm-6"> <b><b>Organized by</b> : </b> {{ $course->organised_by }} </p>
                        <p class="col-sm-3"><b>From</b> : {{ date("M jS, Y", strtotime($course->from_date)) }} </p>
                        <p class="col-sm-3"><b>To</b> : {{ date("M jS, Y", strtotime( $course->to_date )) }} </p>
                        <p class="col-sm-4"><b>No of days</b> : {{ $course->no_of_days }} </p>
                        <p class="col-sm-4"><b>Place</b> : {{ $course->place }} </p>
                        <p class="col-sm-12 text-right"><a href=" {{ url('/staff/editcourses/'.$course->id) }} ">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="{{ $course->id }}">Delete</a></p>
                    </div>
                    <br>
                    @endif
                    @endforeach
                    @else
                    <div class="row">
                        <h4>No data available yet</h4>
                    </div>
                    @endif
                </div>
                <div class="col-sm-12" style="margin-top: 20px;">
                    <a class="btn btn-primary col-sm-1 col-sm-offset-10" href="{{ url('/staff/addcourses/') }}">Add New</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <h3 class="text-danger collapsible" data-toggle="collapse" data-target="#courses-attended"><b>Courses Attended</b></h3>
        <div id="courses-attended" class="collapse">
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-offset-7 text-right">Academic Year</label>
                    <select class="col-sm-2" name="year" data-category="courses-attended">
                        @foreach($academic_years as $academic_year)
                        <option value=" {{ $academic_year }} "> {{ $academic_year }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12" id="courses-attended-container">
                    @if(count($courses))
                    @foreach($courses as $course)
                    @if($course->conducted_attended == 0)
                    <div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                        <h4 class="col-sm-12"><b> {{ $course->description }} </b></h4>
                        <p class="col-sm-6"> <b><b>Organized by</b> : </b> {{ $course->organised_by }} </p>
                        <p class="col-sm-3"><b>From</b> : {{ date("M jS, Y", strtotime($course->from_date)) }} </p>
                        <p class="col-sm-3"><b>To</b> : {{ date("M jS, Y", strtotime( $course->to_date )) }} </p>
                        <p class="col-sm-4"><b>No of days</b> : {{ $course->no_of_days }} </p>
                        <p class="col-sm-4"><b>Place</b> : {{ $course->place }} </p>
                        <p class="col-sm-12 text-right"><a href=" {{ url('/staff/editcourses/'.$course->id) }} ">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="{{ $course->id }}">Delete</a></p>
                    </div>
                    <br>
                    @endif
                    @endforeach
                    @else
                    <div class="row">
                        <h4>No data available yet</h4>
                    </div>
                    @endif
                </div>
                <div class="col-sm-12" style="margin-top: 20px;">
                    <a class="btn btn-primary col-sm-1 col-sm-offset-10" href="{{ url('/staff/addcourses/') }}">Add New</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <h3 class="text-danger collapsible" data-toggle="collapse" data-target="#patents-details"><b>Patents Details</b></h3>
        <div id="patents-details" class="collapse">
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-offset-7 text-right">Academic Year</label>
                    <select class="col-sm-2" name="year" data-category="patents-details">
                        @foreach($academic_years as $academic_year)
                        <option value=" {{ $academic_year }} "> {{ $academic_year }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12" id="patents-details-container">
                    @if(count($patents))
                    @foreach($patents as $patent)
                    <div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                        <h4 class="col-sm-12"><b> {{ $patent->name }} </b></h4>
                        <p class="col-sm-5"> <b>Inventor</b> : {{ $patent->inventor }} </p>
                        <p class="col-sm-5"><b>Co-inventor</b> : {{ $patent->coinventors }} </p>
                        <p class="col-sm-5"><b>Application no.</b> : {{ $patent->application_no }} </p>
                        <p class="col-sm-5"><b>Type</b> : {{ $patent->type_of_user }} </p>
                        <p class="col-sm-4"><b>Application Date</b> : {{ $patent->application_date }} </p>
                        <p class="col-sm-4"><b>Publication Date</b> : {{ $patent->publication_date }} </p>
                        <p class="col-sm-4"><b>Status</b> : {{ $patent->status }} </p>
                        <p class="col-sm-12 text-right"><a href=" {{ url('/staff/editpatents/'.$patent->id) }} ">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="{{ $patent->id }}">Delete</a></p>
                    </div>
                    <br>
                    @endforeach
                    @else
                    <div class="row">
                        <h4>No data available yet</h4>
                    </div>
                    @endif
                </div>
                <div class="col-sm-12" style="margin-top: 20px;">
                    <a class="btn btn-primary col-sm-1 col-sm-offset-10" href="{{ url('/staff/addpatents/') }}">Add New</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <h3 class="text-danger collapsible" data-toggle="collapse" data-target="#activities"><b>Activities</b></h3>
        <div id="activities" class="collapse">
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-offset-7 text-right">Academic Year</label>
                    <select class="col-sm-2" name="year" data-category="activities">
                        @foreach($academic_years as $academic_year)
                        <option value="{{ $academic_year }}"> {{ $academic_year }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12" id="activities-container">
                    @if(count($activities))
                    @foreach($activities as $activity)
                    <div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                        <h4 class="col-sm-12"><b> {{ $activity->title }} </b></h4>
                        <p class="col-sm-12"> <b>Type</b> : {{ $activity->type }} </p>
                        <p class="col-sm-4"><b>Duration</b> :  {{ $activity->duration }} </p>
                        <p class="col-sm-12 text-right"><a href=" {{ url('/staff/editactivities/'.$activity->id) }} ">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="{{ $activity->id }}">Delete</a></p>
                    </div>
                    <br>
                    @endforeach
                    @else
                    <div class="row">
                        <h4>No data available yet</h4>
                    </div>
                    @endif
                </div>
                <div class="col-sm-12" style="margin-top: 20px;">
                    <a class="btn btn-primary col-sm-1 col-sm-offset-10" href="{{ url('/staff/addactivities/') }}">Add New</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <h3 class="text-danger collapsible" data-toggle="collapse" data-target="#research-grants"><b>Research Grants</b></h3>
        <div id="research-grants" class="collapse">
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-offset-7 text-right">Academic Year</label>
                    <select class="col-sm-2" name="year" data-category="research-grants">
                        @foreach($academic_years as $academic_year)
                        <option value=" {{ $academic_year }} "> {{ $academic_year }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12" id="research-grants-container">
                    @if(count($research_grants))
                    @foreach($research_grants as $research_grant)
                    <div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                        <h4 class="col-sm-12"><b> {{ $research_grant->title }} </b></h4>
                        <p class="col-sm-12"> <b>Agency</b> : {{ $research_grant->agency }} </p>
                        <p class="col-sm-4"><b>Period</b> : {{ $research_grant->period }}</p>
                        <p class="col-sm-4"><b>Grant amount</b> : Rs. {{ $research_grant->grant_amount }} lakhs</p>
                        <p class="col-sm-12 text-right"><a href=" {{ url('/staff/editresearchgrants/'.$research_grant->id) }} ">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="{{ $research_grant->id }}">Delete</a></p>
                    </div>
                    <br>
                    @endforeach
                    @else
                    <div class="row">
                        <h4>No data available yet</h4>
                    </div>
                    @endif
                </div>
                <div class="col-sm-12" style="margin-top: 20px;">
                    <a class="btn btn-primary col-sm-1 col-sm-offset-10" href="{{ url('/staff/addresearchgrants/') }}">Add New</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <h3 class="text-danger collapsible" data-toggle="collapse" data-target="#industry-interaction"><b>Industry Interaction</b></h3>
        <div id="industry-interaction" class="collapse">
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-offset-7 text-right">Academic Year</label>
                    <select class="col-sm-2" name="year" data-category="industry-interaction">
                        @foreach($academic_years as $academic_year)
                        <option value=" {{ $academic_year }} "> {{ $academic_year }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12" id="industry-interaction-container">
                    @if(count($industry_interactions))
                    @foreach($industry_interactions as $industry_interaction)
                    <div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                        <h4 class="col-sm-12"><b> {{ $industry_interaction->title_of_industry_project }} </b></h4>
                        <p class="col-sm-12"> <b>Industry</b> : {{ $industry_interaction->industry_name }} </p>
                        <p class="col-sm-4"><b>Industry Faculty Name</b> : {{ $industry_interaction->industry_faculty_name }} </p>
                        <p class="col-sm-4"><b>Industry Faculty contact</b> : {{ $industry_interaction->industry_faculty_contact }} </p>
                        <p class="col-sm-12 text-right"><a href=" {{ url('/staff/editindustryinteractions/'.$industry_interaction->id) }} ">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="{{ $industry_interaction->id }}">Delete</a></p>
                    </div>
                    <br>
                    @endforeach
                    @else
                    <div class="row">
                        <h4>No data available yet</h4>
                    </div>
                    @endif
                </div>
                <div class="col-sm-12" style="margin-top: 20px;">
                    <a class="btn btn-primary col-sm-1 col-sm-offset-10" href="{{ url('/staff/addindustryinteractions/') }}">Add New</a>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <h3 class="text-danger collapsible" data-toggle="collapse" data-target="#invitations"><b>Invitations</b></h3>
        <div id="invitations" class="collapse">
            <div class="col-sm-12">
                <div class="form-group row">
                    <label class="col-sm-2 col-sm-offset-7 text-right">Academic Year</label>
                    <select class="col-sm-2" name="year" data-category="invitations">
                        @foreach($academic_years as $academic_year)
                        <option value=" {{ $academic_year }} "> {{ $academic_year }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12" id="invitations-container">
                    @if(count($invitations))
                    @foreach($invitations as $invitation)
                    <div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                        <h4 class="col-sm-12"><b> {{ $invitation->title_of_lecture }} </b></h4>
                        <p class="col-sm-12"> <b>Title of Conference</b> : {{ $invitation->title_of_conference }} </p>
                        <p class="col-sm-4"><b>Organised by</b> : {{ $invitation->organised_by }} </p>
                        <p class="col-sm-4"><b>Type</b> : {{ $invitation->type_of_conference }} </p>
                        <p class="col-sm-12 text-right"><a href=" {{ url('/staff/editinvitations/'.$invitation->id) }} ">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="{{ $invitation->id }}">Delete</a></p>
                    </div>
                    <br>
                    @endforeach
                    @else
                    <div class="row">
                        <h4>No data available yet</h4>
                    </div>
                    @endif
                </div>
                <div class="col-sm-12" style="margin-top: 20px;">
                    <a class="btn btn-primary col-sm-1 col-sm-offset-10" href="{{ url('/staff/addinvitations/') }}">Add New</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>


    
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-post', function() {
            d = confirm('Confirm Delete');
            if(d) {
                category = $(this).parent().parent().parent().parent().parent().attr('id');
                id = $(this).data('id');
                $.ajax({
                    context: this,
                    url: '/staff/deletepost/'+category+'/'+id,
                    success: function(data) {
                        if(data) {
                            $(this).parent().parent().remove();
                            alert('Removed Successfully');
                        }
                        else {
                            alert('Server Error');
                        }
                    }
                });
            }
        });

        $("[name='year']").on('change',function() {
            // alert($(this).data('category'));
            // alert($(this).val());
            // $('#valsel').text($(this).val());
            var category = $(this).data('category'),
                year = $(this).val();
                
            // alert('#' + category);
            $.ajax({
                url: '/staff/getyeardata',
                data: {category: category, year: year},
                success: function(data) {
                    data = JSON.parse(data);
                    $('#' + category + '-container').empty();
                    if(data.length == 0) {
                        $('#' + category + '-container').append('<div class="row"><h4>No data available yet</h4></div>');
                    }
                    else if(category == 'paper-publications') {
                        for (var i = 0; i < data.length; i++) {
                            var text = `<div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                                            <h4 class="col-sm-12"><b>` + data[i]['title'] + `</b></h4>
                                            <p class="col-sm-12"> <b>Authors</b> :` + data[i]['author_names'] + `</p>
                                            <p class="col-sm-12"> <b>Co-authors</b> :` + data[i]['coauthor_names'] + `</p>
                                            <p class="col-sm-12"><b>Publication Date</b> :` + data[i]['dop'] + `</p>
                                            <p class="col-sm-3"><b>Type</b> :` + data[i]['type'] + `</p>
                                            <p class="col-sm-3"><b>Place</b> :` + data[i]['place'] + `</p>
                                            <p class="col-sm-12"><b>DOI</b> :` + data[i]['doi'] + `</p>
                                            <p class="col-sm-12"><b>ISBN/ISSN</b> :` + data[i]['issn_isbn'] + `</p>
                                            <p class="col-sm-12"><b>Link</b> : <a href="` + data[i]['link'] + `" target="_blank">` + data[i]['link'] + `</a> </p>
                                            <p class="col-sm-12 text-right"><a href="/staff/editpaperpublications/` + data[i]['id'] + `">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="` + data[i]['id'] + `">Delete</a></p>
                                        </div>
                                        <br>`;
                            $('#'+category+'-container').append(text);
                        }
                    }
                    else if(category == 'courses-conducted') {
                        for (var i = 0; i < data.length; i++) {
                            var text = `<div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                                            <h4 class="col-sm-12"><b> ` + data[i]['description'] + ` </b></h4>
                                            <p class="col-sm-6"> <b><b>Organized by</b> : </b> ` + data[i]['organised_by'] + ` </p>
                                            <p class="col-sm-3"><b>From</b> : ` + data[i]['from_date'] + ` </p>
                                            <p class="col-sm-3"><b>To</b> : ` + data[i]['to_date'] + ` </p>
                                            <p class="col-sm-4"><b>No of days</b> : ` + data[i]['no_of_days'] + ` </p>
                                            <p class="col-sm-4"><b>Place</b> : ` + data[i]['place'] + ` </p>
                                            <p class="col-sm-12 text-right"><a href="/staff/editcourses/` + data[i]['id'] + ` ">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="` + data[i]['id'] + `">Delete</a></p>
                                        </div>
                                        <br>`;
                            $('#'+category+'-container').append(text);
                        }
                    }
                    else if(category == 'courses-attended') {
                        for (var i = 0; i < data.length; i++) {
                            var text = `<div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                                            <h4 class="col-sm-12"><b> ` + data[i]['description'] + ` </b></h4>
                                            <p class="col-sm-6"> <b><b>Organized by</b> : </b> ` + data[i]['organised_by'] + ` </p>
                                            <p class="col-sm-3"><b>From</b> : ` + data[i]['from_date'] + ` </p>
                                            <p class="col-sm-3"><b>To</b> : ` + data[i]['to_date'] + ` </p>
                                            <p class="col-sm-4"><b>No of days</b> : ` + data[i]['no_of_days'] + ` </p>
                                            <p class="col-sm-4"><b>Place</b> : ` + data[i]['place'] + ` </p>
                                            <p class="col-sm-12 text-right"><a href="/staff/editcourses/` + data[i]['id'] + ` ">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="` + data[i]['id'] + `">Delete</a></p>
                                        </div>
                                        <br>`;
                            $('#'+category+'-container').append(text);
                        }
                    }
                    else if(category == 'patents-details') {
                        for (var i = 0; i < data.length; i++) {
                            var text = `<div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                                            <h4 class="col-sm-12"><b>` + data[i]['name']  + `</b></h4>
                                            <p class="col-sm-5"> <b>Inventor</b> :` + data[i]['inventor']  + `</p>
                                            <p class="col-sm-5"><b>Co-inventor</b> :` + data[i]['coinventors']  + `</p>
                                            <p class="col-sm-5"><b>Application no.</b> :` + data[i]['application_no']  + `</p>
                                            <p class="col-sm-5"><b>Type</b> :` + data[i]['type_of_user']  + `</p>
                                            <p class="col-sm-4"><b>Application Date</b> :` + data[i]['application_date']  + `</p>
                                            <p class="col-sm-4"><b>Publication Date</b> :` + data[i]['publication_date']  + `</p>
                                            <p class="col-sm-4"><b>Status</b> :` + data[i]['status']  + `</p>
                                            <p class="col-sm-12 text-right"><a href="/staff/editpatents/` + data[i]['id'] + `">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="` + data[i]['id'] + `">Delete</a></p>
                                        </div>
                                        <br>`;
                            $('#'+category+'-container').append(text);
                        }
                    }
                    else if(category == 'activities') {
                        for (var i = 0; i < data.length; i++) {
                            var text = `<div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                                            <h4 class="col-sm-12"><b>` + data[i]['title'] + `</b></h4>
                                            <p class="col-sm-12"> <b>Type</b> :` + data[i]['type'] + `</p>
                                            <p class="col-sm-4"><b>Duration</b> : ` + data[i]['duration'] + `</p>
                                            <p class="col-sm-12 text-right"><a href="/staff/editactivities/` + data[i]['id'] + `">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="` + data[i]['id'] + `">Delete</a></p>
                                        </div>
                                        <br>`;
                            $('#'+category+'-container').append(text);
                        }
                    }
                    else if(category == 'research-grants') {
                        for (var i = 0; i < data.length; i++) {
                            var text = `<div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                                            <h4 class="col-sm-12"><b>`+ data[i]['title'] +` </b></h4>
                                            <p class="col-sm-12"> <b>Agency</b> :`+ data[i]['agency'] +` </p>
                                            <p class="col-sm-4"><b>Period</b> :`+ data[i]['period_from'] +` to`+ data[i]['period_to'] +`</p>
                                            <p class="col-sm-4"><b>Grant amount</b> : `+ data[i]['grant_amount'] +` </p>
                                            <p class="col-sm-12 text-right"><a href="/staff/editresearchgrants/`+data[i]['id']+`">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="` + data[i]['id'] + `">Delete</a></p>
                                        </div>
                                        <br>`;
                            $('#'+category+'-container').append(text);
                        }
                    }
                    else if(category == 'industry-interaction') {
                        for (var i = 0; i < data.length; i++) {
                            var text = `<div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                                            <h4 class="col-sm-12"><b>`+ data[i]['title_of_industry_project']+` </b></h4>
                                            <p class="col-sm-12"> <b>Industry</b> :`+ data[i]['industry_name']+` </p>
                                            <p class="col-sm-4"><b>Industry Faculty Name</b> :`+ data[i]['industry_faculty_name']+` </p>
                                            <p class="col-sm-4"><b>Industry Faculty contact</b> :`+ data[i]['industry_faculty_contact']+` </p>
                                            <p class="col-sm-12 text-right"><a href="/staff/editindustryinteractions/`+data[i]['id']+`">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="` + data[i]['id'] + `">Delete</a></p>
                                        </div>
                                        <br>`;
                            $('#'+category+'-container').append(text);
                        }
                    }
                    else if(category == 'invitations') {
                        for (var i = 0; i < data.length; i++) {
                            var text = `<div class="row" style="border: 1px solid white;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);">
                                            <h4 class="col-sm-12"><b>`+ data[i]['title_of_lecture']+` </b></h4>
                                            <p class="col-sm-12"> <b>Title of Conference</b> :`+ data[i]['title_of_conference']+` </p>
                                            <p class="col-sm-4"><b>Organised by</b> :`+ data[i]['organised_by']+` </p>
                                            <p class="col-sm-4"><b>Type</b> :`+ data[i]['type_of_conference']+` </p>
                                            <p class="col-sm-12 text-right"><a href="/staff/editinvitations/`+data[i]['id']+`">Edit</a><span style="margin: 0 5px;">|</span><a class="delete-post" data-id="` + data[i]['id'] + `">Delete</a></p>
                                        </div>
                                        <br>`;
                            $('#'+category+'-container').append(text);
                        }
                    }
                }
            });

        });
    });
</script>

@stop
