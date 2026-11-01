<!doctype html>
<html lang="en">
    <head><meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"><title>Login | Student Management</title>
<style>body{margin:0;background:#f2f5fa;font-family:Arial;color:#182230;min-height:100vh;display:grid;place-items:center}.box{background:white;padding:35px;border-radius:15px;width:min(420px,92vw);box-shadow:0 15px 50px #14213d16}h1{margin:0 0 8px;color:#14213d}.sub{color:#657084;margin-bottom:25px}label{display:block;font-weight:bold;margin:15px 0 7px}input{width:100%;padding:12px;border:1px solid #ccd4e1;border-radius:7px;box-sizing:border-box}.btn{width:100%;margin-top:20px;padding:12px;border:0;border-radius:7px;background:#14213d;color:white;font-weight:bold;cursor:pointer}.gold{color:#fca311}.err{background:#fff0ef;color:#a32218;padding:10px;border-radius:7px}</style></head><body><div class="box"><h1>MUBS <span class="gold">Student Portal</span></h1><p class="sub">Sign in to continue to the management system.</p>
@if(session('success'))<p>{{ session('success') }}</p>@endif @if($errors->any())<div class="err">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ route('login.store') }}">@csrf<label>Email address</label><input type="email" name="email" value="{{ old('email') }}" required autofocus><label>Password</label><input type="password" name="password" required><button class="btn">Sign in</button></form>
</div></body></html>
