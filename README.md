ペイジェント決済モジュール挙動修正プラグイン
======================================

本プラグインについて
-----------------

EC-CUBE2用のペイジェント決済モジュール挙動修正プラグインです。


修正項目
-------

以下の挙動を修正します。

フロント

- テンプレートディレクトリとして、以下のパスを追加します。
    - TEMPLATE_REALDIR . 'mdl_paygent/'
    - MOBILE_TEMPLATE_REALDIR . 'mdl_paygent/'
    - SMARTPHONE_TEMPLATE_REALDIR . 'mdl_paygent/'

上記により、mdl_paygent のテンプレートをテンプレートディレクトリ内で管理できます。

- `LOG_REALDIR` が設定されている場合にログディレクトリを `LOG_REALDIR` 以下にします。

EC-CUBE2 CLI
------------

以下のコマンドを追加します。

`paygent:copy`
