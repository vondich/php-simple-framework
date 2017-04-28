<?php
namespace Controller;

/**
 *
 * @author nin
 */
interface IController
{
    function process();
    function hasOutput();
    function displayOutput();
}
