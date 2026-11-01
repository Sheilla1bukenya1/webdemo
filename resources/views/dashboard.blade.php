@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="heading"><div><h1>Dashboard</h1><div class="muted">Welcome, {{ auth()->user()->name }}. Here is your overview.</div></div></div>
@if(auth()->user()->role==='admin')
<div class="stats"><div class="card stat">Registered students<strong>{{ $studentCount }}</strong></div><div class="card stat">Available courses<strong>{{ $courseCount }}</strong></div><div class="card stat">Course registrations<strong>{{ $registrationCount }}</strong></div></div>
<div class="card"><h2>Administration shortcuts</h2><div class="actions"><a class="btn gold" href="{{ route('students.create') }}">Add student</a><a class="btn" href="{{ route('courses.create') }}">Add course</a><a class="btn" href="{{ route('registrations.create') }}">Register student</a></div></div>
@elseif(auth()->user()->role==='lecturer')
<div class="card"><h2>My assigned courses</h2>@forelse($myCourses as $course)<p><strong>{{ $course->course_code }} — {{ $course->course_name }}</strong> <span class="muted">({{ $course->registrations_count }} registered students)</span></p>@empty<p class="muted">No courses are assigned to your account yet.</p>@endforelse</div>
@else
<div class="card"><h2>My recent registrations</h2>@forelse($myRegistrations as $registration)<p>{{ $registration->course->course_code }} — {{ $registration->course->course_name }} <span class="muted">· {{ $registration->registration_date->format('d M Y') }}</span></p>@empty<p class="muted">No registrations yet. Browse available courses to register.</p>@endforelse<a class="btn gold" href="{{ route('available-courses') }}">Browse courses</a></div>
@endif
@endsection
