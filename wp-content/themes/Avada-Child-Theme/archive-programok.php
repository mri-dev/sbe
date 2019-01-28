<?php
global $post;
get_header();

$time_text = null;
$time_filter = (isset($_GET['from']) || isset($_GET['to'])) ? true : false;
$time_from = $_GET['from'];
$time_to = $_GET['to'];

if ($time_filter) {
  if ($time_from == $time_to) {
    $time_text = utf8_encode(strftime ('%Y. %B %e.', strtotime($time_from)));
  } elseif($time_from != $time_to) {
    $time_text = utf8_encode(strftime ('%Y. %B %e.', strtotime($time_from))) . " &mdash; ".utf8_encode(strftime ('%Y. %B %e.', strtotime($time_to)));
  }
}
?>
<div id="content" <?php Avada()->layout->add_style( 'content_style' ); ?>>
  <div class="prog-title">
    <h1><?php echo __('Programjaink',TD); ?></h1>
    <?php if ($time_filter): ?>
    <div class="time-filter">
      <div class="filter-title">
        <?php echo __('Időpont szerint szűrve:', TD); ?>
      </div>
      <strong><?php echo $time_text; ?></strong>
    </div>
    <?php endif; ?>
  </div>
  <?php echo do_shortcode('[program-list by="legujabb" limit="12" pagination="1"]'); ?>
</div>
<?php get_footer();
