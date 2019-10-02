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
                ・ただでさえスクレイピングによるアクセスでちょっと危ないかもしれないのに、画像まで取ってくるのは著作権的に危険が危ない
                ・直リンはマナー的にアウト
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
