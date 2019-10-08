@extends('layouts/app') @section('content')



    <div class="card">
        <div class="card-header">
            除外リスト
        </div>
        <div class="card-body">
            <p>
                現在の合計除外リスト： @{{ exclusionList.length }}件
            </p>
            <button class="btn btn-danger" @click="remove()">除外リストをクリアする</button>
        </div>
    </div>
@stop


@section('scripts')
    @parent
    <script>
        'use strict';


        var local = new Vue({
            components: {},
            el: '#app',
            data: {
                'exclusionList': exclusionStore.getExclusionList(),
            },
            created: function () {
                this.$nextTick(function () {
                })
            },
            computed: {},
            methods: {
                remove() {
                    if (confirm("除外リストをクリアしますか？") === true) {
                        exclusionStore.remove();
                        this.exclusionList = exclusionStore.getExclusionList();
                        alert("除外リストをクリアしました。");
                    }
                },

            }
        });


    </script>
@endsection
