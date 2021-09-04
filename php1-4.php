<?php 

// リロードをした時に二重送信を防ぐためにトークンの発行をしている

session_start();

// リロードした際は、新しくトークンが発行されフォームから送られてきたトークンと異なる様になる。
if ($_POST["token"] == $_SESSION["token"])
{
  $select_array = ['グー', 'チョキ', 'パー'];

  // 自分の出し手を決める(フォームからは"0", "1", "2"の様に文字型の値が送られてくるので(int)とすることで数値型に変換している。)
  $player_select = $select_array[(int)$_POST['select']];
  
  // 相手の出し手を決める(randで0〜2の間でランダムな数値を出るようにする。)
  $npc_select = $select_array[rand(0,2)];
}

$_SESSION['token'] = mt_rand();

$token = $_SESSION['token'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>php課題1-4</title>
</head>
<body>
  <form method="post">
    <select name="select" id="">
      <option value="0">グー</option>
      <option value="1">チョキ</option>
      <option value="2">パー</option>
    </select>
      <input type="submit" value="じゃんけん！">
      <input type="hidden" name="token" value="<?php echo $token; ?>">
  </form>

  <!-- 自分の出し手表示 -->
  <p><?php echo "自分:".$player_select; ?></p>

  <!-- 相手の出し手表示 -->
  <p><?php echo "相手:".$npc_select; ?></p>
  
  <!-- 結果表示 -->
  <?php 
  if ($player_select == 'グー') {
    switch ($npc_select) {
        case 'チョキ':
            echo "あなたの勝利です！";
            break;
        case 'グー':
            echo 'あいこ';
            break;
        case 'パー':
            echo "あなたの敗北です。。";
            break;
    } 
  } elseif ( $player_select == 'チョキ') {
    switch ($npc_select) {
      case 'パー':
          echo "あなたの勝利です！";
          break;
      case 'チョキ':
          echo 'あいこ';
          break;
      case 'グー':
          echo "あなたの敗北です。。";
          break;
    } 
  } elseif($player_select == 'パー') {
    switch ($npc_select) {
      case 'グー':
          echo "あなたの勝利です！";
          break;
      case 'パー':
          echo 'あいこ';
          break;
      case 'チョキ':
          echo "あなたの敗北です。。";
          break;
    } 
  }
  ?>

</body>
</html>