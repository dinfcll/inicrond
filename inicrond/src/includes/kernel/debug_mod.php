<?php
/*
    $Id$

    Inicrond : Network of Interactive Courses Registred On a Net Domain
    Copyright (C) 2004, 2005  Sébastien Boisvert

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

/*
Changes :

december 15, 2005
        I formated the code correctly.

                --sebhtml

*/

if(!__INICROND_INCLUDED__)
{
    exit();
}

if (DEBUG)
{
    $debug_mod_content = "=== \$_RUN_TIME ===<br />";
    $debug_mod_content .=  nl2br(print_r($_RUN_TIME, TRUE));
    $debug_mod_content .=  "=== ===<br />";
}

?>