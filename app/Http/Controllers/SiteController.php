<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Member;
use App\Traits\Notify;
use App\Models\Contact;
// use App\Traits\Notify\Notify;
use App\Models\Gallery;
use App\Mail\VerifyEmail;
use App\Mail\ContactEmail;
use App\Models\HeroSlider;
use App\Models\Membership;
use App\Models\Designation;
use App\Mail\PasswordForget;
use Illuminate\Http\Request;
use App\Models\MembershipInfo;
use Illuminate\Support\Carbon;
use App\Mail\DebutantApplication;
use App\Events\MailSendIndividual;
use App\Models\DebutanteMembership;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\DebutanteMembershipInfo;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class SiteController extends Controller
{
    use Notify;
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $sliders = HeroSlider::where('status',1)->orderByDesc('id')->get();
        return view('website.home', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function contact()
    {
        return view('website.contact');
    }

    public function contactStore(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'reCaptcha' => 'required',
            // 'reCaptcha' => 'required|captcha',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'subject' => 'required',
        //     'message' => 'required',
        //     // 'reCaptcha' => 'required|captcha',
        // ]);

//         $reCaptcha = $request->input('reCaptcha');
// // dd($reCaptcha);
//         $validator = validator([
//             'reCaptcha' => $reCaptcha,
//         ], [
//             'reCaptcha' => 'required',
//         ]);

//         // if ($validator->fails() || !GoogleReCaptcha::verify($reCaptcha)) {
//         if ($validator->fails() || $reCaptcha != null) {
//             return response()->json(['errors' => ['reCaptcha' => ['The reCAPTCHA verification failed.']]], 422);
//         }
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        $eventMailData =[
            'name'=> $request->name,
            'email'=> $request->email,
            // 'id'=> 31,
            // 'password'=> 12345678,
        ];

        event(new MailSendIndividual($eventMailData));

        // Mail::to($request->email)->send(new ContactEmail($eventMailData));

        $notification_title = 'Contact Message Recieved';
        $notification_message = $request->subject;
        $notification_admin_call_back_url = 'admin.contact.index';
        $notification_member__call_back_url = null;
        $notificatioN_auth_id = -1;
        $notification_category = 'contact-message';
        $notificationId = $this->saveNewNotification( $notification_title, $notification_message, $notification_admin_call_back_url,$notification_member__call_back_url, $notificatioN_auth_id,$notification_category);

        return response()->json(['success' => 'Contact added successfully']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function about()
    {
        return view('website.about');
    }

    /**
     * Display the specified resource.
     */
    public function debutanteProgram()
    {
        return view('website.debutante_program');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function boardMembers()
    {
        // $members = User::whereNotIn('designation',['Admin','Developer'])->where('status',1)->orderByDesc('id')->get();
        $promotedMembers = User::where('designation','!=','member')->where('status',1)->orderBy('id')->get();
        $designations = Designation::pluck('name');
        return view('website.board_members', compact('promotedMembers','designations'));
    }
    public function members()
    {
        $members = User::whereNotIn('designation', ['Developer'])
        ->whereNotIn('name', ['Super Admin','Marif Akter'])
        ->where('status', 1)
        ->orderByDesc('id')
        ->orderByRaw("SUBSTRING_INDEX(SUBSTRING_INDEX(name, ',', -1), ' ', -1) ASC") // Order by last name in ascending order
        ->get();
        // dd('kashdasdjk');
        return view('website.members', compact('members'));
    }


    public function debutanteApplication()
    {
        return view('website.debutante_application');
    }

    public function debutanteApplicationStore(request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:debutante_memberships,email',
            'confirm_email' => 'required|email|same:email',
            // 'confirm_email' => 'required|email',
            'father' => 'required',
            'mother' => 'required',
            'hschool_graduation' => 'required',
            'college_university' => 'required',
            'cgpa' => 'required|numeric',
            'why_debutant' => 'required',
            'is_debutant' => 'required',
            'is_philosophy' => 'required',
            'is_learn_debutant' => 'required',
            'striker_category' => 'required',
            'name_of_striker' => 'required',
            'signature_date' => 'required',
            'name_of_striker' => 'required',
            'reCaptcha' => 'required',
            // 'reCaptcha' => 'required|captcha',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $birthdate = Carbon::parse($request->dob);
        $age = $birthdate->diffInYears(Carbon::now());

        $member_data = new DebutanteMembership();
        $member_data->fname = $request->fname;
        $member_data->lname = $request->lname;
        $member_data->dob = $request->dob;
        $member_data->age = $age;
        $member_data->address = $request->address;
        $member_data->city = $request->city;
        $member_data->state = $request->state;
        $member_data->zip = $request->zip;
        $member_data->telephone = $request->telephone;
        $member_data->email = $request->email;
        $member_data->is_approve = 0;
        $member_data->is_read = 0;
        $member_data->save();

        $membership_info_data =new DebutanteMembershipInfo();
        $membership_info_data->debutante_membership_id = $member_data->id;
        $membership_info_data->father_name = $request->father;
        $membership_info_data->mother_name = $request->mother;
        $membership_info_data->attend_or_graduate = $request->hschool_graduation;
        $membership_info_data->attending_college_now = $request->college_university;
        $membership_info_data->current_gpa = $request->cgpa;
        $membership_info_data->why_debutante = $request->why_debutant;
        $membership_info_data->have_escort_details = $request->is_debutant;
        $membership_info_data->philosophy_of_life = $request->is_philosophy;
        $membership_info_data->how_learn_debutante_program = $request->is_learn_debutant;
        $membership_info_data->program_category = $request->striker_category;
        $membership_info_data->name_of_striker = $request->name_of_striker;
        $membership_info_data->signature_name_date = $request->signature_date;
        $membership_info_data->save();

        $data =[
            'name'=> $request->fname,
            // 'id'=> 31,
            // 'password'=> 12345678,
        ];
        Mail::to($request->email)->send(new DebutantApplication($data));

        $notification_title = 'Member Applicant Recieved';
        $notification_message = $request->email;
        $notification_admin_call_back_url = 'admin.debutante.index';
        $notification_member__call_back_url = null;
        $notificatioN_auth_id = -1;
        $notification_category = 'Debutante-application';
        $notificationId = $this->saveNewNotification( $notification_title, $notification_message, $notification_admin_call_back_url,$notification_member__call_back_url, $notificatioN_auth_id,$notification_category);

        return response()->json(['success' => 'Debutante added successfully']);
    }

    public function memberApplication()
    {
        return view('website.member_application');
    }

    public function memberApplicationStore(request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:debutante_memberships,email',
            'confirm_email' => 'required|email|same:email',
            // 'confirm_email' => 'required|email',
            'marital' => 'required',
            'spouse' => 'required',
            'spouse_dob' => 'required',
            'educational_background' => 'required',
            'occupation' => 'required',
            'religious_affiliation' => 'required',
            'hobbies' => 'required',
            'other_affiliations' => 'required',
            'why_desire' => 'required',
            // 'striker_category' => 'required',
            'signature_date' => 'required',
            'name_of_striker' => 'required',
            'reCaptcha' => 'required',
            // 'reCaptcha' => 'required|captcha',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $birthdate = Carbon::parse($request->dob);
        $age = $birthdate->diffInYears(Carbon::now());

        $member_data = new Member();
        $member_data->fname = $request->fname;
        $member_data->lname = $request->lname;
        $member_data->dob = $request->dob;
        $member_data->age = $age;
        $member_data->address = $request->address;
        $member_data->city = $request->city;
        $member_data->state = $request->state;
        $member_data->zip = $request->zip;
        $member_data->telephone = $request->telephone;
        $member_data->email = $request->email;
        $member_data->balance = $request->balance;
        $member_data->marital = $request->marital;
        $member_data->spouse = $request->spouse;
        $member_data->spouse_dob = $request->spouse_dob;
        $member_data->educational_background = $request->educational_background;
        $member_data->occupation = $request->occupation;
        $member_data->religious_affiliation = $request->religious_affiliation;
        $member_data->hobbies = $request->hobbies;
        $member_data->other_affiliations = $request->other_affiliations;
        $member_data->why_desire = $request->why_desire;
        $member_data->name_of_striker = $request->name_of_striker;
        $member_data->signature_date = $request->signature_date;
        $member_data->is_approve = 0;
        $member_data->is_read = 0;
        $member_data->save();

        // return response()->json(['success' => 'Member added successfully']);
        $data =[
            'name'=> $request->fname. ' '.$request->lname,
            // 'id'=> 31,
            // 'password'=> 12345678,
        ];
        Mail::to($request->email)->send(new DebutantApplication($data));

        $notification_title = 'Member Applicant Recieved';
        $notification_message = $request->email;
        $notification_admin_call_back_url = 'admin.member.index';
        $notification_member__call_back_url = null;
        $notificatioN_auth_id = -1;
        $notification_category = 'member-application';
        $notificationId = $this->saveNewNotification( $notification_title, $notification_message, $notification_admin_call_back_url,$notification_member__call_back_url, $notificatioN_auth_id,$notification_category);

        return response()->json(['success' => 'Member added successfully']);
    }

    /**
     * `, `father_name`, `moher_name`, `attend_or_graduate`, `attending_college_now`, `current_gpa`, `why_debutante`, `have_escort_details`, `philosophy_of_life`, `how_learn_debutante_program`, `program_category`, `signature_name_date
     * Update the specified resource in storage.
     */
    public function deceasedMember()
    {
        return view('website.deceased_member');
    }

    public function gallery()
    {
        $galleries = Gallery::orderBy('id')->get();
        return view('website.gallery', compact('galleries'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function eventCalendar(Request $request)
    {

        if($request->ajax()) {

             $data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);

             return response()->json($data);
        }

        return view('website.event_fullcalender');
    }

    public function noAuthEventCalendar(Request $request)
    {

        if($request->ajax()) {

             $data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);

             return response()->json($data);
        }

        return view('website.noAuth_event_fullcalender');
    }

    public function event_fullcalenderAjax(Request $request)
    {
        switch ($request->type) {
           case 'add':
              $event = Event::create([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($event);
             break;

           case 'update':
              $event = Event::find($request->id)->update([
                  'title' => $request->title,
                  'start' => $request->start,
                  'end' => $request->end,
              ]);

              return response()->json($event);
             break;

           case 'delete':
              $event = Event::find($request->id)->delete();

              return response()->json($event);
             break;

           default:
             # code...
             break;
        }
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
        ]);

        if($validator->fails())
        {
            return response()->json(['error' =>$validator->errors()]);

        }

        $check_user = User::where('email',$request->email)->first();
        // dd($request->all(), $check_user);
        if($check_user)
        {
            $check_user->password_reset_otp = rand(1234,999999);
            $check_user->save();
            Session::put('email', $request->email);
            $data = [
                'name' => $check_user->name,
                'email' => $check_user->email,
                'otp' =>  $check_user->password_reset_otp,
            ];
            Mail::to($data['email'])->send(new PasswordForget($data));
           return response()->json(['success' => 'OTP sent successfully! check e-mail']);

        }else
        {
            return response()->json(['error'=>'user not found']);
        }


    }


    public function checkOtp(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'otp'=>'required',
            'password' =>'required|min:6',
            'confirm_password' =>'required|same:password'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors());
        }
        $user = User::where('email', Session::get('email'))->first();
        if($request->otp != $user->password_reset_otp)
        {
            return response()->json(['error'=>'your otp is invalid']);

        }else
        {
            $user->password = Hash::make($request->password);
            $user->password_reset_otp = null;
            $user->save();
            return response()->json(['message'=>'Reset Password Successfully.Please LogIn']);

        }

    }

    public function MensHealth2025()
    {
        return view('website.Mens-Health-2025');
    }


}
