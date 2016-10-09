<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">
      <?= $currentUser['name'];?>さんのクラウドストレージ
      <span style="float: right">
        <?= round($filesize/1048576,2);?>MB使用中
      </span>
    </div>
    <div class="panel-body">
      <?php foreach ($files[1] as $file) :?>
        <li class="list-group-item">
          <?= $this->Form->create(NULL, [
            'url' => ['controller' => 'contents', 'action' => 'delete'],
            'onsubmit'=>'return confirm("本当に削除しますか？")',
          ]); ?>
          <input type="checkbox" name="file[]" value="<?= $file; ?>">
          <?= $file;?>
          <span style="float: right">
            <?= $this->Html->link('ファイルをダウンロードする',['action' => 'download', $file],['confirm' => 'ダウンロードしますか？']);?>
          </span>
        </li>
      <?php endforeach;?>
    </div>
    <div style="text-align: right; margin-bottom: 8px; margin-right: 8px;">
    <input type="submit" value="選択したファイルを削除" class="btn btn-danger">
    <div>
  </div>
</div>
