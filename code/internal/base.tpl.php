<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    <?php echo $title; ?>
  </title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" >
</head>
<body>
  <div id="main">
    <p>
      <input id="timeInput" type="text" placeholder="hh:mm:ss">
      <button id="convTime" onclick="convertToSeconds()">変換</button>
    </p>
    <p style="font-size: 1.8rem;">
      <span id="result"></span>
      <span id="copyMessage" onclick="location.reload();">&nbspクリップボードにコピー済！</span>
    </p>

  </div> <!--  /main -->

  <div id="developer"> <!--  For developers area -->
    <button id="reference"  onclick="#">参考情報</button>
  </div>
  <p>
    <?php
      // pingコマンドを実行する
      $cmd = "ping -c 1 google.com";
      // 出力結果を配列に格納する
      $output = array();
      // ステータスを変数に格納する
      $status = null;
      // exec関数を呼び出す
      $result = exec($cmd, $output, $status);
      // ステータスを確認する
      if ($status == 0) {
      // 正常終了した場合
      echo "pingコマンドが成功しました。<br/>";
      // 出力結果を表示する
      foreach ($output as $line) {
      echo $line . "<br/>";
      }
      } else {
      // 失敗した場合
      echo "pingコマンドが失敗しました。<br/>";
      // エラーメッセージを表示する
      echo $result . "<br/>";
      }
    ?>

    <?php
      // passthru()関数でpingコマンドを実行する
      $cmd = "ping -c 1 182.236.10.243";
      // ステータスを変数に格納する
      $status = null;
      // passthru()関数を呼び出す
      passthru($cmd, $status);
      // ステータスを確認する
      if ($status == 0) {
      // 正常終了した場合
      echo "pingコマンド成功 <br/>";
      } else {
      // 失敗した場合
      echo "pingコマンド失敗 <br/>";
      }
    ?>
  </p>

  <script>
    window.onload = function() {
        const savedTimeInput = localStorage.getItem('timeInput');
        if (savedTimeInput) {
            document.getElementById('timeInput').value = savedTimeInput;
        }
    }

    function convertToSeconds() {
      const timeInput = document.getElementById('timeInput').value;
      localStorage.setItem('timeInput', timeInput);
      const timeParts = timeInput.split(':');
      const seconds = (+timeParts[0]) * 60 * 60 + (+timeParts[1]) * 60 + (+timeParts[2]);
      document.getElementById('result').innerText = seconds + ' 秒';
      copyToClipboard(seconds);
      document.getElementById('copyMessage').style.display = 'inline';
  }

    function copyToClipboard(seconds) {
        const textArea = document.createElement('textarea');
        textArea.value = seconds;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
    }
  </script>

</body>
</html>
