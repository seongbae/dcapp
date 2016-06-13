<?php

/**
 * @file
 * template.php
 */
function dcapp_bootstrap_preprocess_node(&$vars, $hook) {

  $account = user_load($variables['uid']);
  $variables['user_signature'] = check_markup($account->signature, $account->signature_format);
}

function dcapp_bootstrap_form_alter(&$form, &$form_state, $form_id) {
	global $user;
	
	// Hide fivestar rating when a reply is being made to a reply
  	if ($form_id == "comment_node_business_form") {
  		if (strpos(current_path(),'reply') !== false)
  			$form['field_business_rating']['#access'] = 0;
  	}
}

function dcapp_bootstrap_field_attach_view_alter(&$output, $context) {
	if (!empty($output['commerce_price'])) {
		$output['commerce_price']['#title'] = t('포인트');
	}
}

function dcapp_bootstrap_fivestar_static($variables) {
  $rating  = $variables['rating'];
  $stars = $variables['stars'];
  $tag = $variables['tag'];
  $widget = $variables['widget'];
  if ($widget['name'] != 'default') {
    $path = drupal_get_path('module', 'fivestar');
    drupal_add_css($path . '/css/fivestar.css');
    drupal_add_css($widget['css']);
  }

  $output = '<div class="fivestar-' . $widget['name'] . '">';
  $output .= '<div class="fivestar-widget-static fivestar-widget-static-' . $tag . ' fivestar-widget-static-' . $stars . ' clearfix">';
  if (empty($stars)) {
    $stars = 5;
  }


  if ($rating != 0)
  {
	  $numeric_rating = $rating/(100/$stars);
	  for ($n=1; $n <= $stars; $n++) {
	    $star_value = ceil((100/$stars) * $n);
	    $prev_star_value = ceil((100/$stars) * ($n-1));
	    $zebra = ($n % 2 == 0) ? 'even' : 'odd';
	    $first = $n == 1 ? ' star-first' : '';
	    $last = $n == $stars ? ' star-last' : '';
	    $output .= '<div class="star star-' . $n . ' star-' . $zebra . $first . $last . '">';
	    if ($rating < $star_value && $rating > $prev_star_value) {
	      $percent = (($rating - $prev_star_value) / ($star_value - $prev_star_value)) * 100;
	      $output .= '<span class="on" style="width: ' . $percent . '%">';
	    }
	    elseif ($rating >= $star_value) {
	      $output .= '<span class="on">';
	    }
	    else {
	      $output .= '<span class="off">';
	    }
	    if ($n == 1)$output .= $numeric_rating;
	    $output .= '</span>' . $rating . '</div>';
	  }
	}
	  $output .= '</div></div>';
  return $output;
}

/**
 * Implements template_preprocess_field().
 */
function dcapp_bootstrap_preprocess_field(&$vars, $hook) {

	 // Add line breaks to plain text textareas.
  if (
    // Make sure this is a text_long field type.
    $vars['element']['#field_type'] == 'text_long'
    // Check that the field's format is set to null, which equates to plain_text.
    && $vars['element']['#items'][0]['format'] == null
  ) {
    $vars['items'][0]['#markup'] = nl2br($vars['items'][0]['#markup']);
  }
}
