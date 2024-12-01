@extends('site.layout.master')
@section('title')
    @langucw('contact us')
@endsection
{{-- @section('css') --}}
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #fff;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .contact-form {
            width: 100%; 
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .contact-form h2 {
            text-align: center;
            color: #d4a24c;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            font-size: 16px;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .contact-form textarea {
            height: 150px;
            resize: none;
        }
        .contact-form .buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        .contact-form button {
            flex: 1;
            padding: 15px;
            border: 1px solid #d4a24c;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            box-sizing: border-box;
        }
        .contact-form .submit {
            background-color: #d4a24c;
            color: #fff;
            font-weight: 700;
        }
        .contact-form .cancel {
            background-color: #fff;
            color: #d4a24c;
            font-weight: 700;
        }
        .contact-form .submit:hover {
            background-color: #c5963f;
        }
        .contact-form .cancel:hover {
            background-color: #f9f1e7;
        }
    </style>
@section('breadcrumb')
    <li><a href="{{ route('home') }}">@langucw('home')</a></li>
    <li>@langucw('contact us')</li>
@endsection
@section('content')
    <!-- Contact form section Start -->
    <div class="section-padding-03 contact-section2 contact-section2_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="contact-form">
                    <h2>@langucw('contact us')</h2>
                    <form method="POST" action="{{ route('contact_us.send') }}">
                        @csrf
                        <input type="text" name="name" placeholder="@langucw('your name')" value="{{ old('name') }}">
                        <input type="email" name="email" placeholder="@langucw('your email')" value="{{ old('email') }}">
                        <input type="text" name="phone" placeholder="@langucw('your phone')" value="{{ old('phone') }}">
                        <textarea name="message" placeholder="@langucw('your message')">{{ old('message') }}</textarea>
                        <div class="buttons">
                            <button type="submit" class="submit">@langucw('send message')</button>
                            <button type="reset" class="cancel">@langucw('cancel')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact form section End -->
@endsection
@section('scripts')
@endsection
