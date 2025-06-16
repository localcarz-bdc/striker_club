<p>Name :  {{ $membership->fname}} {{ $membership->lname}}</p>
<p>Date of Birth : {{ \Carbon\Carbon::parse($membership->dob)->format('M d, Y').' ('.$membership->age.')' }}</p>
<p>Address : {{ $membership->address}} {{ $membership->city}} {{ $membership->state}} {{ $membership->zip}}</p>
<p>Telephone : {{ $membership->telephone}}</p>
<p>Email : {{ $membership->email}}</p>
<p>Marital Status : {{ $membership->marital}}</p>
<p>Spouse Name : {{ $membership->spouse}}</p>
<p>Spouse Date of Birth : {{ $membership->spouse_dob}}</p>
<p>Educational Background : {{ $membership->educational_background}}</p>
<p>Occupation : {{ $membership->occupation}}</p>
<p>Religious Affiliation : {{ $membership->religious_affiliation}}</p>
<p>Hobbies, Interests : {{ $membership->hobbies}}</p>
<p>Other Affiliation : {{ $membership->other_affiliations}}</p>
<p>Why do you desire to become a member of the Strikers Club Inc  : </p>
<textarea name="" id="" cols="30" rows="3" class="form-control" disabled>{{ $membership->why_desire}}</textarea>
<p>Name of Striker who knows of your character and will recommend you. : {{ $membership->name_of_striker}}</p>
<p>Signature & Date  : {{ $membership->signature_date}}</p>
<p>Status : @if($membership->is_approve == 0) Inactive @else Active @endif</p>


