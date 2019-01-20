<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Faculty;
use App\Department;
use App\Faculty_teaching_staff;
use App\Student;
use Illuminate\Support\Facades\Input;
use App\Course_map;
use App\SubjectAllotment;
use App\Term;
use App\CtCC;
// use App\Profile_images;
use File;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

use App\FacultyPaperPublication;
use App\FacultyCourses;
use App\FacultyPatents;

use App\FacultyActivities;
use App\FacultyResearchGrants;
use App\FacultyIndustryInteraction;
use App\FacultyInvitations;

class FacultyController extends Controller
{
    /**
     * Route to faculty dashboard, Connects databases and passes database object to dashboard
     *
     * @return view home with database object
     */
    public function index(){
        if(session('e_id')){
            return view('faculty.pages.home');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    // public function hodprofile(Request $request){
    //     if(session('e_id')){
            
    //         $arr = array();
    //         if ($request['all_year']=='all')
    //             if($request['all_faculty']=='all'){
    //                 if($request['paper']=='paper'){
    //                     $papers=FacultyPaperPublication::all();
    //                     $arr['paper']=$papers;
    //                 }
    //                 if($request['course']=='course'){
    //                     $courses=FacultyCourses::all();
    //                     $arr['course']=$courses;
    //                 }
    //                 if($request['patent']=='patent'){
    //                     $patents=FacultyPatents::all();
    //                     $arr['patent']=$patents;
    //                 }
    //                 if($request['activity']=='activity'){
    //                     $activities=FacultyActivities::all();
    //                     $arr['activity']=$activities;
    //                 }
    //                 if($request['industry_interaction']=='industry_interaction'){
    //                     $interactions=FacultyIndustryInteraction::all();
    //                     $arr['industry_interaction']=$interactions;
    //                 }
    //                 if($request['invitation']=='invitation'){
    //                     $invitations=FacultyInvitations::all();
    //                     $arr['invitation']=$invitations;
    //                 }
    //                 if($request['research_grant']=='research_grant'){
    //                     $grants=FacultyResearchGrants::all();
    //                     $arr['research_grant']=$grants;
    //                 }
    //             }

    //             if ($request['all_year']=='all')
    //             if($request['all_faculty']!='all'){
    //                 $faculty=$request['search_faculty'];
    //                 if($request['paper']=='paper'){
    //                     $papers=FacultyPaperPublication::where('e_id',$faculty)->get();
    //                     $arr['paper']=$papers;
    //                 }
    //                 if($request['course']=='course'){
    //                     $courses=FacultyCourses::where('e_id',$faculty)->get();
    //                     $arr['course']=$courses;
    //                 }
    //                 if($request['patent']=='patent'){
    //                     $patents=FacultyPatents::where('e_id',$faculty)->get();
    //                     $arr['patent']=$patents;
    //                 }
    //                 if($request['activity']=='activity'){
    //                     $activities=FacultyActivities::where('e_id',$faculty)->get();
    //                     $arr['activity']=$activities;
    //                 }
    //                 if($request['industry_interaction']=='industry_interaction'){
    //                     $interactions=FacultyIndustryInteraction::where('e_id',$faculty)->get();
    //                     $arr['industry_interaction']=$interactions;
    //                 }
    //                 if($request['invitation']=='invitation'){
    //                     $invitations=FacultyInvitations::where('e_id',$faculty)->get();
    //                     $arr['invitation']=$invitations;
    //                 }
    //                 if($request['research_grant']=='research_grant'){
    //                     $grants=FacultyResearchGrants::where('e_id',$faculty)->get();
    //                     $arr['research_grant']=$grants;
    //                 }
    //             }

    //             if ($request['all_year']!='all')
    //             if($request['all_faculty']=='all'){
    //                 $year=$request['search_year'];
    //                 if($request['paper']=='paper'){
    //                     $papers=FacultyPaperPublication::where('year',$year)->get();
    //                     $arr['paper']=$papers;
    //                 }
    //                 if($request['course']=='course'){
    //                     $courses=FacultyCourses::where('year',$year)->get();
    //                     $arr['course']=$courses;
    //                 }
    //                 if($request['patent']=='patent'){
    //                     $patents=FacultyPatents::where('year',$year)->get();
    //                     $arr['patent']=$patents;
    //                 }
    //                 if($request['activity']=='activity'){
    //                     $activities=FacultyActivities::all();
    //                     $arr['activity']=$activities;
    //                 }
    //                 if($request['industry_interaction']=='industry_interaction'){
    //                     $interactions=FacultyIndustryInteraction::where('year',$year)->get();
    //                     $arr['industry_interaction']=$interactions;
    //                 }
    //                 if($request['invitation']=='invitation'){
    //                     $invitations=FacultyInvitations::where('year',$year)->get();
    //                     $arr['invitation']=$invitations;
    //                 }
    //                 if($request['research_grant']=='research_grant'){
    //                     $grants=FacultyResearchGrants::where('year',$year)->get();
    //                     $arr['research_grant']=$grants;
    //                 }
    //             }

    //             if ($request['all_year']!='all')
    //             if($request['all_faculty']!='all'){
    //                 $faculty=$request['search_faculty'];
    //                 $year=$request['search_year'];
    //                 if($request['paper']=='paper'){
    //                     $papers=FacultyPaperPublication::where('e_id',$faculty)->where('year',$year)->get();
    //                     $arr['paper']=$papers;
    //                 }
    //                 if($request['course']=='course'){
    //                     $courses=FacultyCourses::where('e_id',$faculty)->where('year',$year)->get();
    //                     $arr['course']=$courses;
    //                 }
    //                 if($request['patent']=='patent'){
    //                     $patents=FacultyPatents::where('e_id',$faculty)->where('year',$year)->get();
    //                     $arr['patent']=$patents;
    //                 }
    //                 if($request['activity']=='activity'){
    //                     $activities=FacultyActivities::where('e_id',$faculty)->where('year',$year)->get();
    //                     $arr['activity']=$activities;
    //                 }
    //                 if($request['industry_interaction']=='industry_interaction'){
    //                     $interactions=FacultyIndustryInteraction::where('e_id',$faculty)->where('year',$year)->get();
    //                     $arr['industry_interaction']=$interactions;
    //                 }
    //                 if($request['invitation']=='invitation'){
    //                     $invitations=FacultyInvitations::where('e_id',$faculty)->where('year',$year)->get();
    //                     $arr['invitation']=$invitations;
    //                 }
    //                 if($request['research_grant']=='research_grant'){
    //                     $grants=FacultyResearchGrants::where('e_id',$faculty)->where('year',$year)->get();
    //                     $arr['research_grant']=$grants;
    //                 }
    //             }
    //         // $value = $request['search'];
    //         // $year= $request['year'];
    //         //$year1= $request['year1'];
    //         // return $request['paper'];
    //         // $staff_eid=Staff::select('e_id')->where('first_name',$value)->get();
            

    //         // if($request['paper']=='paper'){
    //         //     $papers=FacultyPaperPublication::where('e_id',$value)->where('year',$year)->get();
    //         //     $arr['paper']=$papers;
    //         // }
    //         // if($request['course']=='course'){
    //         //     $courses=FacultyCourses::where('e_id',$value)->where('year',$year)->get();
    //         //     $arr['course']=$courses;
    //         // }
    //         // if($request['patent']=='patent'){
    //         //     $patents=FacultyPatents::where('e_id',$value)->where('year',$year)->get();
    //         //     $arr['patent']=$patents;
    //         // }

    //         // if($request['paper']=='paper'){
    //         //     $papers=FacultyPaperPublication::where('year',$year1)->get();
    //         //     $arr['paper']=$papers;
    //         // }
    //         //return $arr['paper'];
    //         //return count ($arr['paper']);
    //                 return view('faculty.pages.search')->with('array',$arr);

                
    //     }
    // }
    /**
     * Route to profile page of faculty
     *
     * @return profile view and faculry database objects 
     */
    public function profile(Request $request){
        
        if(session('e_id')){
            // if ($request->isMethod('get')) {
            //     return 'get';
            // }
            $e_id =  $request->session()->get('e_id');
            $faculty = Faculty::find($e_id);
            $department = Department::find($faculty->department_id);
            
            $academic_years = array();
            // return date("M jS, Y", strtotime($faculty->doj));
            $current_yr = date('Y');
            // return $current_yr;
            $joining_yr = (int)(explode('-',$faculty->doj)[0]);
            // return $current_yr-$joining_yr;
            $dt = date('Y-m-d');
            $st = $current_yr.'-07-01';
            if($dt > $st) {
                // return 'odd';
                $count = $current_yr-$joining_yr;
                for($i = $current_yr; $count >= 0; $i--) {
                    array_push($academic_years,implode('-',[$i,$i+1]));
                    $count = $count - 1;
                }
                // return $academic_years;
            }
            else {
                // return 'even';
                $count = $current_yr-$joining_yr-1;
                // return $count;
                for($i = $current_yr-1; $count >= 0; $i--) {
                    array_push($academic_years,implode('-',[$i,$i+1]));
                    $count = $count - 1;
                }
                // return $academic_years;
            }
            
            $paper_publications = $faculty->paper_publications()->where('academic_year',$academic_years[0])->get();
            $courses = $faculty->courses()->where('academic_year',$academic_years[0])->get();
            $activities = $faculty->activities()->where('academic_year',$academic_years[0])->get();
            $industry_interactions = $faculty->industry_interactions()->where('academic_year',$academic_years[0])->get();
            $invitations = $faculty->invitations()->where('academic_year',$academic_years[0])->get();
            $patents = $faculty->patents()->where('academic_year',$academic_years[0])->get();
            $research_grants = $faculty->research_grants()->where('academic_year',$academic_years[0])->get();
            // if()
            // return $courses;
            // return $department;
            // $profilePic = Profile_images::find($e_id);
            $profilePic = null;
            // return $profilePic;
            
            return view('faculty.pages.profile1')->with('staff', $faculty)->with('department',$department)->with('pic', $profilePic)->with('paper_publications',$paper_publications)->with('courses',$courses)->with('activities',$activities)->with('industry_interactions',$industry_interactions)->with('invitations',$invitations)->with('patents',$patents)->with('research_grants',$research_grants)->with('academic_years',$academic_years);
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function getfacultydata($eid,$academic_year,$cat,$all_faculty,$all_year,$all_cat) {

        $paper_publications = null;
        $courses_conducted = null;
        $courses_attended = null;
        $activities = null;
        $industry_interactions = null;
        $invitations = null;
        $patents = null;
        $research_grants = null;

        if(isset($all_cat)) {
            $cat = array('paper_publications','courses_conducted','courses_attended','activities','industry_interactions','invitations','patents','research_grants');
        }
        // return $cat;
        if(isset($all_faculty)) {
            $faculties = Faculty::where('department_id',$dept)->get(['e_id']);
            $faculties = $faculties->pluck('e_id')->toArray();
            if(isset($all_year)) {
                if(in_array('paper_publications',$cat)) {
                    $paper_publications = FacultyPaperPublication::whereIn('e_id',$faculties)->get(['title','author_names','coauthor_names','type','doi','issn_isbn','dop','place','link','academic_year']);
                }
                if(in_array('courses_conducted',$cat)) {
                    $courses_conducted = FacultyCourses::where('conducted_attended','1')->whereIn('e_id',$faculties)->get(['description','organised_by','from_date','to_date','no_of_days','place','name','academic_year']);
                }
                if(in_array('courses_attended',$cat)) {
                    $courses_attended = FacultyCourses::where('conducted_attended','0')->whereIn('e_id',$faculties)->get(['description','organised_by','from_date','to_date','no_of_days','place','name','academic_year']);
                }
                if(in_array('activities',$cat)) {
                    $activities = FacultyActivities::whereIn('e_id',$faculties)->get(['type','title','duration','academic_year']);
                }
                if(in_array('industry_interactions',$cat)) {
                    $industry_interactions = FacultyIndustryInteraction::whereIn('e_id',$faculties)->get(['title_of_industry_project','industry_name','industry_contact_person','faculty_name','academic_year']);
                }
                if(in_array('invitations',$cat)) {
                    $invitations = FacultyInvitations::whereIn('e_id',$faculties)->get(['title_of_lecture','title_of_conference','organised_by','international_national','academic_year']);
                }
                if(in_array('patents',$cat)) {
                    $patents = FacultyPatents::whereIn('e_id',$faculties)->get(['type_of_user','application_no','name','inventor','coinventors','status','academic_year']);
                }
                if(in_array('research_grants',$cat)) {
                    $research_grants = FacultyResearchGrants::whereIn('e_id',$faculties)->get(['title','faculty_name','agency','period_from','period_to','grant_amount','academic_year']);
                }
            }
            else {
                if(in_array('paper_publications',$cat)) {
                    $paper_publications = FacultyPaperPublication::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get(['title','author_names','coauthor_names','type','doi','issn_isbn','dop','place','link','academic_year']);
                }
                if(in_array('courses_conducted',$cat)) {
                    $courses_conducted = FacultyCourses::where('academic_year',$academic_year)->where('conducted_attended','1')->whereIn('e_id',$faculties)->get(['description','organised_by','from_date','to_date','no_of_days','place','name','academic_year']);
                }
                if(in_array('courses_attended',$cat)) {
                    $courses_attended = FacultyCourses::where('academic_year',$academic_year)->where('conducted_attended','0')->whereIn('e_id',$faculties)->get(['description','organised_by','from_date','to_date','no_of_days','place','name','academic_year']);
                }
                if(in_array('activities',$cat)) {
                    $activities = FacultyActivities::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get(['type','title','duration','academic_year']);
                }
                if(in_array('industry_interactions',$cat)) {
                    $industry_interactions = FacultyIndustryInteraction::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get(['title_of_industry_project','industry_name','industry_contact_person','faculty_name','academic_year']);
                }
                if(in_array('invitations',$cat)) {
                    $invitations = FacultyInvitations::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get(['title_of_lecture','title_of_conference','organised_by','international_national','academic_year']);
                }
                if(in_array('patents',$cat)) {
                    $patents = FacultyPatents::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get(['type_of_user','application_no','name','inventor','coinventors','status','academic_year']);
                }
                if(in_array('research_grants',$cat)) {
                    $research_grants = FacultyResearchGrants::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get(['title','faculty_name','agency','period_from','period_to','grant_amount','academic_year']);
                }
            }
        }
        else {
            if(isset($all_year)) {
                if(in_array('paper_publications',$cat)) {
                    $paper_publications = FacultyPaperPublication::where('e_id',$eid)->get(['title','author_names','coauthor_names','type','doi','issn_isbn','dop','place','link','academic_year']);
                }
                if(in_array('courses_conducted',$cat)) {
                    $courses_conducted = FacultyCourses::where('conducted_attended','1')->where('e_id',$eid)->get(['description','organised_by','from_date','to_date','no_of_days','place','name','academic_year']);
                }
                if(in_array('courses_attended',$cat)) {
                    $courses_attended = FacultyCourses::where('conducted_attended','0')->where('e_id',$eid)->get(['description','organised_by','from_date','to_date','no_of_days','place','name','academic_year']);
                }
                if(in_array('activities',$cat)) {
                    $activities = FacultyActivities::where('e_id',$eid)->get(['type','title','duration','academic_year']);
                }
                if(in_array('industry_interactions',$cat)) {
                    $industry_interactions = FacultyIndustryInteraction::where('e_id',$eid)->get(['title_of_industry_project','industry_name','industry_contact_person','faculty_name','academic_year']);
                }
                if(in_array('invitations',$cat)) {
                    $invitations = FacultyInvitations::where('e_id',$eid)->get(['title_of_lecture','title_of_conference','organised_by','international_national','academic_year']);
                }
                if(in_array('patents',$cat)) {
                    $patents = FacultyPatents::where('e_id',$eid)->get(['type_of_user','application_no','name','inventor','coinventors','status','academic_year']);
                }
                if(in_array('research_grants',$cat)) {
                    $research_grants = FacultyResearchGrants::where('e_id',$eid)->get(['title','faculty_name','agency','period_from','period_to','grant_amount','academic_year']);
                }
            }
            else {
                if(in_array('paper_publications',$cat)) {
                    $paper_publications = FacultyPaperPublication::where('academic_year',$academic_year)->where('e_id',$eid)->get(['title','author_names','coauthor_names','type','doi','issn_isbn','dop','place','link','academic_year']);
                }
                if(in_array('courses_conducted',$cat)) {
                    $courses_conducted = FacultyCourses::where('academic_year',$academic_year)->where('conducted_attended','1')->where('e_id',$eid)->get(['description','organised_by','from_date','to_date','no_of_days','place','name','academic_year']);
                }
                if(in_array('courses_attended',$cat)) {
                    $courses_attended = FacultyCourses::where('academic_year',$academic_year)->where('conducted_attended','0')->where('e_id',$eid)->get(['description','organised_by','from_date','to_date','no_of_days','place','name','academic_year']);
                }
                if(in_array('activities',$cat)) {
                    $activities = FacultyActivities::where('academic_year',$academic_year)->where('e_id',$eid)->get(['type','title','duration','academic_year']);
                }
                if(in_array('industry_interactions',$cat)) {
                    $industry_interactions = FacultyIndustryInteraction::where('academic_year',$academic_year)->where('e_id',$eid)->get(['title_of_industry_project','industry_name','industry_contact_person','faculty_name','academic_year']);
                }
                if(in_array('invitations',$cat)) {
                    $invitations = FacultyInvitations::where('academic_year',$academic_year)->where('e_id',$eid)->get(['title_of_lecture','title_of_conference','organised_by','international_national','academic_year']);
                }
                if(in_array('patents',$cat)) {
                    $patents = FacultyPatents::where('academic_year',$academic_year)->where('e_id',$eid)->get(['type_of_user','application_no','name','inventor','coinventors','status','academic_year']);
                }
                if(in_array('research_grants',$cat)) {
                    $research_grants = FacultyResearchGrants::where('academic_year',$academic_year)->where('e_id',$eid)->get(['title','faculty_name','agency','period_from','period_to','grant_amount','academic_year']);
                }
            }
        }

        $data = array();
        $data['paper_publications'] = $paper_publications;
        $data['courses_conducted'] = $courses_conducted;
        $data['courses_attended'] = $courses_attended;
        $data['activities'] = $activities;
        $data['industry_interactions'] = $industry_interactions;
        $data['invitations'] = $invitations;
        $data['patents'] = $patents;
        $data['research_grants'] = $research_grants;

        return $data;
    }

    public function facultyreports(Request $request) {
        if (session('e_id')) {
            $dept = Faculty::where('e_id','=',session('e_id'))->first()->department_id;
            if ($request->isMethod('get')) {
                if ($request->path() == 'staff/facultyreports') {
                    $academic_years = array();
                    $current_yr = date('Y');
                    $joining_yr = 1950;
                    $dt = date('Y-m-d');
                    $st = $current_yr.'-07-01';
                    if($dt > $st) {
                        $count = $current_yr-$joining_yr;
                        for($i = $current_yr; $count >= 0; $i--) {
                            array_push($academic_years,implode('-',[$i,$i+1]));
                            $count = $count - 1;
                        }
                    }
                    else {
                        $count = $current_yr-$joining_yr-1;
                        for($i = $current_yr-1; $count >= 0; $i--) {
                            array_push($academic_years,implode('-',[$i,$i+1]));
                            $count = $count - 1;
                        }
                    }
                    return view('faculty.pages.facultyreportsearch')->with('academic_years',$academic_years);
                }
                if ($request->path() == 'staff/facultysuggestion') {
                    foreach(session('roles') as $role){
                        if($role == 4 || $role == 9 || $role == 8 || $role == 0){
                            $field_value = $request->field_value;
                            $match = Faculty::where('department_id' , '=' , $dept)
                            ->where(function($query) use ($field_value) {
                                $query->where('e_id','=',$field_value)
                                ->orWhere('short_form','=',$field_value)
                                ->orWhere('first_name','=',$field_value)
                                ->orWhere('last_name','=',$field_value);
                            })
                            ->first();
                            return response()->json($match);
                        }
                    }
                    return redirect()->back()->with('error','Unauthorised Access');
                }
            }
            if($request->isMethod('post')) {
                // return $request->field_value;
                $eid = $request->hidden_eid;
                $academic_year = $request->academic_year;
                $cat = $request->category;
                $all_faculty = $request->all_faculty;
                $all_year = $request->all_year;
                $all_cat = $request->all_cat;

                $data = $this->getfacultydata($eid,$academic_year,$cat,$all_faculty,$all_year,$all_cat);

                $paper_publications = $data['paper_publications'];
                $courses_conducted = $data['courses_conducted'];
                $courses_attended = $data['courses_attended'];
                $activities = $data['activities'];
                $industry_interactions = $data['industry_interactions'];
                $invitations = $data['invitations'];
                $patents = $data['patents'];
                $research_grants = $data['research_grants'];

                $query = array();
                $query['eid'] = $eid;
                $query['academic_year'] = $academic_year;
                // $query['cat'] = $cat.toJson();
                $query['cat'] = implode('-',$cat);
                $query['all_faculty'] = $all_faculty;
                $query['all_year'] = $all_year;
                $query['all_cat'] = $all_cat;


                // if(isset($all_cat)) {
                //     $cat = array('paper_publications','courses_conducted','courses_attended','activities','industry_interactions','invitations','patents','research_grants');
                // }
                // // return $cat;
                // if(isset($all_faculty)) {
                //     $faculties = Faculty::where('department_id',$dept)->get(['e_id']);
                //     $faculties = $faculties->pluck('e_id')->toArray();
                //     if(isset($all_year)) {
                //         if(in_array('paper_publications',$cat)) {
                //             $paper_publications = FacultyPaperPublication::whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('courses_conducted',$cat)) {
                //             $courses_conducted = FacultyCourses::where('conducted_attended','1')->whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('courses_attended',$cat)) {
                //             $courses_attended = FacultyCourses::where('conducted_attended','0')->whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('activities',$cat)) {
                //             $activities = FacultyActivities::whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('industry_interactions',$cat)) {
                //             $industry_interactions = FacultyIndustryInteraction::whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('invitations',$cat)) {
                //             $invitations = FacultyInvitations::whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('patents',$cat)) {
                //             $patents = FacultyPatents::whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('research_grants',$cat)) {
                //             $research_grants = FacultyResearchGrants::whereIn('e_id',$faculties)->get();
                //         }
                //     }
                //     else {
                //         if(in_array('paper_publications',$cat)) {
                //             $paper_publications = FacultyPaperPublication::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('courses_conducted',$cat)) {
                //             $courses_conducted = FacultyCourses::where('academic_year',$academic_year)->where('conducted_attended','1')->whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('courses_attended',$cat)) {
                //             $courses_attended = FacultyCourses::where('academic_year',$academic_year)->where('conducted_attended','0')->whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('activities',$cat)) {
                //             $activities = FacultyActivities::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('industry_interactions',$cat)) {
                //             $industry_interactions = FacultyIndustryInteraction::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('invitations',$cat)) {
                //             $invitations = FacultyInvitations::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('patents',$cat)) {
                //             $patents = FacultyPatents::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get();
                //         }
                //         if(in_array('research_grants',$cat)) {
                //             $research_grants = FacultyResearchGrants::where('academic_year',$academic_year)->whereIn('e_id',$faculties)->get();
                //         }
                //     }
                // }
                // else {
                //     if(isset($all_year)) {
                //         if(in_array('paper_publications',$cat)) {
                //             $paper_publications = FacultyPaperPublication::where('e_id',$eid)->get();
                //         }
                //         if(in_array('courses_conducted',$cat)) {
                //             $courses_conducted = FacultyCourses::where('conducted_attended','1')->where('e_id',$eid)->get();
                //         }
                //         if(in_array('courses_attended',$cat)) {
                //             $courses_attended = FacultyCourses::where('conducted_attended','0')->where('e_id',$eid)->get();
                //         }
                //         if(in_array('activities',$cat)) {
                //             $activities = FacultyActivities::where('e_id',$eid)->get();
                //         }
                //         if(in_array('industry_interactions',$cat)) {
                //             $industry_interactions = FacultyIndustryInteraction::where('e_id',$eid)->get();
                //         }
                //         if(in_array('invitations',$cat)) {
                //             $invitations = FacultyInvitations::where('e_id',$eid)->get();
                //         }
                //         if(in_array('patents',$cat)) {
                //             $patents = FacultyPatents::where('e_id',$eid)->get();
                //         }
                //         if(in_array('research_grants',$cat)) {
                //             $research_grants = FacultyResearchGrants::where('e_id',$eid)->get();
                //         }
                //     }
                //     else {
                //         if(in_array('paper_publications',$cat)) {
                //             $paper_publications = FacultyPaperPublication::where('academic_year',$academic_year)->where('e_id',$eid)->get();
                //         }
                //         if(in_array('courses_conducted',$cat)) {
                //             $courses_conducted = FacultyCourses::where('academic_year',$academic_year)->where('conducted_attended','1')->where('e_id',$eid)->get();
                //         }
                //         if(in_array('courses_attended',$cat)) {
                //             $courses_attended = FacultyCourses::where('academic_year',$academic_year)->where('conducted_attended','0')->where('e_id',$eid)->get();
                //         }
                //         if(in_array('activities',$cat)) {
                //             $activities = FacultyActivities::where('academic_year',$academic_year)->where('e_id',$eid)->get();
                //         }
                //         if(in_array('industry_interactions',$cat)) {
                //             $industry_interactions = FacultyIndustryInteraction::where('academic_year',$academic_year)->where('e_id',$eid)->get();
                //         }
                //         if(in_array('invitations',$cat)) {
                //             $invitations = FacultyInvitations::where('academic_year',$academic_year)->where('e_id',$eid)->get();
                //         }
                //         if(in_array('patents',$cat)) {
                //             $patents = FacultyPatents::where('academic_year',$academic_year)->where('e_id',$eid)->get();
                //         }
                //         if(in_array('research_grants',$cat)) {
                //             $research_grants = FacultyResearchGrants::where('academic_year',$academic_year)->where('e_id',$eid)->get();
                //         }
                //     }
                // }

                // return $cat;
                // echo isset($cat);
                // return view('faculty.pages.facultyreportview')->with('eid',$eid);
                return view('faculty.pages.facultyreportview')->with('query',$query)->with('paper_publications',$paper_publications)->with('courses_conducted',$courses_conducted)->with('courses_attended',$courses_attended)->with('activities',$activities)->with('industry_interactions',$industry_interactions)->with('invitations',$invitations)->with('patents',$patents)->with('research_grants',$research_grants);
            }
        }
        else {
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function downloadreports(Request $request){
        if(session('e_id')){
            $eid = $request->eid;
            $academic_year = $request->academic_year;
            $cat = $request->category;
            $cat = explode('-',$cat);
            // return $cat;
            $all_faculty = $request->all_faculty;
            $all_year = $request->all_year;
            $all_cat = $request->all_cat;

            $data = $this->getfacultydata($eid,$academic_year,$cat,$all_faculty,$all_year,$all_cat);

            $paper_publications = $data['paper_publications'];
            $courses_conducted = $data['courses_conducted'];
            $courses_attended = $data['courses_attended'];
            $activities = $data['activities'];
            $industry_interactions = $data['industry_interactions'];
            $invitations = $data['invitations'];
            $patents = $data['patents'];
            $research_grants = $data['research_grants'];

            Excel::create('Faculty Reports',function($excel) use($paper_publications,$courses_conducted,$courses_attended,$activities,$industry_interactions,$invitations,$patents,$research_grants)
            {
                $excel->setTitle('Faculty Reports');

                if(isset($paper_publications) && count($paper_publications)) { 
                    $excel->sheet('Paper Publications',function($sheet) use($paper_publications){
                        $sheet->fromArray($paper_publications,'null','A1','null','null');
                    });
                }

                if(isset($courses_conducted) && count($courses_conducted))
                {
                    
                    $excel->sheet('Courses Conducted',function($sheet) use($courses_conducted){
                        $sheet->fromArray($courses_conducted,'null','A1','null','null');
                    });
                }
                if(isset($courses_attended) && count($courses_attended))
                {
                    $excel->sheet('Courses Attended',function($sheet) use($courses_attended){
                        $sheet->fromArray($courses_attended,'null','A1','null','null');
                    });
                }
                if(isset($activities) && count($activities))
                {
                    $excel->sheet('Activities',function($sheet) use($activities){
                        $sheet->fromArray($activities,'null','A1','null','null');
                    });
                }

                if(isset($industry_interactions) && count($industry_interactions))
                {
                    
                    $excel->sheet('Industry Interactions',function($sheet) use($industry_interactions){
                        $sheet->fromArray($industry_interactions,'null','A1','null','null');
                    });
                }

                if(isset($invitations) && count($invitations))
                {
                    
                    $excel->sheet('Invitations',function($sheet) use($invitations){
                        $sheet->fromArray($invitations,'null','A1','null','null');
                    });
                }
                if(isset($patents) && count($patents))
                {
                    
                    $excel->sheet('Patents',function($sheet) use($patents){
                        $sheet->fromArray($patents,'null','A1','null','null');
                    });
                }
                if(isset($research_grants) && count($research_grants))
                {
                    
                    $excel->sheet('Research Grants',function($sheet) use($research_grants){
                        $sheet->fromArray($research_grants,'null','A1','null','null');
                    });
                }
        
            })->download('xlsx');

            return redirect('/staff/profile')->with('success','Downloaded Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }
    public function addpaperpublications(Request $request){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                return view('faculty.pages.addpaperpublication');
            }
            $paperpublication= new FacultyPaperPublication;
            
            $b=implode(',',$_POST['coauthor_names'] );
            $paperpublication->title=$request['title'];
            $paperpublication->type=$request['type'];
            $paperpublication->author_names=$request['author_names'];
            $paperpublication->doi=$request['doi'];
            $paperpublication->issn_isbn=$request['issn_isbn'];
            $paperpublication->dop=$request['dop'];
            $paperpublication->place=$request['place'];
            $paperpublication->link=$request['link'];
            $paperpublication->year=$request['year'];
            $paperpublication->coauthor_names=$b;
            $paperpublication->e_id=$request->session()->get('e_id');
            $paperpublication->is_author=$request['isauthor'];
            $paperpublication->save();
            
            return redirect('/staff/profile')->with('success','Data Added Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function editpaperpublications(Request $request,$id = null){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                $paper=FacultyPaperPublication::find($id);
                return view('faculty.pages.editpaperpublication')->with('paper',$paper);
            }
            $id=$request->input('paperid');
            $paperpublication=FacultyPaperPublication::find($id);
            $a=implode(',',$_POST['field_name1'] );
            $b=implode(',',$_POST['field_name2'] );
            $paperpublication->title=$request['title'];
            $paperpublication->type=$request['type'];
            $paperpublication->author_names=$a;
            $paperpublication->doi=$request['doi'];
            $paperpublication->issn_isbn=$request['issn_isbn'];
            $paperpublication->dop=$request['dop'];
            $paperpublication->place=$request['place'];
            $paperpublication->link=$request['link'];
            $paperpublication->year=$request['year'];
            $paperpublication->coauthor_names=$b;
            $paperpublication->e_id=$request->session()->get('e_id');
            $paperpublication->is_author=$request['isauthor'];
            $paperpublication->save();
            
            return redirect('/staff/profile')->with('success','Data Modified Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function addcourses(Request $request){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                return view('faculty.pages.addcourse');
            }
            $course= new FacultyCourses;
            $a=implode(',',$_POST['field_name1']);
            $course->name=$request['name'];
            $course->description=$a;
            $course->organised_by=$request['organised_by'];
            $course->from_date=$request['from_date'];
            $course->to_date=$request['to_date'];
            $course->no_of_days=$request['no_of_days'];
            $course->place=$request['place'];
            $course->conducted_attended=$request['conducted_attended'];
            $course->e_id=$request->session->get('e_id');
            $course->save();
            
            return redirect('/staff/profile')->with('success','Data Added Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function editcourses(Request $request,$id = null){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                $course=FacultyCourses::find($id);
                return view('faculty.pages.editcourse')->with('course',$course);
            }
            $id=$request->input('courseid');
            $course=FacultyCourses::find($id);
            $a=implode(',',$_POST['field_name1']);
            $course->name=$request['name'];
            $course->description=$a;
            $course->organised_by=$request['organised_by'];
            $course->from_date=$request['from_date'];
            $course->to_date=$request['to_date'];
            $course->no_of_days=$request['no_of_days'];
            $course->place=$request['place'];
            $course->conducted_attended=$request['conducted_attended'];
            $course->e_id=$request->session->get('e_id');
            $course->save();
            
            return redirect('/staff/profile')->with('success','Data Modified Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function addpatents(Request $request){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                return view('faculty.pages.addpatent');
            }
            $patent=new FacultyPatents;
            $a=implode(',',$_POST['field_name1']);
            $patent->name=$request['name'];
            $patent->application_no=$request['application_number'];
            $patent->inventor=$request['patent_inventor_name'];
            $patent->type_of_user=$request['type_of_user'];
            $patent->coinventors=$a;
            $patent->status=$request['status'];
            $patent->year=$request['year'];
            $patent->e_id=$request->session()->get('e_id');
            $patent->save();
            
            return redirect('/staff/profile')->with('success','Data Added Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function editpatents(Request $request,$id=null){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                $patent=FacultyPatents::find($id);        
                return view('faculty.pages.editpatents')->with('patent',$patent);
            }
            $id=$request->input('patentid');
            $patent=FacultyPatents::find($id);
            $a=implode(',',$_POST['field_name1']);
            $patent->name=$request['name'];
            $patent->application_no=$request['application_number'];
            $patent->inventor=$request['patent_inventor_name'];
            $patent->type_of_user=$request['type_of_user'];
            $patent->coinventors=$a;
            $patent->status=$request['status'];
            $patent->year=$request['year'];
            $patent->e_id=$request->session()->get('e_id');
            $patent->save();
            
            return redirect('/staff/profile')->with('success','Data Modified Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function addactivities(Request $request){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                return view('faculty.pages.addactivities');
            }
            $e_id=$request->session()->get('e_id');
            $activity=new FacultyActivities;
            $activity->title=$request->input('title_of_activity');
            $activity->type=$request->input('type_of_activity');
            $activity->duration=$request->input('duration_of_activity');
            $activity->year=$request->input('activity_year');
            $activity->e_id=$e_id;
            $activity->save();
            
            return redirect('/staff/profile')->with('success','Data Added Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function editactivities(Request $request,$id=null){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                $activity=FacultyActivities::find($id);
                return view('faculty.pages.editactivities')->with('activity',$activity);
            }
            $id=$request->input('activityid');
            $e_id=$request->session()->get('e_id');
            $activity=FacultyActivities::find($id);
            $activity->title=$request->input('title_of_activity');
            $activity->type=$request->input('type_of_activity');
            $activity->duration=$request->input('duration_of_activity');
            $activity->year=$request->input('activity_year');
            $activity->e_id=$e_id;
            $activity->save();
            
            return redirect('/staff/profile')->with('success','Data Modified Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function addresearchgrants(Request $request){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                return view('faculty.pages.addresearchgrants');
            }
            $e_id = $request->session()->get('e_id');
            $first_name=$request->session()->get('first_name');
            $last_name=$request->session()->get('last_name');
            $name=$first_name.' '.$last_name;
            $grants=new FacultyResearchGrants;
            $grants->title=$request->input('title_of_grant');
            $grants->faculty_name=$name;
            $grants->agency=$request->input('agency');
            $grants->period_from=$request->input('period_from');
            $grants->period_to=$request->input('period_to');
            $grants->grant_amount=$request->input('grant_amount');
            $grants->year=$request->input('grant_year');
            $grants->e_id=$e_id;
            $grants->save();
            
            return redirect('/staff/profile')->with('success','Data Added Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function editresearchgrants(Request $request,$id=null){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                $grant=FacultyResearchGrants::find($id);
                return view('faculty.pages.editresearchgrants')->with('grant',$grant);
            }
            $id=$request->input('grantid');
            $e_id = $request->session()->get('e_id');
            $first_name=$request->session()->get('first_name');
            $last_name=$request->session()->get('last_name');
            $name=$first_name.' '.$last_name;
            $grants=FacultyResearchGrants::find($id);
            $grants->title=$request->input('title_of_grant');
            $grants->faculty_name=$name;
            $grants->agency=$request->input('agency');
            $grants->period_from=$request->input('period_from');
            $grants->period_to=$request->input('period_to');
            $grants->grant_amount=$request->input('grant_amount');
            $grants->year=$request->input('grant_year');
            $grants->e_id=$e_id;
            $grants->save();
            
            return redirect('/staff/profile')->with('success','Data Modified Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function addindustryinteractions(Request $request){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                return view('faculty.pages.addindustryinteraction');
            }
            $e_id = $request->session()->get('e_id');
            $first_name=$request->session()->get('first_name');
            $last_name=$request->session()->get('last_name');
            $name=$first_name.' '.$last_name;
            $industryinteraction=new FacultyIndustryInteraction;
            $industryinteraction->title_of_industry_project=$request->input('title_of_industry_project');
            $industryinteraction->industry_name=$request->input('industry_name');
            $industryinteraction->industry_contact_person=$request->input('industry_contact_person');
            $industryinteraction->faculty_name=$name;
            $industryinteraction->year=$request->input('interaction_year');
            $industryinteraction->e_id=$e_id;
            $industryinteraction->save();
            
            return redirect('/staff/profile')->with('success','Data Added Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function editindustryinteractions(Request $request,$id=null){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                $industryinteraction=FacultyIndustryInteraction::find($id);
                return view("faculty.pages.editindustryinteraction")->with('industryinteraction',$industryinteraction);
            }
            $id=$request->input('interactionid');
            $e_id = $request->session()->get('e_id');
            $first_name=$request->session()->get('first_name');
            $last_name=$request->session()->get('last_name');
            $name=$first_name.' '.$last_name;
            $industryinteraction=FacultyIndustryInteraction::find($id);
            $industryinteraction->title_of_industry_project=$request->input('title_of_industry_project');
            $industryinteraction->industry_name=$request->input('industry_name');
            $industryinteraction->industry_contact_person=$request->input('industry_contact_person');
            $industryinteraction->faculty_name=$name;
            $industryinteraction->year=$request->input('interaction_year');
            $industryinteraction->e_id=$e_id;
            $industryinteraction->save();
            
            return redirect('/staff/profile')->with('success','Data Modified Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function addinvitations(Request $request){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                return view('faculty.pages.addinvitations');
            }
            $e_id = $request->session()->get('e_id');
            $invitations=new FacultyInvitations;
            $invitations->title_of_lecture=$request->input('title_of_lecture');
            $invitations->title_of_conference=$request->input('title_of_conference');
            $invitations->organised_by=$request->input('organised_by');
            $invitations->international_national=$request->input('type_of_conference');
            $invitations->year=$request->input('invitation_year');
            $invitations->e_id=$e_id;
            $invitations->save();
            
            return redirect('/staff/profile')->with('success','Data Added Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function editinvitations(Request $request,$id=null){
        if(session('e_id')){
            if ($request->isMethod('get')) {
                $invitation=FacultyInvitations::find($id);
                return view('faculty.pages.editinvitations')->with('invitation',$invitation);
            }
            $id=$request->input('postid');
            $e_id = $request->session()->get('e_id');
            $invitations=FacultyInvitations::find($id);
            $invitations->title_of_lecture=$request->input('title_of_lecture');
            $invitations->title_of_conference=$request->input('title_of_conference');
            $invitations->organised_by=$request->input('organised_by');
            $invitations->international_national=$request->input('type_of_conference');
            $invitations->year=$request->input('invitation_year');
            $invitations->e_id=$e_id;
            $invitations->save();
            
            return redirect('/staff/profile')->with('success','Data Modified Successfully');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function getyeardata(Request $request) {
        if(session('e_id')){
            $category = $request->input('category');
            $year = $request->input('year');

            $e_id =  $request->session()->get('e_id');
            $faculty = Faculty::find($e_id);

            if($category == 'paper-publications') {
                $paper_publications = $faculty->paper_publications()->where('academic_year',$year)->get()->toJson();
                return $paper_publications;
            }
            else if($category == 'courses-conducted') {
                $courses = $faculty->courses()->where('academic_year',$year)->where('conducted_attended',1)->get()->toJson();
                return $courses;
            }
            else if($category == 'courses-attended') {
                $courses = $faculty->courses()->where('academic_year',$year)->where('conducted_attended',0)->get()->toJson();
                return $courses;
            }
            else if($category == 'patents-details') {
                $patents = $faculty->patents()->where('academic_year',$year)->get()->toJson();
                return $patents;
            }
            else if($category == 'activities') {
                $activities = $faculty->activities()->where('academic_year',$year)->get()->toJson();
                return $activities;
            }
            else if($category == 'research-grants') {
                $research_grants = $faculty->research_grants()->where('academic_year',$year)->get()->toJson();
                return $research_grants;
            }
            else if($category == 'industry-interaction') {
                $industry_interactions = $faculty->industry_interactions()->where('academic_year',$year)->get()->toJson();
                return $industry_interactions;
            }
            else if($category == 'invitations') {
                $invitations = $faculty->invitations()->where('academic_year',$year)->get()->toJson();
                return $invitations;
            }
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function searchStudent(){
        if(session('e_id')){
            $term = Input::get('q');

            if(strlen($term) == 0){
                return redirect()->back()->with('error','Please enter first name or last name to search');
            }

            $results = array();
            
            $queries = Student::where('uid', '=', $term)
            ->orwhere('email_id', '=', $term)
            ->orWhere('first_name', 'like', $term.'%')
            ->orWhere('middle_name', 'like', $term.'%')
            ->orWhere('last_name', 'like', $term.'%')
            ->get();

            return view('faculty.pages.searchstudent') ->with ("students",$queries);
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }
    /**
     * Redirect to attendance page of student
     *
     * @return view and database objects
     */
    public function studentattendance(){
        if(session('e_id')){
            $eid='464';
            $year="16";
            $month=date("m");
            if($month>6)
            {
                $subject_details = DB::select("select s.division,s.sub_allotment_id,c.course_name,c.course_code,c.term_id,s.contact_head from course_map as c join subject_allotment as s on c.course_code=s.course_code and c.term_id=s.term_id where s.e_id= '$eid' and s.term_id like '$year%' and s.term_id%2=1");
            }
            else
            {
                $subject_details = DB::select("select s.division,s.sub_allotment_id,c.course_name,c.course_code,c.term_id,s.contact_head from course_map as c join subject_allotment as s on c.course_code=s.course_code and c.term_id=s.term_id where s.e_id= '$eid' and s.term_id like '$year%' and s.term_id%2=0");
            }
            return view('faculty.pages.studentattendance',['subject_details' => $subject_details],['students' => 'NULL']);
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
        
    }

    public function addingstudentattendance(Request $request){
        if(session('e_id')){
            return view('faculty.pages.addAttendanceRecord',['data' => $request]);
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
        
    }

    public function getStudentRecord(Request $request){
        if(session('e_id')){
            $date = $request->get("date");
            $div = $request->get("div");
            $termid = $request->get("termid");
            $suballotid = $request->get("suballotid");
            $data = DB::select("select s.FirstName,s.LastName,sa.roll_no,sa.UID from student as s join student_allotment as sa on s.UID=sa.UID where sa.term_id='$termid' and sa.division='$div' order by sa.roll_no");
            return view('faculty.pages.addAttendanceRecord',['data' => $request],['students' => $data]);
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
        
    }

    /**
     * Redirect to attendance page of faculty
     *
     * @return view and database objects
     */
    public function facultyattendance(){
        if(session('e_id')){
            return view('faculty.pages.facultyattendance');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }
    public function attendance(){
        if(session('e_id')){
            return view('faculty.pages.attendance');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    /**
     * Redirects to roles and responsibility page of faculty 
     *
     * @return view 
     */
    public function roles(){
        if(session('e_id')){
            foreach(session('roles') as $role){
                if($role == 1){
                    return view('faculty.pages.roles_resp');
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    /**
     * Redirects to courses taught by the teaching staff page
     *
     * @return courses view and database object
     */
    public function courses(){
        
        if(session('e_id')){
            foreach(session('types') as $type){
                if($type == 1){
                    $e_id = session('e_id');
                    $subjects = SubjectAllotment::where('e_id' ,'=', $e_id)->get();

                    $subYears = array();
                    
                    foreach($subjects as $subject){
                        $term = Term::find($subject->term_id);
                        $course = Course_map::find($subject->course_code);

                        $subject['scheme'] = $term->scheme;
                        $subject['courseName'] = $course->course_name;
                        $subYears[$term->academic_year][$term->semester][] = $subject;
                    }
                    
                    return view('faculty.pages.courses')->with('subjects', $subYears);
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function submitDriveLink(Request $request){

        if(session('e_id')){
            foreach(session('types') as $type){
                if($type == 1){

                    $drive_link = $request->input("gdl");
                    $classroom_link = $request->input("crl");
                    $sub_id = $request->input("sub_id");

                    $subject = SubjectAllotment::find($sub_id);
                    $subject->drive_link = $drive_link;
                    $subject->classroom_link = $classroom_link;
                    $subject->save();  

                    return redirect()->back()->with('success','Links updated');         
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }


    /**
     * redirect to report generation page where table will be displayed according to 
     * filters and export option will be provided 
     *
     * @return view and database objects
     */
    public function report(){
        
        if(session('e_id')){
            foreach(session('roles') as $role){
                if($role == 3){
                    return view('faculty.pages.report');
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function uploadImage(){        
        return view('faculty.pages.uploadImage');
    }



    public function generate_report(request $request){
        $this -> validate($request, [
            'year' =>'required'
        ]);
        //$data='Hello';
        $selected_dep = $request -> input('department');
        $selected_staff = $request -> input('staffType');
        $selected_contract = $request -> input('contractType');
        $selected_year = $request -> input('year');  
        $current_year= date('Y');
        $year_diff=$current_year - $selected_year;
        $query = "SELECT f.first_name, f.last_name, f.e_id, f.type, f.email, 
                                    d.dept_name, dl.start_date, dl.end_date from faculty as f inner join dept_log 
                                    as dl ON dl.e_id = f.e_id INNER JOIN department as d ON d.dept_id = dl.department_id INNER JOIN teaching_staff as t 
                                    ON t.e_id = f.e_id WHERE ((YEAR(dl.start_date) >= $year_diff) or (YEAR(dl.start_date) < $year_diff AND YEAR(dl.end_date)>= $year_diff) 
                                    or (YEAR(dl.start_date) < $year_diff AND YEAR(dl.end_date)=NULL) AND(t.type)=$selected_contract AND(d.dept_id = $selected_staff))"  ;
        $query2 = "SELECT f.first_name, f.last_name, f.e_id, f.type, f.email, d.dept_name, t.start_date from faculty as f inner join dept_log as dl ON dl.e_id = f.e_id INNER JOIN department as d ON d.dept_id = dl.department_id INNER JOIN teaching_staff as t ON t.e_id = f.e_id WHERE d.dept_name = '$selected_dep' AND ((YEAR(dl.start_date) >= $year_diff) OR (YEAR(dl.start_date) < $year_diff AND YEAR(dl.end_date)>= $year_diff) OR (YEAR(dl.start_date) < $year_diff AND YEAR(dl.end_date)=NULL))";
        $data = DB::select($query2);
        echo "$query2";
        return $data;
        //return $year_diff;  

        
           //return view('faculty.pages.report')->with('data',$data);
    }

     public function exam(){
        
        if(session('e_id')){
            foreach(session('roles') as $role){
                if($role == 303){
                    return view('faculty.pages.exam');
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }
    
    public function syllabus(){
        
        if(session('e_id')){
            foreach(session('roles') as $role){
                if($role == 4){
                    return view('faculty.pages.syllabus');
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }
    
    public function bookevent(){
        
        if(session('e_id')){
            return view('faculty.pages.booking_form');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }
      public function defaulter_list() 
    { 
        if(session('e_id')){
            return view('faculty.classCouncellor.defaulter_list'); 
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function courseassign(Request $request){
        if(session('e_id')){
            foreach(session('roles') as $role){
                if($role == 9){
                    
                    if(isset($request->course))
                    {
                        $char = substr($request->year, 2,2);
                        $term = "".$char."".$request->course."".$request->branch."".$request->sem;
                        $term_id = (int)$term;

                        $div = $request->division;
                        $courses = Course_map::where('term_id', '=',$term_id)->get();
                        $request->session()->put('courses', $courses);
                        $request->session()->put('div', $div);
                        // return $courses;
                        // http://cms.com/staff/course/assign?year=2016&course=0&branch=1&sem=3&division=1


                        $subAllotment = SubjectAllotment::where('term_id','=',$term_id)
                        ->where('division','=',chr($div+64))->get();

                        if(count($subAllotment) > 0){
                            return redirect('staff/course/assign')->with('success','Staff Already Alloted');
                        }
                        else{
                            if(count($courses) > 0){
                                return view('faculty.syllabus.staffAssign')->with('div',$div)->with('courses',$courses);
                            }
                            else{
                                return redirect('staff/course/assign')->with('error','Scheme not found! Please enter syllabus scheme');
                            }
                        }
                    }
                    else{
                        return view('faculty.syllabus.staffAssign');
                    }
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
        
        
    }

    public function loadGeneration(Request $request){
        if(session('e_id')){
            foreach(session('roles') as $role){
                if($role == 1 || $role == 2){
                    
                    if(isset($request->course))
                    {
                        $char = substr($request->year, 2,2);
                        $term = "".$char."".$request->course."".$request->branch."".$request->sem;
                        $term_id = (int)$term;

                        $allotments = SubjectAllotment::where('term_id', '=', $term)->get();

                        //return $allotments[0]->course_id;

                        foreach($allotments as $allotment){
                            $course = Course_map::find($allotment->course_code);
                            $staff = Faculty::find($allotment->e_id);
                            $allotment->course_name = $course->course_name;
                            $allotment->first_name = $staff->first_name;
                            $allotment->last_name = $staff->last_name;

                            // return $allotment;
                        }

                        if(count($allotments) >0){
                            return view('faculty.pages.load_generate')->with('allotments', $allotments);
                        }

                        return redirect('/staff/generate/load')->with('error', 'Term staff not alloted yet');
                        
                    }
                    else{
                        return view('faculty.pages.load_generate');
                    }
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function matchFaculty(Request $request){
        if(session('e_id')){
            foreach(session('roles') as $role){
                if($role == 4 || $role == 9 || $role == 8 || $role == 0){
                    $term = $request->term;

                    $match = Faculty::where('e_id','=',$term)
                    ->orWhere('short_form','=',$term)
                    ->orWhere('first_name','=',$term)
                    ->orWhere('last_name','=',$term)
                    ->first();
                    return response()->json($match);
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
        

    }

    public function submitCourse(Request $request){

        if(session('e_id')){
            foreach(session('roles') as $role){
                if($role == 9){
                    // Get courses and div from pervious form
                    $courses = $request->session()->get('courses');
                    $div = $request->session()->get('div');
                    

                    foreach($courses as $course){
                        if($course->th_hrs > 0){
                            for($i=0; $i < $course->th_hrs; $i++){
                                $inputfield = "hth_".str_replace(' ', '', $course->course_code);
                                
                                $e_id = intval($request->input($inputfield));
                                // return $e_id;

                                $assign = new SubjectAllotment;

                                $assign->term_id = $course->term_id;
                                $assign->course_code = $course->course_code;
                                $assign->division = chr($div+64);
                                $assign->contact_head = 'TH';
                                $assign->contact_head_hours = 1;
                                $assign->e_id = $e_id;

                                $previous = SubjectAllotment::where('term_id','=',$assign->term_id)
                                ->where('course_code','=',$assign->course_code)
                                ->where('division','=',$assign->division)
                                ->where('contact_head','=',$assign->contact_head)
                                ->where('e_id','=',$assign->e_id);

                                $previousData = $previous->get();

                                //return $previousData;

                                if(count($previousData) > 0){
                                    $contact_hours = intval($previousData[0]->contact_head_hours)+1;
                                    $s_id = $previous->get()->first()->sub_allotment_id;
                                    $sub = SubjectAllotment::find($s_id);
                                    $sub->contact_head_hours = $contact_hours;
                                    $sub->save();
                                }
                                else{
                                    $assign->save();
                                }
                            }
                        }

                        if($course->pr_hrs > 0){
                            for($i=0; $i < $course->pr_hrs; $i++){
                                $batches = array_map('intval', explode(',',$course->pr_batches));
                                $batchCount = $batches[$div-1];
                                for($j=0; $j<$batchCount; $j++){
                                    $inputfield = "hph_".str_replace(' ', '', $course->course_code).'_'.chr($j+65);
                                    
                                    $e_id = intval($request->input($inputfield));
                                    // return $e_id;

                                    $assign = new SubjectAllotment;

                                    $assign->term_id = $course->term_id;
                                    $assign->course_code = str_replace(' ', '', $course->course_code);
                                    $assign->division = chr($div+64);
                                    $assign->contact_head = 'PR'.'-'.chr($j+65);
                                    $assign->contact_head_hours = 1;
                                    $assign->e_id = $e_id;

                                    $previous = SubjectAllotment::where('term_id','=',$assign->term_id)
                                    ->where('course_code','=',$assign->course_code)
                                    ->where('division','=',$assign->division)
                                    ->where('contact_head','=',$assign->contact_head)
                                    ->where('e_id','=',$assign->e_id);

                                    $previousData = $previous->get();

                                    //return $previousData;

                                    if(count($previousData) > 0){
                                        $contact_hours = intval($previousData[0]->contact_head_hours)+1;
                                        $s_id = $previous->get()->first()->sub_allotment_id;
                                        $sub = SubjectAllotment::find($s_id);
                                        $sub->contact_head_hours = $contact_hours;
                                        $sub->save();
                                    }
                                    else{
                                        $assign->save();
                                    } 
                                }
                            }
                        }

                        if($course->tut_hrs > 0){
                            for($i=0; $i < $course->tut_hrs; $i++){
                                $batches = array_map('intval', explode(',',$course->tut_batches));
                                $batchCount = $batches[$div-1];
                                for($j=0; $j<$batchCount; $j++){
                                    $inputfield = "huh_".str_replace(' ', '', $course->course_code).'_'.chr($j+65);
                                    
                                    $e_id = intval($request->input($inputfield));
                                    // return $e_id;

                                    $assign = new SubjectAllotment;

                                    $assign->term_id = $course->term_id;
                                    $assign->course_code = str_replace(' ', '', $course->course_code);
                                    $assign->division = chr($div+64);
                                    if($batchCount > 1){
                                        $assign->contact_head = 'TUT'.'-'.chr($j+65);
                                    }
                                    else{
                                        $assign->contact_head = 'TUT';
                                    }
                                    $assign->contact_head_hours = 1;
                                    $assign->e_id = $e_id;

                                    $assign->save();
                                }
                            }
                        }
                    }

                    $request->session()->forget('courses');
                    $request->session()->forget('div');
                    return redirect('staff/course/assign/')->with('success','Staff alotted Successfully');
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
            
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
        
        

    }

    public function assignCTCC() {
        if(session('e_id')){
            foreach(session('roles') as $role){
                if($role == 8)
                {
                    $path = URL::to('json/CourseConfig.json');
                    $json = json_decode(file_get_contents($path), true);
                    $date = date("Y/m/d");
                    foreach($json['term_span_details'] as $term)
                    {
                        if(strtotime($date) >= strtotime($term['start_date']) && strtotime($date) <= strtotime($term['end_date']))
                        {
                            $sem = $term['semester'];
                        }
                    }
                    $terms = Term::where("academic_year","=",date("Y"))->get();
                    $term_array = array();
                    
                    //return $terms;
                    if($sem == "odd")
                    {
                        foreach($terms as $term)
                        {
                            if(((int)$term->semester) % 2 == 1)
                            {
                                array_push($term_array,$term);
                            }
                        }
                        //return $term_array;
                    }
                    else if($sem == "even")
                    {
                        foreach($terms as $term)
                        {
                            if(((int)$term->semester) % 2 == 0)
                            {
                                array_push($term_array,$term);
                            }
                        }
                        //return $term_array;
                    }
                    else
                    {
                        return "error";
                        return redirect('faculty.pages.assignClassTeachers')->with('error','Some Error Occurred regarding Even/Odd Semester');
                    }
                    

                    //assign number of divisions to a particular term
                    $division_array = array();
                    foreach($term_array as $term)
                    {
                        $div = Course_map::where("term_id","=",$term['term_id'])->first();
                        $divisions = substr_count($div['tut_batches'],',') +1;
                        //return $divisions;
                        array_push($division_array,$divisions);
                    }

                    $term_ids = array();
                    foreach($term_array as $term)
                    {
                        array_push($term_ids,$term->term_id);
                    }
                    
                    $term_data = array_combine($term_ids,$division_array);
                    //return $term_data;
                    session(['term_data' => $term_data]);
                    return view('faculty.pages.assignClassTeachers')->with('json',$json)
                                                                    ->with('division_array',$division_array)
                                                                    ->with('term_data',$term_data);
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function addCTCC(Request $request){
        if(session('e_id')){
            foreach(session('roles') as $role)
            {
                if($role == 8)
                {
                    $test = array();
                    foreach(session('term_data') as $term => $num_of_div)
                    {
                        for($i=0;$i<$num_of_div;$i++)
                        {
                            $eid_ct = $request->input("ct_".$term."_".chr($i + 65));
                            $eid_cc = $request->input("cc_".$term."_".chr($i + 65));
                            
                            //insert into table
                            $ctcc = new CtCC;
                            $ctcc->term_id = $term;
                            $ctcc->class = chr($i + 65);
                            $ctcc->class_teacher_eid = $eid_ct;
                            $ctcc->class_counsellor_eid = $eid_cc;
                            $ctcc->save();
                            //array_push($test,$name);
                        }
                    }
                    $request->session()->forget('term_data');
                    return redirect()->back()->with('success','Class Teachers and Counsellors added');
                }
            }
            return redirect()->back()->with('error','Unauthorised Access');
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    public function excel() {
    
        $staff_data= Faculty::all(['e_id','first_name','last_name','short_form','department_id','designation','email','mobile','landline','Expertise']);
        $staff_data_array = [];
        $staff_data_array[] = ['e_id','Name','Last Name','Short Form','Department Id','Designation','Email','Mobile','LandLine','Expertise'];
        foreach ($staff_data as $data)
        {
            $staff_data_array[] = $data->toArray();
        }
        $this->globals =  $staff_data_array;

        Excel::create('staff', function($excel) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Staff Data');
            $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
            $excel->setDescription('staff details');
            $staff_data_array = $this->globals;
            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($staff_data_array) {
                $sheet->fromArray($staff_data_array, null, 'A1', false, false);
            });

        })->download('csv');

 
    }

    
    public function report_rid_13() {
        return view('faculty.pages.report_rid_13');
    }

    public function generate_list_with_doj(Request $request) {
        $this -> validate($request, [
            'year_doj' =>'required'
        ]);
        //return $request -> input('year_doj');
        //$selected_year = $request -> input('year');  
        $current_year= date('Y');
        $year_diff=$current_year - $request -> input('year_doj');
        $data = Faculty::whereYear('doj','>',$year_diff)
                        ->where('type','=','1')
                        ->get(['e_id','doj','first_name','last_name']); 
         
        return view('faculty.pages.report_rid_13')->with('data',$data); 
    }

}

?>