<?php
// This file is part of Moodle Course Rollover Plugin
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
 * @package     local_blog
 * @author      Kristian
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_blog\form;
use moodleform;

require_once("$CFG->libdir/formslib.php");

class edit extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('text', 'newstitle', get_string('news_title', 'local_blog'), 'size="100"'); // Add elements to your form
        $mform->setType('newstitle', PARAM_NOTAGS);                   //Set type of element
        $mform->setDefault('newstitle', get_string('input_news_title', 'local_blog'));        //Default value

        $mform->addElement('textarea', 'newsdescription', get_string('news_description', 'local_blog'), 'cols="100" rows="7"'); // Add elements to your form
        $mform->setType('newsdescription', PARAM_NOTAGS);                   //Set type of element

        $mform->addElement('checkbox', 'newsenable', get_string('news_enable', 'local_blog'));
        $mform->setType('newsenable', PARAM_INT);
        $mform->setDefault('newsenable', '1');

        $this->add_action_buttons();
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}
