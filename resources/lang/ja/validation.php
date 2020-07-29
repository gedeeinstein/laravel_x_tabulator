<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attributeを承認してください。',
    'active_url'           => ':attributeは、有効なURLではありません。',
    'after'                => ':attributeには、:date以降の日付を指定してください。',
    'after_or_equal'       => ':attributeには、:date以降もしくは同日時を指定してください。',
    'alpha'                => ':attributeには、アルファベッドのみ使用できます。',
    'alpha_dash'           => ":attributeには、英数字('A-Z','a-z','0-9')とハイフンと下線('-','_')が使用できます。",
    'alpha_num'            => ":attributeには、英数字('A-Z','a-z','0-9')が使用できます。",
    'array'                => ':attributeには、配列を指定してください。',
    'before'               => ':attributeには、:date以前の日付を指定してください。',
    'before_or_equal'      => ':attributeには、:date以前もしくは同日時を指定してください。',
    'between'              => [
        'numeric' => ':attributeには、:minから、:maxまでの数字を指定してください。',
        'file'    => ':attributeには、:min KBから:max KBまでのサイズのファイルを指定してください。',
        'string'  => ':attributeは、:min文字から:max文字にしてください。',
        'array'   => ':attributeの項目は、:min個から:max個にしてください。',
    ],
    'boolean'              => ":attributeには、'true'か'false'を指定してください。",
    'confirmed'            => ':attributeと:attribute確認が一致しません。',
    'date'                 => ':attributeは、正しい日付ではありません。',
    'date_format'          => ":attributeの形式は、':format'と合いません。",
    'different'            => ':attributeと:otherには、異なるものを指定してください。',
    'digits'               => ':attributeは、:digits桁にしてください。',
    'digits_between'       => ':attributeは、:min桁から:max桁にしてください。',

    'dimensions'           => ':attributeは、正しい縦横比ではありません。',
    'distinct'             => ':attributeに重複した値があります。',
    'email'                => ':attributeは、有効なメールアドレス形式で指定してください。',
    'exists'               => '選択された:attributeは、有効ではありません。',
    'file'                 => ':attributeはファイルでなければいけません。',
    'filled'               => ':attributeは必須です。',
    'image'                => ':attributeには、画像を指定してください。',
    'in'                   => '選択された:attributeは、有効ではありません。',
    'in_array'             => ':attributeは、:otherに存在しません。',
    'integer'              => ':attributeには、整数を指定してください。',
    'ip'                   => ':attributeには、有効なIPアドレスを指定してください。',
    'ipv4'                 => ':attributeはIPv4アドレスを指定してください。',
    'ipv6'                 => ':attributeはIPv6アドレスを指定してください。',
    'json'                 => ':attributeには、有効なJSON文字列を指定してください。',
    'max'                  => [
        'numeric' => ':attributeには、:max以下の数字を指定してください。',
        'file'    => ':attributeには、:max KB以下のファイルを指定してください。',
        'string'  => ':attributeは、:max文字以下で入力してください。',
        'array'   => ':attributeの項目は、:max個以下にしてください。',
    ],
    'mimes'                => ':attributeには、:valuesタイプのファイルを指定してください。',
    'mimetypes'            => ':attributeには、:valuesタイプのファイルを指定してください。',
    'min'                  => [
        'numeric' => ':attributeには、:min以上の数字を指定してください。',
        'file'    => ':attributeには、:min KB以上のファイルを指定してください。',
        'string'  => ':attributeは、:min文字以上で入力してください。',
        'array'   => ':attributeの項目は、:max個以上にしてください。',
    ],
    'not_in'               => '選択された:attributeは、有効ではありません。',
    'numeric'              => ':attributeには、数字を指定してください。',
    'present'              => ':attributeは、必ず存在しなくてはいけません。',
    'regex'                => ":attributeには、英数字('A-Z','a-z','0-9')が使用できます。",
    'required'             => ':attributeは必須項目です。',
    'required_if'          => ':otherが:valueの場合、:attributeは必須項目です',
    'required_unless'      => ':otherが:value以外の場合、:attributeは必須項目です',
    'required_with'        => ':valuesが指定されている場合、:attributeも必須項目です',
    'required_with_all'    => ':valuesが全て指定されている場合、:attributeも必須項目です',
    'required_without'     => ':valuesが指定されていない場合、:attributeは必須項目です',
    'required_without_all' => ':valuesが全て指定されていない場合、:attributeは必須項目です',
    'same'                 => ':attributeと:otherが一致しません。',
    'size'                 => [
        'numeric' => ':attributeには、:sizeを指定してください。',
        'file'    => ':attributeには、:size KBのファイルを指定してください。',
        'string'  => ':attributeは、:size文字にしてください。',
        'array'   => ':attributeの項目は、:size個にしてください。',
    ],
    'string'   => ':attributeには、文字を指定してください。',
    'timezone' => ':attributeには、有効なタイムゾーンを指定してください。',
    'unique'   => '指定の:attributeは既に登録されています。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'url'      => ':attributeは、有効なURL形式で指定してください。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'sent_date' => [
            'required_if' => ':otherが配信予約の場合、:attributeは必須項目です',
        ],
        'sent_time' => [
            'after' => ':attributeには、:date以降の時間を指定してください。',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */
    
    'attributes' => [
        
        // for auth
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => '確認用パスワード',
        'agreement' => '個人情報保護方針に同意',
        
        // common fields
        'display_name' => '名前',
        'name' => '名前(ローマ字)',
        'title' => 'タイトル',
        
        // for users
        'username' => 'ユーザー名',
        
        // for line users
        'first_name_kana' => 'カナ(名)',
        'last_name_kana' => 'カナ(姓)',
        'plate_number' => '車番号',
        
        // for messages
        'message_status_id' => '配信方法',
        'sent_date' => '配信日',
        'sent_time' => '配信日',
    ]
];
