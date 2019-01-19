<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// This file is part of Moodle - http://moodle.org/                      //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//                                                                       //
// Moodle is free software: you can redistribute it and/or modify        //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation, either version 3 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// Moodle is distributed in the hope that it will be useful,             //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details.                          //
//                                                                       //
// You should have received a copy of the GNU General Public License     //
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.       //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * Block new_template view.php
 * @package   block_newtemplate
 * @copyright 2018 Justin Hunt (https://poodll.com)
 * @author    Justin Hunt
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
require('../../config.php');

//fetch the blockid whose settings we should use
$blockid = required_param('blockid',PARAM_INT);
$courseid = required_param('courseid',PARAM_INT);
$dosomething = optional_param('dosomething',0,PARAM_INT);

//set the url of the $PAGE
//note we do this before require_login preferably
//so Moodle will send user back here if it bounces them off to login first
$PAGE->set_url('/blocks/rugby/view.php',array('blockid'=>$blockid, 'courseid'=>$courseid, 'dosomething'=>$dosomething));
$course = get_course($courseid);
require_login($course);


if($dosomething){
    \block_rugby\common::do_something($blockid);
    $redirecturl = new moodle_url('/blocks/rugby/view.php',array('blockid'=>$blockid, 'courseid'=>$courseid));
    redirect($redirecturl,get_string('didsomething', 'block_rugby'),10);
}


$coursecontext = context_course::instance($course->id);
$PAGE->set_course($course);
$PAGE->set_context($coursecontext);
$PAGE->set_heading($SITE->fullname);
$PAGE->set_pagelayout('course');
$PAGE->set_title(get_string('pluginname', 'block_rugby'));
$PAGE->navbar->add(get_string('pluginname', 'block_rugby'));

$renderer = $PAGE->get_renderer('block_rugby');

//fetch config. using our helper class which merges admin and local settings
$config=\block_rugby\common::fetch_best_config($blockid);

//display the content of this page from our nice renderer
$renderer->display_view_page($blockid,$courseid);