<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
        var tempoNoInput = document.querySelector('input[name="tempo_no"]');
        var tempoNo = tempoNoInput.value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'check_duplicate.php?tempo_no=' + tempoNo, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.duplicate) {
                    alert('既に登録されている店番です。別の店番を入力してください。');
                    event.preventDefault(); // フォームの送信をキャンセル
                } else {
                // 重複がない場合はフォームを送信
                    document.querySelector('form').submit();
                }
            }
        };
        xhr.send();

        event.preventDefault(); // デフォルトのフォーム送信をキャンセル
        });

    </script>

</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">店舗一覧</a></div>
            </div>
        </nav>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <?php 
                    session_start();
                    if ($_SESSION['kanri_flg'] != 0): ?>
                    <div class="register-header"><a class="register-brand" href="register.php">ユーザー登録</a></div>
                <?php endif; ?>
            </div>
        </nav>


        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
            </div>
        </nav>
    </header>

    <div>
        <h1>店舗登録フォーム</h1>
    </div>

    <!-- Main[Start] -->
    <form method="POST" action="insert.php">
        <div class="tempo">
            <fieldset>
                <legend>店舗登録フォーム</legend>
                <label>店番：<input type="text" name="tempo_no"></label><br>
                <label>店舗名：<input type="text" name="tempo_name"></label><br>
                <label>郵便番号：<input type="text" name="postcode"></label><br>
                <label>住所：<input type="text" name="address"></label><br>
                <label>電話番号：<input type="text" name="phone_no"></label><br>
                <label>開店日：<input type="date" name="open_date"></label><br>
                <label>閉店日：<input type="date" name="close_date"></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->

</body>

</html>