<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if($_SESSION["token"]!=$_POST["token"]){
        header("HTTP/1.0 403 Forbidden");
        exit;
    }
    mail("kengo.hashimoto@aiesec.jp","SPICIES コンタクトフォーム",<<<EOT
コンタクトフォームから連絡を受け付けました。

# 名前
{$_POST["name"]}

# 大学/学年
{$_POST["grade"]}

# 希望日時
- 第一希望: {$_POST["data"][0]} {$_POST["from_time"][0]}~{$_POST["to_time"][0]}
- 第二希望: {$_POST["data"][1]} {$_POST["from_time"][1]}~{$_POST["to_time"][1]}
- 第三希望: {$_POST["data"][2]} {$_POST["from_time"][2]}~{$_POST["to_time"][2]}

# メールアドレス
{$_POST["email"]}

# 備考
{$_POST["description"]}
EOT
    ,<<<EOT
From: noreply@aiesec.jp\r\n
Cc: kasai.mirei@aiesec.jp\r\n
Cc: taigen.takeshita@aiesec.jp\r\n
Cc: hinako.ando@aiesec.jp\r\n
Reply-To: $_POST["email"]
EOT);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <base href="/">
    <link rel="stylesheet" href="style.css">
    <title>ご連絡ありがとうございます！ - SPICIES | 燻っている貴方に、ピリッとした経験を</title>
</head>
<body>
    <menu id="menu">
        <input type="checkbox" id="trigger" />
        <h1 id="logo"><img src="img/spicieslogowhite.png" alt="SPICY" class="white"><img src="img/spicieslogo.png" alt="SPICY" class="orange"></h1>
        <label class="hamburger" for="trigger"></label>
        <div class="menu_container">
            <a href="">ABOUT</a>
            <a href="programs">PROGRAMS</a>
            <a href="voice">VOICE</a>
            <a href="contact.php">CONTACT</a>
        </div>
    </menu>
    <main>
        <section>
            <div class="inner" align="center">
                <h1>ご連絡ありがとうございます！</h1>
                <p>1週間以内に返信させていただきます。少々お待ちください！</p>
                <a href="">トップへ</a>
            </div>
        </section>
    </main>
</body>
</html>
<?php
    exit;
}else{
    $token=sha1(uniqid().mt_rand());
    $_SESSION["token"]=$token;
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <base href="/">
    <link rel="stylesheet" href="style.css">
    <title>ご連絡ありがとうございます！ - SPICIES | 燻っている貴方に、ピリッとした経験を</title>
</head>
<body>
    <menu id="menu">
        <input type="checkbox" id="trigger" />
        <h1 id="logo"><img src="img/spicieslogowhite.png" alt="SPICY" class="white"><img src="img/spicieslogo.png" alt="SPICY" class="orange"></h1>
        <label class="hamburger" for="trigger"></label>
        <div class="menu_container">
            <a href="">ABOUT</a>
            <a href="programs">PROGRAMS</a>
            <a href="voice">VOICE</a>
            <a href="contact.php">CONTACT</a>
        </div>
    </menu>
    <main>
        <section>
            <div class="inner">
                <h1>CONTACT</h1>
                <p>まずは気軽にご相談ください！<br>運営メンバーが対応させていただきます。
                <form id="contact_form" action="" method="POST">
                    <input type="text" name="name" placeholder="名前">
                    <input type="text" name="grade" placeholder="大学・学年">
                    <h5>ご相談希望日時</h5>
                    <dl class="appoint">
                        <dt>第1希望</dt>
                        <dd class="datetime_container">
                            <input type="date" name="date[]" placeholder="ご相談希望日時">
                            <input type="time" name="from_time[]" placeholder="ご相談希望日時">~<input type="time" name="to_time[]" placeholder="ご相談希望日時">
                        </dd>
                        <dt>第2希望</dt>
                        <dd class="datetime_container">
                            <input type="date" name="date[]" placeholder="ご相談希望日時">
                            <input type="time" name="from_time[]" placeholder="ご相談希望日時">~<input type="time" name="to_time[]" placeholder="ご相談希望日時">
                        </dd>
                        <dt>第3希望</dt>
                        <dd class="datetime_container">
                            <input type="date" name="date[]" placeholder="ご相談希望日時">
                            <input type="time" name="from_time[]" placeholder="ご相談希望日時">~<input type="time" name="to_time[]" placeholder="ご相談希望日時">
                        </dd>
                    </dl>
                    <input type="email" name="email" placeholder="ご連絡先（EmailもしくはSNSアカウント）">
                    <textarea name="description" placeholder="備考"></textarea>
                    <input type="hidden" name="token" value="<?=$_SESSION["token"];?>" />
                    <button type="submit">送信</button>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
