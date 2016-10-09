<?php

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel{

  public $validate =[
    //サインアップのバリデーション
    'name' => [
      'required' => [
        'rule' => 'notBlank',
        'message' => 'ユーザネームを入力して下さい'
      ],
    ],

    'email' => [
      'required' => [
        'rule' => 'notBlank',
        'message' => 'メールアドレスを入力してください'
      ],
      'validEmail' => [
        'rule' => 'email',
        'message' => '正しいメールアドレスを入力してください'
      ],
      'emailExists' => [
        'rule' => ['isUnique', 'email'],
        'message' => '入力されたメールアドレスは既に登録されています'
      ],
    ],
    
    'encrypted_password' => [
      'required' => [
        'rule' => 'notBlank',
        'message' => 'パスワードを入力してください'
      ],
      'match' => [
        'rule' => 'passwordConfirm',
        'message' => 'パスワードが一致していません'
      ],
    ],
    'password_confirm' => [
      'required' => [
        'rule' => 'notBlank',
        'message' => 'パスワード(確認)を入力してください'
      ],
    ],
    'profile' => [
      'required' => [
        'rule' => 'notBlank',
        'message' => 'プロフィールを入力して下さい'
      ]
    ],

    //ログイン時のバリデーション
    'password_current' =>[
      'required' => [
        'rule' => 'notBlank',
        'message' => 'パスワードが入力されていません'
      ],
      'match' => [
        'rule' => 'checkCurrentPassword',
        'message' => 'パスワードが一致していません'
      ]
    ]

  ];

  public function passwordConfirm($check) {
    if ($check['encrypted_password'] === $this->data['User']['password_confirm']) {
      return true;
    }
    return false;
  }

  public function beforeSave($options = [ ]){
    if(isset($this->data['User']['encrypted_password'])){
      $passwordHasher = new BlowfishPasswordHasher();
      $this->data['User']['encrypted_password'] = $passwordHasher->hash($this->data['User']['encrypted_password']);
    }
    return true;
  }

  public function checkCurrentPassword($check){
    $password = array_values($check)[0];

    $user = $this->findById($this->data['User']['id']);

    $passwordHasher = new BlowfishPasswordHasher();

    if($passwordHasher->check($password, $user['User']['encrypted_password'])){
      return true;
    }
    return false;
  }

}
