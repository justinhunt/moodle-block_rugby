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
 * rugby block caps.
 *
 * @package    block_rugby
 * @copyright  Daniel Neis <danielneis@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_rugby extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_rugby');
    }

    function get_content() {
        global $CFG, $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';
        $this->content->text = '';

        //get the course this block is on
        $course = $this->page->course;


        //get the block instance settings (position , id  etc)
        $instancesettings = $this->instance;

        //get the admin config (that we define in settings.php)
        $adminconfig = get_config('block_rugby');
        //get the instance config (that we define in edit_form)
        $localconfig = $this->config;
        //get best config. our helper class to merge local and admin configs
        $bestconfig = \block_rugby\common::fetch_best_config($instancesettings->id);


        $renderer = $this->page->get_renderer('block_rugby');
        $this->content->text = $renderer->fetch_block_content($instancesettings->id, $bestconfig, $course->id);
        return $this->content;
    }

    //This is a list of places where the block may or may not be added by the admin
    public function applicable_formats() {
        return array('all' => false,
                     'site' => true,
                     'site-index' => true,
                     'course-view' => true, 
                     'course-view-social' => false,
                     'mod' => true, 
                     'mod-quiz' => false);
    }

    //Can we have more than one instance of the block?
    public function instance_allow_multiple() {
          return true;
    }

    function has_config() {return true;}

}
