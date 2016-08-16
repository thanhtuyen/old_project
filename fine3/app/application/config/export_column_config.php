<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['user'] = array(
'user_id' => 'ユーザーID',
'name' => '名前',
'name_kana' => 'ふりがな',
'password' => 'パスワード',
'mail' => 'メールアドレス',
'gender' => '性別',
'zip_code' => '郵便番号',
'address' => '住所',
'phone' => '電話番号',
'birthdate' => '生年月日',
'checked' => '紹介会社希望',
'status' => 'ステータス',
'delete_flg' => '削除状態',
'created' => '登録日時',
'updated' => '更新日時',

);

$config['job'] = array(
    'job_id'=> '求人ID',
    'own_job_id'=> '自社ID',
    'title'=> 'タイトル',
    'description'=> '仕事内容',
    'pr'=> 'PR文',
    'requirement' => '必須資格',
    'name'=> '募集職種',
    'salary'=> '給与',
    'bonus'=> '賞与',
    'worktime'=> '勤務時間',
    'employees'=> '応募可能人数',
    'holiday'=> '休日',
    'expired'=> '掲載終了日',
    'status'=> '公開状態',
    'created'=> '作成日時',
    'updated'=> '更新日時',
    'delete_flg' => '削除状態'
);

$config['nursery'] = array(
    'nursery_id' => '園ID',
    'own_id' => '自社ID',
    'own_nursery_id'=>'自社ID',
    'name' => '園名',
    'address' => '住所',
    'direction' => 'アクセス',
    'capacity' => '園児数',
    'url' => 'URL',
    'station_name' => '最寄駅',
    'pr' => 'PR',
    'status' => '公開状態',
    'created' => '作成日時',
    'updated' => '更新日時',
    'client_name'=>'クライアント名',
    'delete_flg' => '削除状態'
);

$config['apply-for-agency'] = array(
    'applicant_agency_id' => '応募ID',
    'client_id' => 'クライアントID',
    'client_name' => 'クライアント名',
    'user_id' => 'ユーザーID',
    'name' => 'ユーザー名',
    'name_kana' => 'ユーザー名（カナ）',
    'birthdate' => '生年月日',
    'mail' => 'メールアドレス',
    'gender' => '性別',
    'zip_code' => '郵便番号',
    'address' => '住所',
    'phone' => '電話番号',
    'license' => '保有資格',
    'employ_type' => '希望雇用形態',
    'status' => '除外申請',
    'created' => '応募日時',

);

$config['apply-for-job'] = array(
    'applicant_job_id' => '応募ID',
    'client_id' => 'クライアントID',
    'client_name' => 'クライアント名',
    'job_id' => '求人ID',
    'nursery_name' => '園名',
    'title' => '求人タイトル',
    'user_id' => 'ユーザーID',
    'name' => 'ユーザー名',
    'name_kana' => 'ユーザー名（カナ）',
    'birthdate' => '生年月日',
    'mail' => 'メールアドレス',
    'name' => '保有資格',
    'gender' => '性別',
    'zip_code' => '郵便番号',
    'address' => '住所',
    'phone' => '電話番号',
    'employ_type' => '希望雇用形態',
    'status' => '除外申請',
    'created' => '応募日時',

);

$config['scouted'] = array(
'scout_id' => 'スカウトID',
'client_id' => 'クライアントID',
'name' => 'クライアント名',
'user_id' => 'ユーザーID',
'birthdate' => '年齢',
'name' => '保有資格',
'gender' => '性別',
'area_id' => '居住地',
'name' => '希望雇用形態',
'template_id' => 'メールテンプレートID',
'title' => 'タイトル',
'contents' => 'メール本文',
'created' => '送信日時',
);

$config['template'] = array(
    'template_id' => 'メールテンプレートID',
    'client_id' => 'クライアントID',
    'name' => 'クライアント名',
    'title' => 'タイトル',
    'content' => 'メール本文',
    'status' => '公開状態',
    'created' => '作成日時',
    'updated' => '更新日時',
    'delete_flg' => '削除状態',

);

$config['client'] = array(
    'client_id' => '企業ID',
    'mail' => 'メールアドレス',
    'password' => 'パスワード',
    'name' => '企業名',
    'display_name' => '企業名（表示用）',
    'department' => '部署名',
    'contact_name' => '担当者名',
    'phone' => '電話番号',
    'fax' => 'FAX',
    'zip_code' => '郵便番号',
    'display_postal_code' => '郵便番号（表示用）',
    'address' => '住所',
    'display_address' => '住所（表示用）',
    'pr' => 'PR',
    'licence_number' => '有料職業紹介許可番号',
    'process' => '紹介・選考の流れ',
    'url' => '企業URL',
    'establish_date' => '創立',
    'status' => 'ステータス',
    'created' => '登録日時',
    'updated' => '更新日時',
    'account_type' => 'カテゴリ',

);

$config['plan_group'] = array(
    'plan_group_id' => 'パッケージプランID',
    'name' => 'パッケージプラン名',
    'plans' => 'プラン内容',
    'period' => '契約期間',
    'auto_extend_flg' => '自動更新',
    'status' => '公開非公開',
    'delete_flg' => '削除状態',
);

$config['plan'] = array(
    'plan_id' => 'プラン内容ID',
    'plan_name' => 'プラン内容名',
    'description' => 'プラン内容詳細',
    'limit_num' => '上限数',
    'limit_type' => '上限の種類',
);


$config['client_job'] = array(
    'job_id' => '求人ID',
    'title' => '求人タイトル',
    'nursery_name' => '園名',
    'tag_text' => '雇用形態',
    'status_text' => '公開',
);

$config['client_nursery'] = array(
    'nursery_id' => '園ID',
    'name' => '園名',
    'address' => '所在地',
    'status_text' => '状態',
);

$config['client_job_apply'] = array(
    'applicant_job_id' => 'ID',
    'user_name' => '応募者名',
    'created' => '応募日時',
    'job_title' => '応募求人',
    'nursery_name_and_type_job' => '応募園・募集職種',
    'wish_job' => '希望雇用形態',
    'user_license_name' => '保有資格',
    'applicant_status' => 'ステータス',
);
