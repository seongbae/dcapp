<?php
/**
 * @file
 * Administration pages for the 'Menu filter' module.
 */

/**
 * Form builder; Settings page for the 'Menu filter' module.
 *
 * @ingroup forms
 */
function menu_filter_admin_settings($form, &$form_state) {
  $options = array();
  $result = db_query('SELECT DISTINCT module FROM {menu_links} ORDER BY module');
  foreach ($result as $record) {
    $info = unserialize(db_query("SELECT info FROM {system} WHERE name = :name", array(':name' => $record->module))->fetchField());
    $options[$record->module] = $info['name'] . ': ' . $info['description'];
  }

  $form['menu_filter_clear_cache_modules'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Clear filter cache when a menu item is created, updated, or deleted.'),
    '#description' => t('Leave blank to never to clear the filter cache when a menu is modified.'),
    '#options' => $options,
    '#required' => 0,
    '#default_value' => variable_get('menu_filter_clear_cache_modules', array('menu' => 'menu', 'book' => 'book')),
  );

  return system_settings_form($form);
}
