@extends('layouts.app')
 @section('title','Available Courses') 
 @section('content')
<div class="heading">
    <div>
        <h1>Available Courses</h1>
    <div class="muted">Choose a course to register. Duplicate registrations are prevented.</div></div><a class="btn light" href="{{ route('my-registrations') }}">My registrations</a></div>
<div class="card"><div class="table-wrap"><table><tr><th>Code</th><th>Course</th><th>Units</th><th>Description</th><th>Action</th></tr>
@forelse($courses as $course)<tr><td>{{ $course->course_code }}</td><td>{{ $course->course_name }}</td><td>{{ $course->credit_units }}</td><td>{{ $course->description ?: '—' }}</td><td><form method="POST" action="{{ route('my-registrations.store') }}">@csrf<input type="hidden" name="course_id" value="{{ $course->id }}"><button class="btn gold">Register</button></form></td></tr>@empty<tr><td colspan="5">No available courses found.</td></tr>@endforelse</table></div><div class="pagination">{{ $courses->links() }}</div></div>
@endsection
