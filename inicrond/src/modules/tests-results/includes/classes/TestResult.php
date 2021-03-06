<?php
/*
    $Id$

    Inicrond : Network of Interactive Courses Registred On a Net Domain
    Copyright (C) 2004, 2005, 2006  Sébastien Boisvert

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**

*/
class TestResult
{
    var $your_points ;
    var $max_points ;

    /**

    */
    function get_your_points ()
    {
        return $this->your_points ;
    }

    /**

    */
    function get_max_points ()
    {
        return $this->max_points ;
    }

    /**

    */
    function init ($new_your_points, $new_max_points)
    {
        $this->your_points = $new_your_points ;
        $this->max_points = $new_max_points ;
    }

    /**

    */
    function toString ()
    {
        $output = $this->your_points."/".$this->max_points." = ".(sprintf(__SPRINTF_SIGNIFICANTS_DIGITS_FORMAT__,$this->your_points/$this->max_points*100))."%";

        return $output ;
    }
}

?>