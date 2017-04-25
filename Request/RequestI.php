<?php
namespace Request;

interface RequestI
{
    public function validate();
    public function process();
    public function get_error();
}
