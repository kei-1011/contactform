<?php

define("MAIL_FROM", "test@test.jp"); // 送信者メールアドレス
define("MAIL_NAME", "name"); // 送信者メールアドレスの表示名

define("MAIL_ADMIN", "test@test.jp"); // 管理者宛メール 送信メールアドレス ,区切りで複数可

define("MAIL_TITLE", "title"); // メールタイトル
define("MAIL_BODY", dirname(__FILE__)."/contact_body.txt"); // メール本文

define("MAIL_ADMIN_TITLE", "title admin"); // 管理者宛メール メールメールタイトル
define("MAIL_ADMIN_BODY", dirname(__FILE__)."/contact_admin_body.txt"); // 管理者宛メール メール本文

define("FORM_ELEMENTS", "name,email,message"); // フォーム管理項目
