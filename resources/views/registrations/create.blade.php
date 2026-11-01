@extends('layouts.app')
 @section('title','Register a student')
  @section('content')
<div class="heading">
    <div>
        <h1>Register a student</h1>
        <div class="muted">Select a student and a course.</div>
    </div>
    <a class="btn light" href="{{ route('registrations.index') }}">Back</a>
</div>
<div class="card">
    <form method="POST" action="{{ route('registrations.store') }}">
        @csrf
        <label>Student *</label>
        <select name="student_id" required>
            <option value="">Choose student</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}" @selected(old('student_id')==$student->id)>{{ $student->student_number }} — {{ $student->first_name }} {{ $student->last_name }}</option>
            @endforeach
        </select>
        <label>Course *</label>
        <select name="course_id" required>
            <option value="">Choose course</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}" @selected(old('course_id')==$course->id)>{{ $course->course_code }} — {{ $course->course_name }}</option>
            @endforeach
        </select>
        <p>
            <button class="btn gold">Save registration</button>
        </p>
    </form>
</div>
@endsection
