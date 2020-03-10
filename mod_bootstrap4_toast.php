<?php

/*
 * @version		mod_bootstrap4_toast.php 1.0.1
 * @package		Bootstrap 4 Toast Module
 * @copyright   Copyright (C) 2019 Sergey Tolkachyov
 * @license     GNU/GPL http://www.gnu.org/licenses/gpl-2.0.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

    $cookie_name = "toast_".$module->id. "-" . md5(JPATH_SITE);

    $position = $params->get('position');
    $position_property = $params->get('position_property');
    if ($position == "top_left")
    {
    $position_style = "position:".$position_property."; top: 0; left: 0; z-index:2000;";
    }

    elseif
    ($position == "top_right"){
    $position_style = "position:" . $position_property . "; top: 0; right: 0;z-index:2000;";
    } elseif
    ($position == "bottom_left"){
    $position_style = "position:" . $position_property . "; bottom: 0; left: 0;z-index:2000;";
    } elseif
    ($position == "bottom_right"){
    $position_style = "position:" . $position_property . "; bottom: 0; right: 0;z-index:2000;";
    } elseif
    ($position == "any_position"){
    $any_position_css = $params->get('any_position_css'); //string
    $position_style = $any_position_css;
    }

    $show_toast_header = $params->get('show_toast_header');//Boolean
    if ($show_toast_header == 1) {
        $toast_header_img = $params->get('toast_header_img');//String - img uri
        if ($toast_header_img != "") {
            $toast_header_img = "<img src=\"" . $toast_header_img . "\" class=\"rounded mr-2\" alt=\"toast image\"/>";
        } else {
            $toast_header_img = "";
        }


        $toast_header_text = $params->get('toast_header_text');//String
        $toast_header_text_small = $params->get('toast_header_text_small');
        $toast_header_text_small = "<small>" . $toast_header_text_small . "</small>";

    }

    $toast_main_text = $params->get('toast_main_text');//String
    if ($params->get('prepare_content', 1)) {
        JPluginHelper::importPlugin('content');
        $toast_main_text = JHtml::_('content.prepare', $toast_main_text);
    }
    $toast_module_classes = $params->get('toast_module_classes'); //String
    $toast_module_header_classes = $params->get('toast_module_header_classes'); //String

    $toast_main_text = str_replace(array("\r\n", "\r", "\n"), '', $toast_main_text);
    $toast_autohide = $params->get('toast_autohide'); //Boolean
    if ($toast_autohide == "true") {
        $toast_autohide_delay = $params->get('toast_autohide_delay');//int
        $toast_autohide_delay = $toast_autohide_delay * 1000;
        $toast_autohide_delay = "data-delay=\"" . $toast_autohide_delay . "\"";
    }

    $toast_show_delay = $params->get('toast_show_delay');//int
    $toast_show_delay = $toast_show_delay * 1000;
    $toast_show_delay = ", " . $toast_show_delay;
    $toast_confirmation = $params->get('toast_confirmation');//Boolean
    if ($toast_confirmation == 1) {
        $toast_confirmation_btn_text = $params->get('toast_confirmation_btn_text');//String

        $toast_confirmation_btn = "<div id=\"mod-bootstrap4-toast-" . $module->id . "-footer\" class=\"mt-2\"><a class=\"btn btn-sm btn-primary\" href=\"#\">" . $toast_confirmation_btn_text . "</a></div>";
        $mod_bs4_toast_coockie_exp_date = $params->get('mod_bs4_toast_coockie_exp_date', '365');//String, Default 365 days
        $mod_bs4_toast_coockie_exp_date = $mod_bs4_toast_coockie_exp_date * 3600 * 24 * 1000;
    }
    $mod_bs4_toast_important = $params->get('mod_bs4_toast_important');//Boolean
    if ($mod_bs4_toast_important == 1) {
        $mod_bs4_toast_important = "role=\"alert\" aria-live=\"assertive\"";
    } else {
        $mod_bs4_toast_important = "role=\"status\" aria-live=\"polite\"";
    }
$use_utm = $params->get('use_utm');
$use_utm_source = $params->get('mod_bs4_toast_utm_source');
$use_utm_medium = $params->get('mod_bs4_toast_utm_medium');
$use_utm_campaign = $params->get('mod_bs4_toast_utm_campaign');
$use_utm_content = $params->get('mod_bs4_toast_utm_content');


    if ($toast_confirmation == 1) {
        $app = JFactory::getApplication();
        $inputGet = $app->input->get($cookie_name);
        $inputCookie = $app->input->cookie->get($name = $cookie_name, $defaultValue = null);

        if ($inputGet == '1') {
            $show_toast = 0;
        } elseif ($inputCookie == null) {
            $show_toast = 1;
            useUtmCoockie($params,$use_utm);
        }
    } else {
        $show_toast = 1;
        useUtmCoockie($params,$use_utm);
    }

function useUtmCoockie($params,$use_utm) {
    echo "use_utm = ".$use_utm;
        if ($use_utm == 1) {
        $document = JFactory::getDocument();
        $load_jquery_coockie_script = $params->get('load_jquery_coockie_script');
        if ($load_jquery_coockie_script == 1) {
            $document->addScript(JURI::root(true) . "modules/mod_bootstrap4_toast/js/jquery.coockie.js");
        }
        $document->addScript(JURI::root(true) . "modules/mod_bootstrap4_toast/js/jquery.coockie.utm.js");
    }

}

// Module template

require JModuleHelper::getLayoutPath('mod_bootstrap4_toast', $params->get('layout', 'default'));

?>