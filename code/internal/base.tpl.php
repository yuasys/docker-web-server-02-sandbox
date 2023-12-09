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
  <link rel="stylesheet" href="style.css" media="all">
  <style>
    #copyMessage {
      color: orangered;
      font-size: 1.1rem;
      font-weight: 700;
      display: none;
   }
   #copyMessage:hover {
      cursor: pointer;
   }
   </style>
</head>
<body>

  <div id="main">
    <p>
      <input style="font-size: 1.8rem;" type="text" id="timeInput" placeholder="hh:mm:ss">
      <button style="font-size: 1.5rem;" onclick="convertToSeconds()">変換</button>
    </p>
    <p style="font-size: 1.8rem;">
      <span id="result"></span>
      <span id="copyMessage" onclick="location.reload();">&nbspクリップボードにコピー済！</span>
    </p>
  </div>
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
