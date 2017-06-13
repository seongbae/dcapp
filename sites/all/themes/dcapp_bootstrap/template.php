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


function dcapp_bootstrap_fivestar_summary($variables) {
  $microdata = $variables['microdata'];
  extract($variables, EXTR_SKIP);
  $output = '';
  $div_class = '';
  $average_rating_microdata = '';
  $rating_count_microdata = '';
  if (isset($user_rating)) {
    $div_class = isset($votes) ? 'user-count' : 'user';
    $user_stars = round(($user_rating * $stars) / 100, 1);
    $output .= '<span class="user-rating">' . t('Your rating: <span>!stars</span>', array('!stars' => $user_rating ? $user_stars : t('None'))) . '</span>';
  }
  if (isset($user_rating) && isset($average_rating)) {
    $output .= ' ';
  }
  if (isset($average_rating)) {
    if (isset($user_rating)) {
      $div_class = 'combo';
    }
    else {
      $div_class = isset($votes) ? 'average-count' : 'average';
    }

    $average_stars = round(($average_rating * $stars) / 100, 1);
    if (!empty($microdata['average_rating']['#attributes'])) {
      $average_rating_microdata = drupal_attributes($microdata['average_rating']['#attributes']);
    }
    $output .= '<span class="average-rating">' . t('Rating: !stars',
      array('!stars' => "<span $average_rating_microdata>$average_stars</span>")) . '</span>';
  }

  if (isset($votes)) {
    if (!isset($user_rating) && !isset($average_rating)) {
      $div_class = 'count';
    }
    if ($votes === 0) {
      $output = '<span class="empty"></span>';
    }
    else {
      if (!empty($microdata['rating_count']['#attributes'])) {
        $rating_count_microdata = drupal_attributes($microdata['rating_count']['#attributes']);
      }
      // We don't directly substitute $votes (i.e. use '@count') in format_plural,
      // because it has a span around it which is not translatable.
      $votes_str = format_plural($votes, '!cnt review', '!cnt reviews', array(
        '!cnt' => '<span ' . $rating_count_microdata . '>' . intval($votes) . '</span>'));
      if (isset($user_rating) || isset($average_rating)) {
        $output .= ' <span class="total-votes">(' . $votes_str . ')</span>';
      }
      else {
        $output .= ' <span class="total-votes">' . $votes_str . '</span>';
      }
    }
  }


  $output = '<div class="fivestar-summary fivestar-summary-' . $div_class . '">' . $output . '</div>';
  return $output;
}


/**
 * Display a static fivestar value as stars with a title and description.
 */
function dcapp_bootstrap_fivestar_static_element($variables) {
  $output = '';
  if (isset($variables['is_form']) && !$variables['is_form']) {
    $output .= '<div class="fivestar-static-item">';
  }
  else {
    $output .= '<div class="fivestar-static-form-item">';
  }
  $element = array(
    '#type' => 'item',
    '#title' => $variables['title'],
    '#description' => $variables['description'],
    '#children' => $variables['star_display'],
  );

  $output .= theme('form_element', array('element' => $element));
  $output .= '</div>';
  return $output;
}
