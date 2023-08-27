<x-loginlayout>
    <div class="h-screen w-screen m-10">
        <h2 class="mt-20 mb-5">{{ \Carbon\Carbon::now()->format('Y年m月d日') }}</h2>
        <p>{{ $user->name }}さん、こんにちは！</p>
    </div>
</x-loginlayout>
