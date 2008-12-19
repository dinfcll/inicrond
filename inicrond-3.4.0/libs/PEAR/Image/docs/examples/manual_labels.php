<?php
/**
 * Usage example for Image_Graph.
 * 
 * Main purpose: 
 * Demonstrate how to manually set axis labels
 * 
 * Other: 
 * None specific
 * 
 * $Id: manual_labels.php 8 2005-09-13 17:44:21Z sebhtml $
 * 
 * @package Image_Graph
 * @author Jesper Veggerby <pear.nosey@veggerby.dk>
 */

include 'Image/Graph.php';

// create the graph
$Graph =& Image_Graph::factory('graph', array(500, 200));
// add a TrueType font
$Font =& $Graph->addNew('ttf_font', 'Gothic');
// set the font size to 11 pixels
$Font->setSize(8);

$Graph->setFont($Font);

$Plotarea =& $Graph->addNew('plotarea');
  
$Dataset =& Image_Graph::factory('random', array(8, 1, 10));
$Plot =& $Plotarea->addNew('line', &$Dataset);

$LineStyle =& Image_Graph::factory('Image_Graph_Line_Dashed', array('red', 'transparent'));
//$Plot->setLineColor('red');
$Plot->setLineStyle($LineStyle);

$AxisY =& $Plotarea->getAxis('y');
$AxisY->setLabelInterval(array(2, 4, 9));

// output the Graph
$Graph->done();
?>
