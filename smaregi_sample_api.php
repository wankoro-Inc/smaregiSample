<?php

/*-------------
  APIに送信するデータ準備
--------------*/
$arydata=array(
                "fields"=> array(
                                "categoryId",
                                "categoryName",
                                ),
                "conditions"=>array(
                                "categoryName like"=>"%%",
                                ),
                "order"=>array(
                                "categoryId desc",
                                ),
                "limit"=>100,
                "table_name"=>"Category",
                );

$data ="proc_name=category_ref&params=". json_encode( $arydata , JSON_PRETTY_PRINT );

echo $data."\n";


/*-------------
  API URL & ヘッダ情報準備
--------------*/
$token='XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
$url='https://webapi.smaregi.jp/access/';
$keiyaku_id = 'sbg999c9';


$header = [
                'POST '.$url.' HTTP/1.1',
                'Host: webapi.smaregi.jp',
                'X_contract_id: '.$keiyaku_id,
                'X_access_token: '.$token,
                'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
        ];



/*-------------
  API 実行・レスポンス受け取り
--------------*/
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); // post
curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // jsonデータを送信
curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // リクエストにヘッダーを含める
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, true);

$response = curl_exec($curl);

$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);
$result = json_decode($body, true);

curl_close($curl);





/*-------------
  API 実行結果デバッグ表示
--------------*/

echo "------------\n";
echo "$response\n";
echo $result

?>
