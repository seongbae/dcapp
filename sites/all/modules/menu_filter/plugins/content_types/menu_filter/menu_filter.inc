<?php
/**
 * @file
 * MSK spotlight sidebar.
 */

$plugin = array(
  'single' => TRUE,
  'title' => t('Menu filter'),
  'description' => 'Displays menu links in a variety of different formats.',
  'icon' => 'icon_contrib_menu.png',
  'category' => t('Content types'),
  'defaults' => array(
    'body' => '',
    'type' => 'links',
    'branch_type' => 'link_path',
    'branch_value' => '',
  ),
);

/**
 * Implements hook_CONTENT_TYPE_content_type_render().
 */
function menu_filter_menu_filter_content_type_render($subtype, $conf, $args, $context) {
  if (empty($conf['branch_value'])) {
    $conf['branch_value'] = $_GET['q'];
  }
  $output = menu_filter_output($conf['type'], $conf['branch_type'], $conf['branch_value']);

  $block = array('content' => '');
  $block['content'] .= (!empty($conf['body'])) ? '<div clas="menu-filter-body">' . $conf['body'] . '</div>' : '';
  $block['content'] .= $output;
  return (object) $block;
}

/**
 * Implements hook_CONTENT_TYPE_content_type_edit_form().
 */
function menu_filter_menu_filter_content_type_edit_form($form, &$form_state) {
  $conf = $form_state['conf'];

  $form['body'] = array(
    '#type' => 'textarea',
    '#title' => t('Body'),
    '#default_value' => $conf['body'],
  );

  $form['type'] = array(
    '#type' => 'select',
    '#title' => t('Type'),
    '#default_value' => $conf['type'],
    '#options' => array(
      'tree' => 'tree',
      'descriptions' => 'descriptions',
      'links' => 'links',
      'dropdown' => 'dropdown',
      'teasers' => 'teasers',
    ),
    '#required' => TRUE,
  );

  $form['branch_type'] = array(
    '#type' => 'select',
    '#title' => t('Branch type'),
    '#default_value' => $conf['branch_type'],
    '#options' => array(
      'menu_name' => 'menu name',
      'link_path' => 'link path',
      'mlid' => 'menu link id (mlid)',
    ),
    '#required' => TRUE,
  );

  $form['branch_value'] = array(
    '#type' => 'textfield',
    '#title' => t('Branch value'),
    '#default_value' => $conf['branch_value'],
    '#description' => t("Leave blank to use the current page's path."),
  );

  return $form;
}

/**
 * Implements hook_CONTENT_TYPE_content_type_edit_form_submit().
 */
function menu_filter_menu_filter_content_type_edit_form_submit(&$form, &$form_state) {
  // Copy everything from our defaults.
  foreach (array_keys($form_state['plugin']['defaults']) as $key) {
    $form_state['conf'][$key] = $form_state['values'][$key];
  }
}
