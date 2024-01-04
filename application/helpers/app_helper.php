<?php
if (!function_exists('mb_ucfirst')) {
  function mb_ucfirst($str, $encoding = "UTF-8", $lower_str_end = false) {
    $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
    $str_end = "";
    if ($lower_str_end) {
      $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
    }
    else {
      $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
    }
    $str = $first_letter . $str_end;
    return $str;
  }
}

if (!function_exists('form_email')) {
  function form_email($data = '', $value = '', $extra = '')
  {
    $defaults = array(
            'type' => 'email',
            'name' => is_array($data) ? '' : $data,
            'value' => $value
          );

    return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
  }
}

if (!function_exists('form_number')) {
  function form_number($data = '', $value = '', $extra = '')
  {
    $defaults = array(
            'type' => 'number',
            'name' => is_array($data) ? '' : $data,
            'value' => $value
          );

    return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
  }
}
