<div class="container">
  <?php if($filesize <= 104857600):?>
    <h2>ファイルアップロード</h2>
    現在、<?= round($filesize/1000000,2);?>MB使用中です。
    <form action="upload" class="dropzone" id="myAwesomeDropzone">
    </form>
  <?php else :?>
    ファイルサイズが100MBを超えています
  <?php endif;?>
</div>
