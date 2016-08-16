<?php
class AddValidationRuleBehavior extends ModelBehavior {
	/**
	 * カタカナチェック
         * 引数で指定された文字列がカタカナの範囲内に含まれるか判定します。
         * 値が空の場合はtrueを返します。
	 */
	function kanaOnly(&$model, $value) {
                $str = array_shift($value);
		return (empty($str) || preg_match("/^[ァ-ヾ]+$/u", $str));
	}
}
?>