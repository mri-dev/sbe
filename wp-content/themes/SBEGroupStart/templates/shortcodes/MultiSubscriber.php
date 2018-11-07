<form action="/feliratkozas" method="post" onsubmit="">
  <div class="wrapper">
    <div class="details">
      <div class="wrapper">
        <div class="name">
          <div class="inp-wrapper">
            <div class="ico">
              <i class="fa fa-user"></i>
            </div>
            <input type="text" name="subs_name" placeholder="<?=__('Név', TD)?>">
          </div>
        </div>
        <div class="email">
          <div class="inp-wrapper">
            <div class="ico">
              <i class="fa fa-envelope"></i>
            </div>
            <input type="text" name="subs_email" placeholder="<?=__('Email', TD)?>">
          </div>
        </div>
        <div class="site">
          <div class="select-wrapper">
            <select class="" name="subs_site">
              <?php foreach ($sites as $site): ?>
              <option value="<?=$site->name?>"><?=$site->name?></option>
              <?php endforeach; ?>
            </select>
            <div class="ico">
              <i class="fa fa-angle-down"></i>
            </div>
          </div>
        </div>
        <div class="accept">
          <input type="checkbox" name="subs_accept" id="subs_accept"> <label for="subs_accept"><?php echo sprintf(__('Adataim magadásával, elfogadom <a href="%s">ÁSZF</a> és az <a href="%s">Adatkezelési Tájékoztató</a> feltételeit és hozzájárulok ahhoz, hogy a sbe.hu ismertető leveleket küldjön nekem a megadott névre és email címre.', TD), '/aszf', '/adatvedelmi-tajekoztato'); ?></label>
        </div>
      </div>
    </div>
    <div class="sub-button">
      <button type="submit">
        <div class="t">
          <?php echo __('Várom a híreket!',TD); ?> <i class="fa fa-envelope"></i>
        </div>
      </button>
    </div>
  </div>
</form>
