<?php 

class local_crud_renderer extends plugin_renderer_base {
    public function greet_crud($name){
        $OUTPUT = "";
        $OUTPUT .= $this->heading(get_string("greet", "local_crud", $name));
        $OUTPUT .= $this->box(get_string("userstable","local_crud"));
        return $OUTPUT;
    }
}