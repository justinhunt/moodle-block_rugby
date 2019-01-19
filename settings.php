<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Block rugby
 *
 * @package    block_rugby
 * @copyright  Justin Hunt <justin@poodll.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_heading('rugby_config_header',
        get_string('headerconfig', 'block_rugby'),
        get_string('descconfig', 'block_rugby')));

    $settings->add(new admin_setting_configcheckbox('block_rugby/somecheck',
        get_string('somecheck', 'block_rugby'),
        get_string('somecheck_desc', 'block_rugby'),
        '0'));

    $settings->add(new admin_setting_configtext('block_rugby/sometext',
        get_string('sometext', 'block_rugby'),
        get_string('sometext_desc', 'block_rugby'),
        'sometext', PARAM_TEXT));
    
    //authplugin stuff
    $settings->add(new admin_setting_configtext('block_rugby' .  '/apiserver',
        get_string('apiserver', 'block_rugby'), get_string('apiserver_details', 'block_rugby'), '', PARAM_TEXT));


    $settings->add(new admin_setting_configtext('block_rugby' .  '/apiuser',
        get_string('apiuser', 'block_rugby'), get_string('apiuser_details', 'block_rugby'), '', PARAM_TEXT));

    $tokeninfo =   \block_rugby\authpluginutils::fetch_token_for_display(get_config('block_rugby','apiuser'),get_config('block_rugby','apisecret'));
    $settings->add(new admin_setting_configtext('block_rugby' .  '/apisecret',
        get_string('apisecret', 'block_rugby'),$tokeninfo , '', PARAM_TEXT));



}