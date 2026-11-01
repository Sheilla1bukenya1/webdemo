<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title','Student Management System')</title>
<style>
:root{--navy:#14213d;--gold:#fca311;--bg:#f4f6fb;--ink:#182230;--muted:#657084;--line:#e3e8f0}
*{box-sizing:border-box}body{margin:0;font-family:Arial,Helvetica,sans-serif;background:var(--bg);color:var(--ink)}
.top{background:var(--navy);color:white;padding:17px 5%;display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap}
.brand{font-weight:800;font-size:19px}.brand span{color:var(--gold)}nav{display:flex;gap:14px;flex-wrap:wrap;align-items:center}nav a{color:white;text-decoration:none;font-size:14px}nav a:hover{color:var(--gold)}
.wrap{max-width:1150px;margin:30px auto;padding:0 18px}.heading{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:22px}h1{font-size:28px;margin:0 0 6px}h2{font-size:19px}.muted{color:var(--muted)}.card{background:white;border:1px solid var(--line);border-radius:13px;padding:22px;margin-bottom:20px;box-shadow:0 4px 18px #15213d08}
.btn{display:inline-block;border:0;border-radius:7px;padding:10px 14px;background:var(--navy);color:white;text-decoration:none;cursor:pointer;font-size:14px}.btn.gold{background:var(--gold);color:#14213d;font-weight:700}.btn.red{background:#b42318}.btn.light{background:#e9edf5;color:var(--navy)}
table{width:100%;border-collapse:collapse;background:white}th,td{text-align:left;padding:13px 12px;border-bottom:1px solid var(--line);font-size:14px}th{background:#f7f8fb;color:#3b4658}tr:last-child td{border-bottom:0}.table-wrap{overflow-x:auto}
label{display:block;font-weight:700;margin:14px 0 7px;font-size:14px}input,select,textarea{width:100%;padding:11px;border:1px solid #cfd6e2;border-radius:7px;background:white;font:inherit}textarea{min-height:95px}.form-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:0 18px}.full{grid-column:1/-1}.alert{padding:12px 15px;border-radius:8px;margin-bottom:16px}.success{background:#e6f7ed;color:#146c3e}.error{background:#fff0ef;color:#a32218}.stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px}.stat strong{font-size:30px;display:block;color:var(--navy);margin-top:8px}.actions{display:flex;gap:7px;flex-wrap:wrap}.pagination{margin-top:16px}.footer{text-align:center;color:var(--muted);padding:25px;font-size:13px}
@media(max-width:650px){.form-grid{grid-template-columns:1fr}.full{grid-column:auto}.wrap{margin-top:20px}h1{font-size:24px}}
</style>
</head><body>
<header class="top"><div class="brand">MUBS <span>Student Management</span></div>
<nav>
<a href="{{ route('dashboard') }}">Dashboard</a>
@if(auth()->user()->role==='admin')<a href="{{ route('students.index') }}">Students</a>@endif
<a href="{{ route('courses.index') }}">Courses</a>
@if(auth()->user()->role==='student')
<a href="{{ route('available-courses') }}">Available Courses</a><a href="{{ route('my-registrations') }}">My Registrations</a>
@else
<a href="{{ route('registrations.index') }}">Registrations</a>
@endif
<span>{{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})</span>
<form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button class="btn gold" type="submit">Logout</button></form>
</nav></header>
<main class="wrap">
@if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif
@if($errors->any())<div class="alert error"><strong>Please correct the following:</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
@yield('content')
</main><footer class="footer">MUBS Student Management System · AWAD Coursework Two</footer>
</body></html>
