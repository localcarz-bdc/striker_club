<p>Name :  {{ $membership->fname}} {{ $membership->lname}}</p>
<p>Date of Birth : {{ \Carbon\Carbon::parse($membership->dob)->format('M d, Y').' ('.$membership->age.')' }}</p>
<p>Address : {{ $membership->address}} {{ $membership->city}} {{ $membership->state}} {{ $membership->state}}</p>
<p>Telephone : {{ $membership->telephone}}</p>
<p>Father Name : {{ $membership->membershipInfo[0]['father_name']}}</p>
<p>Mother Name : {{ $membership->membershipInfo[0]['mother_name']}}</p>
<p>High School Attended and Year of Graduation : {{ $membership->membershipInfo[0]['attend_or_graduate']}}</p>
<p>College/University Currently Attending : {{ $membership->membershipInfo[0]['attending_college_now']}}</p>
<p>Major, Minor, and Current GPA  : {{ $membership->membershipInfo[0]['current_gpa']}}</p>
<p>Why do you wish to become a Debutante (or Escort)? : {{ $membership->membershipInfo[0]['why_debutante']}}</p>
<p>Do you have an Escort (or Debutante)? If yes, please list his/her name, address, and college/university : {{ $membership->membershipInfo[0]['have_escort_details']}}</p>
<p>What is your philosophy of life? : {{ $membership->membershipInfo[0]['philosophy_of_life']}}</p>
<p>How did you learn about the Debutante/Escort program? : {{ $membership->membershipInfo[0]['how_learn_debutante_program']}}</p>
<p>If you were given an opportunity to plan a project, which category would it be? : {{ $membership->membershipInfo[0]['program_category']}}</p>
<p>Name of Striker/Strikerette who knows of your character and will recommend you. : {{ $membership->membershipInfo[0]['name_of_striker']}}</p>
<p>Electronic Signature and Date * (Type your name and add the date in the format mm/dd/yyy) : {{ $membership->membershipInfo[0]['signature_name_date']}}</p>
<p>Status : @if($membership->is_approve == 0) Inactive @else Active @endif</p>
<p>Email : {{ $membership->email}}</p>


