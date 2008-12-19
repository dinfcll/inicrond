<?php
/**
 * Usage example for Image_Graph.
 * 
 * Main purpose: 
 * Demonstrate gradient fillings
 * 
 * Other: 
 * None specific
 * 
 * $Id: gradient_step.php 8 2005-09-13 17:44:21Z sebhtml $
 * 
 * @package Image_Graph
 * @author Jesper Veggerby <pear.nosey@veggerby.dk>
 */

include 'Image/Graph.php';
include 'Image/Graph/Driver.php';

$Driver =& Image_Graph_Driver::factory('png',
    array(
        'width' => 400,
        'height' => 200
    )
);            
    

// create the graph
$Graph =& Image_Graph::factory('graph', &$Driver);

$Font =& $Graph->addNew('ttf_font', 'Gothic');
$Font->setSize(8);

$Graph->setFont($Font);

$Graph->add(
    Image_Graph::vertical(
        Image_Graph::factory('title', array('Gradient Filled Step Chart', 11)),
        Image_Graph::horizontal(
            $Plotarea = Image_Graph::factory('plotarea'),
            Image_Graph::factory('title', array('Anybody recognize?', array('size' => 7, 'color' => 'gray@0.6', 'angle' => 270))),
            98
        ),
    5)
);

$Grid =& $Plotarea->addNew('line_grid', array(), IMAGE_GRAPH_AXIS_Y);
$Grid->setLineColor('white@0.4');           

$Dataset =& Image_Graph::factory('dataset');
$Dataset->addPoint(1, 20);
$Dataset->addPoint(2, 10);
$Dataset->addPoint(3, 35);
$Dataset->addPoint(4, 5);
$Dataset->addPoint(5, 18);
$Dataset->addPoint(6, 33);
$Plot =& $Plotarea->addNew('step', &$Dataset);

$Fill =& Image_Graph::factory('gradient', array(IMAGE_GRAPH_GRAD_VERTICAL, 'darkgreen', 'white'));
$Plot->setFillStyle($Fill);

$Fill =& Image_Graph::factory('gradient', array(IMAGE_GRAPH_GRAD_VERTICAL, 'yellow', 'darkred'));
$Plotarea->setFillStyle($Fill);

$AxisY =& $Plotarea->getAxis(IMAGE_GRAPH_AXIS_Y);
$AxisY->forceMaximum(40);
$AxisY->setLabelInterval(10);

$Graph->setBackgroundColor('green@0.2');
$Graph->setBorderColor('black');
$Graph->setPadding(10);

$Plot->setBorderColor('black');      
                
// output the graph
$Graph->done();
?>