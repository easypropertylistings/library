<?php
/**
 * Run this file to download latest WordPress release to the directory that this file is located
 *
 */

file_put_contents("wordpress.zip", file_get_contents("https://wordpress.org/latest.zip"));
