<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>

</head>

<body>
    <header>
        <nav class="navbar login-default">
            <div class="login-fluid">
                <div class="login-header"><a class="login-brand" href="select_u.php">ユーザ一覧</a></div>
            </div>
        </nav>
    </header>

    <div>
        <h1>ユーザー登録フォーム</h1>
    </div>

    <!-- Main[Start] -->
    <form method="POST" action="insert_u.php">
        <div class="user">
            <fieldset>
                <legend>ユーザー登録フォーム</legend>
                <label>ユーザー名：<input type="text" name="name"></label><br>
                <label>ログインID：<input type="text" name="lid"></label><br>
                <label>パスワード：<input type="text" name="lpw"></label><br>
                <label>管理者ステータス：<input type="text" name="kanri_flg"></label><br>
                <label>ステータス状況：<input type="text" name="life_flg"></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->

</body>

</html>