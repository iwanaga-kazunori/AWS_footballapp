@extends('layouts.base')
@extends('layouts.header')
@extends('layouts.menu')

@section('content_mypage')
    <div class="container">
        <hr color="#c0c0c0">
        <div class="mypage" style="">
            
            <h2 style="font-size:1.2em;border:solid 1px #ccc;padding:10px;">プロフィール</h2>
            <div class="profile" style="overflow:hidden;padding:10px;width:800px;margin:0 auto;">
                <div class="icon" style="width:250px;float:left;border:solid 1px #ccc;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="auto" fill="#ccc" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                    <form action="" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="">
                        <div class="">
                            <input type="file" class="" name="image">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="登録">
                </form>
                </div>
                
                <div class="profile" style="width:450px;float:right;padding:15px;">
                    
                    @guest
                        <div>
                            <a href="{{ route('login') }}">{{ __('Login') }}</a>
                        </div>
                        @if (Route::has('register'))
                            <div>
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            </div>
                        @endif
                    @else
                        <div>
                            <p>{{ Auth::user()->id }}</p>
                            <p>{{ Auth::user()->nickname }}</p>
                            <p>{{ Auth::user()->name }}</p>
                            <p>{{ Auth::user()->email }}</p>

                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    @endguest
                    <table>
                        <tr>
                            <th>ニックネーム：</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>メールアドレス：</th>
                            <td></td>
                        </tr>
                    </table>
                    <p>お気に入りのチーム</p>
                    <table>
                        <tr>
                            <th>１、</th>
                            <td>登録なし</td>
                        </tr>
                        <tr>
                            <th>２、</th>
                            <td>登録なし</td>
                        </tr>
                        <tr>
                            <th>３、</th>
                            <td>登録なし</td>
                        </tr>
                        <tr>
                            <th>４、</th>
                            <td>登録なし</td>
                        </tr>
                        <tr>
                            <th>５、</th>
                            <td>登録なし</td>
                        </tr>
                    </table>
                </div>
            </div>
                <div class="mypost" style="clear:both;">
                    <h2 style="font-size:1.2em;border:solid 1px #ccc;padding:10px;">投稿</h2>
                    <div style="padding:10px;margin:50px 0px 70px 0px;text-align:center;">現在投稿はありません</div>
                </div>
                <div class="favorite" style="clear:both;">
                    <h2 style="font-size:1.2em;border:solid 1px #ccc;padding:10px;">お気に入りチームの新着情報</h2>
                    <div style="padding:10px;margin:50px 0px 70px 0px;text-align:center;">お気に入りチームが登録されていません</div>
                </div>
            
        </div>
    </div>

@endsection

@extends('layouts.footer')