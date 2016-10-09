<div class="container">
  <?php if($filesize <= 104857600):?>
    <h2>ファイルアップロード</h2>
    現在、<?= round($filesize/1048576,2);?>MB使用中です。
    <form action="upload" class="dropzone" id="myAwesomeDropzone">
    </form>
  <?php else :?>
    ファイル容量が100MBを超えています。削除して下さい。
  <?php endif;?>
</div>
