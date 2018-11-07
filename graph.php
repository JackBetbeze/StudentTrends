<?php
require_once ('src/jpgraph.php');
require_once ('src/jpgraph_bar.php');

session_start();
$chart_data1 = $_SESSION['g1_graph'];
$chart_data2 = $_SESSION['g2_graph'];
$chart_data3 = $_SESSION['g3_graph'];
$vals = $_SESSION['vals'];
$periods = $_SESSION['periods'];
$title = $_SESSION['title'];

$graph = new Graph(600,380,'auto');
$graph->SetScale("textlin",0,20);

$theme_class=new UniversalTheme;
$graph->SetTheme($theme_class);

$graph->yaxis->SetTickPositions(array(0,5,10,15,20), array(2.5,7.5,12.5,17.5));;
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($vals);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

if ($periods) {
  $b1plot = new BarPlot($chart_data1);
  $b2plot = new BarPlot($chart_data2);
}
$b3plot = new BarPlot($chart_data3);

if ($periods) {
  $gbplot = new GroupBarPlot(array($b1plot,$b2plot,$b3plot));
  $graph->Add($gbplot);
} else {
  $graph->Add($b3plot);
}


if ($periods) {
  $b1plot->SetColor("white");
  $b1plot->SetFillColor("#cc1111");
  $b1plot->SetLegend('Grading Period 1');
  $b2plot->SetColor("white");
  $b2plot->SetFillColor("#11cccc");
  $b2plot->SetLegend('Grading Period 2');
}
$b3plot->SetColor("white");
$b3plot->SetFillColor("#1111cc");
$b3plot->SetLegend('Final Grade');
$graph->legend->SetPos(0.5,0.95,'center','bottom');
$graph->title->Set($title);
$graph->Stroke();

unset($_SESSION['g1_graph']);
unset($_SESSION['g2_graph']);
unset($_SESSION['g3_graph']);
unset($_SESSION['vals']);
unset($_SESSION['periods']);
unset($_SESSION['title']);
?>
