<?php

class block_rugby_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        // Section header title according to language file.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        //get admin settings config
        $config =get_config('block_rugby');

        // A sample string variable with a default value.
        //we need to prefix all our settings with config_ for the block to do its magic of saving and fetching them
        //for us
        $mform->addElement('text', 'config_sometext', get_string('blockstring', 'block_rugby'));
        $mform->setDefault('config_sometext', $config->sometext);
        $mform->setType('config_sometext', PARAM_TEXT);

    }
}
