<!DOCTYPE html>
<html lang="ja">
<meta charset="UTF-8">

<?php
date_default_timezone_set('Asia/Tokyo');

// アップロードファイル情報を表示する。
echo '--------------<br>';
echo "アップロードファイル名　：　" , $_FILES["photo"]["name"] , "<BR>";
echo "MIMEタイプ　：　" , $_FILES["photo"]["type"] , "<BR>";
echo "ファイルサイズ　：　" , $_FILES["photo"]["size"] , "<BR>";
echo "テンポラリファイル名　：　" , $_FILES["photo"]["tmp_name"] , "<BR>";
echo "エラーコード　：　" , $_FILES["photo"]["error"] , "<BR>";
echo '--------------<br>';


// ファイル名を取得して、ユニークなファイル名に変更
$file_name = $_FILES['photo']['name'];
echo $file_name + '<br>';
$uniq_file_name = date("YmdHis") . "_" . $file_name;
echo $uniq_file_name + '<br>';

// 仮にファイルがアップロードされている場所のパスを取得
$tmp_path = $_FILES['photo']['tmp_name'];
echo $tmp_path + '<br>';

// 保存先のパスを設定
$upload_path = './upload/';
echo $upload_path + '<br>';

if (is_uploaded_file($tmp_path)) {
  // 仮のアップロード場所から保存先にファイルを移動
  if (move_uploaded_file($tmp_path, $upload_path . $uniq_file_name)) {
    // ファイルが読出可能になるようにアクセス権限を変更
    chmod($upload_path . $uniq_file_name, 0644);

    echo $file_name . "をアップロードしました。";
    echo "<br><a href='index.html'><- TOPへ戻る</a>";
  } else {
    echo "Error:アップロードに失敗しました。";
  }
} else {
  echo "Error:画像が見つかりません。";
}
?>

</body>
</html>