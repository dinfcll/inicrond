<?php
/**
 * Usage example for Image_Graph.
 * 
 * Main purpose: 
 * Show bar chart
 * 
 * Other: 
 * None specific
 * 
 * $Id: plot_bar.php 8 2005-09-13 17:44:21Z sebhtml $
 * 
 * @package Image_Graph
 * @author Jesper Veggerby <pear.nosey@veggerby.dk>
 */

 define("PEAR_PATH", "../../../");
 
require PEAR_PATH.'Image/Graph.php';

// create the graph
$Graph =& Image_Graph::factory('graph', array(400, 300)); 
// add a TrueType font
//$Font =& $Graph->addNew('ttf_font', 'Gothic');
// set the font size to 11 pixels
//$Font->setSize(8);

//$Graph->setFont($Font);

$Graph->add(
    Image_Graph::vertical(
        Image_Graph::factory('title', array('Bar Chart Sample', 12)),        
        Image_Graph::vertical(
            $Plotarea = Image_Graph::factory('plotarea'),
            $Legend = Image_Graph::factory('legend'),
            90
        ),
        5
    )
);   

$Legend->setPlotarea($Plotarea);        

// create the dataset
$Dataset =& Image_Graph::factory('random', array(10, 2, 15, false));
// create the 1st plot as smoothed area chart using the 1st dataset
$Plot =& $Plotarea->addNew('bar', &$Dataset);

// set a line color
$Plot->setLineColor('gray');

// set a standard fill style
$Plot->setFillColor('blue@0.2');

// output the Graph
$Graph->done();
?>
