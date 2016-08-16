<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、MySQL、テーブル接頭辞、秘密鍵、ABSPATH の設定を含みます。
 * より詳しい情報は {@link http://wpdocs.sourceforge.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86 
 * wp-config.php の編集} を参照してください。MySQL の設定情報はホスティング先より入手できます。
 *
 * このファイルはインストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さず、このファイルを "wp-config.php" という名前でコピーして直接編集し値を
 * 入力してもかまいません。
 *
 * @package WordPress
 */

// 注意: 
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.sourceforge.jp/Codex:%E8%AB%87%E8%A9%B1%E5%AE%A4 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('DB_NAME', 'fine3_wordpress');

/** MySQL データベースのユーザー名 */
define('DB_USER', 'hoiku_app');

/** MySQL データベースのパスワード */
define('DB_PASSWORD', 'ycQJ_273nwE2rK3v0t5?s8b7');

/** MySQL のホスト名 */
define('DB_HOST', 'localhost');

/** データベースのテーブルを作成する際のデータベースの文字セット */
define('DB_CHARSET', 'utf8');

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'qTdf}-{b^*t1LN>oX(sipoo;Z]YIyGHoJmJ0m4KCX$~8sfJaP6e:%8|F]`[=~!}~');
define('SECURE_AUTH_KEY',  'e0|$|8ccI`yDPF9T*^!8I)5]M`VJqnD)zSZF=o,+Z^rHR|k&0o|qx*MSvW9E8*}8');
define('LOGGED_IN_KEY',    'E5yH+|P)6=3[A@`>Ub>O&NoKF{Gd+<{9z+2{SN:Y@&.K]c7EvaHCkD#<&u`->9-+');
define('NONCE_KEY',        '_*-1a|1&,Ts#qR#p}&r;~(M57ySPePJ8E]+Vi.::lI9l[%rfv<lz5[( O]hXeHo^');
define('AUTH_SALT',        'JG_LYF|JI|b#iP>E>gV$vw}`>O.@0Ey8gDNdXRuQX8x`V<cC|?Em@w^s#kvk~$u&');
define('SECURE_AUTH_SALT', '2;e<|*w|noG|et1BEtvx$J64V,qzDZp_dG3zqZ${brqo},a&q>>Yv|}6NgL*AxCb');
define('LOGGED_IN_SALT',   '[^t9~OAc(WY(N+p+-^<aveUA4R3C|D|8 (%*%?je[hLr0]~9$^s{my+g[%/Jrl&+');
define('NONCE_SALT',       'YWR>~4KIUe@z}6/bft,CS$(x%zx9x}@n [[,dX_+ 3{b5BW:_Y?oI}`z{w^0F9G0');


define( 'AWS_ACCESS_KEY_ID', 'AKIAI2TYLOX4FQUPILMA' );
define( 'AWS_SECRET_ACCESS_KEY', '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' );
/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix  = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でブログをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
