<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <?= $currentUser['name'];?>さんのクラウドストレージ
      <span style="float: right">
        <?= round($filesize/1000000,2);?>MB使用中
      </span>
    </div>
    <div class="panel-body">
      <?php foreach ($files[1] as $file) :?>
        <li class="list-group-item">
          <?= $file;?>
          <span style="float: right">
            <?= $this->Form->postLink('ファイルをダウンロードする',['action' => 'download', $file],['confirm' => 'ダウンロードしますか？']);?>
            <?= $this->Form->postLink('削除',['action' => 'delete', $file],['confirm' => '削除してよろしいですか？']);?>
          </span>
        </li>
      <?php endforeach;?>
    </div>
  </div>
</div>
