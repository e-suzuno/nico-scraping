@extends('layouts/app') @section('content')


    <div class="card">
        <div class="card-body">

            <p>■当サイトの目的</p>
            <p>
                <a href="https://seiga.nicovideo.jp/manga/">ニコニコ静画(マンガ)</a>の検索機能が個人的にあまりつかいやすさを感じないため<br>
                自分と相性のいいユーザー漫画を探し出すために、主に個人的な理由で作成。
            </p>


            <p>■何やってるの？</p>
            <p>
                ニコニコ静画にスクレイピングしにいってます。<br>
                スクレイピングでががーってアクセスしにいってるので、ふざけんなーって怒られてアク禁くらったらやばいかもしれない
            </p>

            <p>■漫画のサムネはないの？</p>
            <p>
                ・画像は重いし保存するのは容量がヤバイ<br>
                ・ただでさえスクレイピングによるアクセスでちょっと危ないかもしれないのに、画像まで取ってくるのは著作権的に危険が危ない<br>
                ・直リンはマナー的にも微妙<br>
                良さそうなタイトル見つけたら本家に飛ぶんだ！
            </p>

            <p>■緑色のタグって何？</p>
            <p>
                文章に特定のワードが入ってると強制的にタグ付けされます。<br>
                エロはないです　って説明とかでも『エロ』ってタグが付きます
            </p>


            <p>■新しい番号の奴検索にひっかからんの？</p>
            <p>
                後ろでクーロン動いてるけどそんなしょっちゅう動いてないよ<br>
                {{ app(\App\Repositories\NicoComic\NicoComicRepositoryInterface::class)->getMaxNicoNo() }} 番号まで取得してるよ
            </p>

            <p>■独り言</p>
            <p>
                （拾ってくるのユーザー漫画だけでよくね？　公式だと掲載数）<br>
                （）<br>
            </p>
        </div>
    </div>

@stop

@section('scripts')
    @parent
    <script>
        'use strict'
    </script>
@endsection
