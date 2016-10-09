<?php
class UsersController extends AppController{

  public function beforeFilter(){
    parent::beforeFilter();

    $this->Auth->allow('signup');
  }

  public function login(){
    if($this->Auth->user()){
      return $this->redirect($this->Auth->redirectUrl());
    }

    if($this->request->is('post')){
      if($this->Auth->login()){
        $this->User->id = $this->Auth->user('id');
        $this->redirect($this->Auth->redirectUrl());
      }
      $this->Flash->error('メールアドレスかパスワードが違います');
    }

  }

  public function signup(){
    if($this->Auth->user()){
      return $this->redirect($this->Auth->redirectUrl());
    }

    if($this->request->is('post')){
      $this->User->create();
      if($this->User->save($this->request->data)){
        $this->Flash->success('ユーザーを登録しました');
        return $this->redirect(['action' => 'login']);
      }
    }

  }

  public function logout(){
    $this->Flash->success('ログアウトしました');
    $this->redirect($this->Auth->logout());
  }

  public function profile($id = null){

  }

  public function edit($id = null){

  }

  public function delete($id = null) {
    $this->request->allowMethod('post', 'delete');

    if($this->User->Delete($id, $cascade = true)){
      $this->Flash->success('ユーザを削除しました');
      $this->Auth->logout($user['User']);
    } else {
      $this->Flash->error('ユーザを削除できませんでした');
    }

    return $this->redirect(['controller' => 'tweets', 'action' => 'index']);
  }

}
