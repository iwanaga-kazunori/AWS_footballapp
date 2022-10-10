@extends('layouts.base')
@section('content_news')
<header class="py-4" style="z-index:-9999;">
{{-- 画面上部に表示するナビゲーションバーです。 --}}
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->nickname }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
            {{-- ここまでナビゲーションバー --}}
    <div>
<slick ref="slick" :options="slickNavOptions" class="slider-nav">
      <div style="">マイページ</div>
      <div style="">新着情報</div>
      <div style="">試合結果・日程</div>
      <div style="">SNSまとめ</div>
    </slick>
    </div>
    <modal name="hello-world" :draggable="true" :resizable="true">
    <div class="modal-header">
      <h2>Modal title</h2>
    </div>
    <div class="modal-body">
      <p>you're reading this text in a modal!</p>
      <button v-on:click="hide">閉じる</button>
    </div>  
  </modal>
</header>
<main class="py-4" style="z-index:9999;">
                <slick ref="slick" :options="slickOptions" class="slider-for">
                    <div style="height:400px; background: blue;">マイページ</div>
                    <div style="">

    
<div class="container-lg d-flex justify-content-around flex-wrap" style="">
@foreach($rss_contents as $value)
  <div class="w-50 p-3" style="">
    <h2 style="font-size:1em;height:2em"><a href="{{$value['link']}}">{{$value['title']}}</a></h2>
    <div style="width:45%;float:left;pading:5%;">
      <img src="{!!$value['img_path']!!}">
    </div>
    <div style="width:50%;float:right;">
      <p style="font-size:0.9em;">{!!$value['description']!!}&hellip;</p>
      <p style="font-size:0.9em;">{{$value['team']}}</p>
      <p style="font-size:0.8em;">{{$value['date']}}</p>
      
    </div>
  <br><br><br>
  </div>
  
@endforeach
</div>

  
<news-component></news-component>
    

</div>
                    <div style="height:700px; background: red;">@yield('content_result')</div>
                    <div style="height:400px; background: green;">@yield('content_sns')</div>
                </slick>
            </main>
@endsection

@extends('layouts.footer')
<style>
  img {
    width: 100% !important;
    height: auto !important;
  }
</style>