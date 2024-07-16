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
 * Folder module version information
 *
 * @package   local_crud
 * @copyright 2024 Nithin Kumar nithin54k@gmail.com
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__."/../../config.php");
require_login();
$context = context_system::instance();
require_capability("local/crud:crudop", $context);

$name = optional_param("name", "", PARAM_TEXT);
if (!$name) {
    $name = fullname($USER);
}

$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/crud/index.php'));
$PAGE->set_title(get_string("welcome", "local_crud"));
$PAGE->set_pagelayout('standard');
$PAGE->requires->jquery();


global $DB,$OUTPUT;
$result = $DB->get_records("user");

$templatecontext = (object) [
    'users' => array_values($result),
];

$table = new html_table();
$table->head = array("ID","FirstName","LastName","UserName","Email","");
foreach ($result as $rec) {
    $ID = $rec->id;
    $FirstName = $rec->firstname;
    $LastName = $rec->lastname;
    $UserName = $rec->username;
    $Email = $rec->email;
    $table->data[] = array($ID,$FirstName,$LastName,$UserName,$Email);
}
$tabledisplay = html_writer::table($table);

$OUTPUT = $PAGE->get_renderer("local_crud");

echo $OUTPUT->header();
// echo $tabledisplay;
// echo $OUTPUT->greet_crud($name);
echo $OUTPUT->render_from_template("local_crud/index", $templatecontext);
echo $OUTPUT->footer();



