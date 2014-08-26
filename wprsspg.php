<?php
/*
Plugin Name: WP RSS Purger
Plugin URI: http://www.easycoding.org/projects/wprsspg
Description: Очищает кэши RSS WordPress.
Author: V1TSK <vitaly@easycoding.org>
Contributor: V1TSK <vitaly@easycoding.org>
Author URI: http://www.easycoding.org/
Version: 0.1
*/
function rsspg_exec()
{
  ?>
  <h2>Модуль очистки RSS кэшей WordPress</h2>
  <div>WP RSS Purger предназначен для лёгкой и быстрой очистки RSS кэшей из базы данных WordPress.</div><br />
  <div>WP RSS Purger удалит следующее:</div>
  <div>
    <ol>
      <li>кэш RSS из таблицы <strong>wp_options</strong>;</li>
    </ol>
  </div><br />
  <div>Для начала процесса очистки нажмите соответствующую кнопку.</div>
  <?php
  if (is_admin())
  {
    global $wpdb;
    if (isset($_POST['rsspg']))
    {
      $wpdb->query("DELETE FROM `wp_options` WHERE `option_name` LIKE ('_transient%_feed_%');");
      ?>
      <h3>Кэш RSS лент движка WordPress был успешно очищен!</h3>
      <?php
    }
    else
    {
      ?>
      <br /><br />
      <div style="text-align:center">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo plugin_basename(__FILE__); ?>" method="post">
          <input type="hidden" name="rsspg" value="1" />
          <input type="submit" value="Очистить RSS кэш!" />
        </form>
      </div>
      <?php
    }
  }
  else
  {
    ?>
    <h3>Недостаточно прав для работы данного плагина! Обратитесь к администратору блога.</h3>
    <?php
  }
}

function wprsspg_a()
{
  add_options_page('WP RSS Purger', 'WP RSS Purger', 'manage_options', __FILE__, 'rsspg_exec');
}

add_action('admin_menu', 'wprsspg_a');

?>