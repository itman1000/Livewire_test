<x-loginlayout>
    <div class="h-auto w-screen m-10">
        <h2 class="mt-5 mb-5 text-xl font-bold">{{ \Carbon\Carbon::now('Asia/Tokyo')->format('Y年m月d日') }}</h2>
        @php
            $hour = \Carbon\Carbon::now('Asia/Tokyo')->hour;
            $greeting = '';

            if ($hour >= 5 && $hour < 11) {
                $greeting = 'おはようございます！';
            } elseif ($hour >= 11 && $hour < 19) {
                $greeting = 'こんにちは！';
            } else {
                $greeting = 'こんばんは！';
            }
        @endphp

        <p class="mb-2 text-lg">{{ $user->name }}さん、{{ $greeting }}</p>
        <p class="mb-10 text-lg">{{ $randomGreeting }}</p>

        <div class="mt-5">
            <h3 class="text-lg font-semibold mb-4">レストラン一覧</h3>
            <ul class="space-y-4">
                @foreach($restaurants as $restaurant)
                    <li class="border p-4 rounded-md">
                        <h4 class="text-lg font-medium">{{ $restaurant['name'] }}</h4>
                        <p class="text-sm text-gray-600">{{ $restaurant['address'] }}</p>
                        <p class="text-sm md-2">{{ $restaurant['genre']['name'] }}</p>
                        <a href="{{ $restaurant['urls']['pc'] }}" target="_blank" rel="noopener noreferrer"  class="text-blue-500 mt-2 inline-block">詳細を見る</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-10">
            <a href="http://webservice.recruit.co.jp/"><img src="http://webservice.recruit.co.jp/banner/hotpepper-m.gif" alt="ホットペッパー Webサービス" width="88" height="35" border="0" title="ホットペッパー Webサービス"></a>
        </div>
    </div>

</x-loginlayout>
