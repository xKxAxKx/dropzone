<?php
class ContentsController extends AppController{
  public $helpers = ['Content'];

  public function index(){
    $userId = $this->Auth->user('id');

    $dir = new Folder(WWW_ROOT.'files/upload/'.$userId);
    $files = $dir->read();

    $filesize = 0;
    for ($i = 0; $i <= count($files[1])-1; $i++) {
    $filesize += filesize(WWW_ROOT.'files/upload/'.$userId.'/'.$files[1][$i]);
    }

    $this->set('dir', $dir);
    $this->set('files', $files);
    $this->set('filesize', $filesize);
  }

  public function upload(){
    $file = $this->params->form['file'];
    $userId = $this->Auth->user('id');

    //ログインユーザのフォルダ作成
    $dir = new Folder(WWW_ROOT.'files/upload/'.$userId, true, 0777);
    $files = $dir->read();

    //ユーザフォルダの容量確認
    $filesize = 0;
    for ($i = 0; $i <= count($files[1])-1; $i++) {
      $filesize += filesize(WWW_ROOT.'files/upload/'.$userId.'/'.$files[1][$i]);
    }

    $this->set('files', $files);
    $this->set('filesize', $filesize);

    //postを受け取ったあとの挙動
    if ($this->request->is(['post'])){
      $tempFile = $file['tmp_name'];
      $targetPath = WWW_ROOT.'files/upload/'.$userId.'/';
      $targetFile = $targetPath.DS.$file['name'];
      move_uploaded_file($tempFile, $targetFile);
    }
  }

  public function message(){
    $this->autoRender = false;

    $this->Flash->success('アップロード完了しました');
    $this->redirect(['action' => 'index']);
  }

  public function delete(){
    $userId = $this->Auth->user('id');
    $dir = new Folder(WWW_ROOT.'files/upload/'.$userId.'/');
    $path = $dir->path;
    $files = $this->request->data['file'];

    if($files){
      foreach($files as $file) {
        unlink($path.$file);
      }
      $this->Flash->success('削除が完了しました');
      $this->redirect($this->referer());
    } else {
      $this->Flash->error('データを選択してください');
      $this->redirect($this->referer());
    }
  }

  public function download($file = null){
    $this->autoRender = false;
    $userId = $this->Auth->user('id');

    $file_path = WWW_ROOT.'files/upload/'.$userId.'/'.$file;
    $this->response->file($file_path);

    $this->response->download($file);
  }


}
