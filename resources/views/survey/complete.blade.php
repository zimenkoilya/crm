@include("../components/head")
<body>
    <!-- スマホのみのメニューバー -->
    <div id="app">
        @include("../components/nav")
        <div class="wrap flex__wrap f__start input__area">
            @include("../components/sidebar")
            <div class="wrap__right">
                @include("../components/header")

                <div class="allWrapper">
                    <div class="content__wrap">
                        <div class="content__section">

                            <div class="content__header">
                                <div class="content__title">
                                <h1 class="h1">現場調査報告送信完了</h1>
                                <span class="en">Survey Sent Completed</span>
                                </div>
                            </div>

                            <div class="content__floar">
                                <div class="content__floar__inner">
                                    <div class="content__box">
                                        <div class="content__box__inner">
                                            <div class="content__text">
                                                <p>現場調査報告の登録が完了しました。<br>
                                                @if ($is_send_to_project_orderer == 1)
                                                元請けにメッセージが送信されました。
                                                @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content__submit f__center">
                            <div class="submit__box">
                                <a @if ($isCharge) href="{{ route('charge.projects.show', $id) }}" @else href="{{ route('projects.show', $id) }}" @endif>戻る</a>
                                {{--  <a href="javascript:history.go(-2)">戻る</a>  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("../components/footer")
</body>
</html>
