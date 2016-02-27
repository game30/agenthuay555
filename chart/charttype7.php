<?php 
include (dirname(__FILE__)."/phpchartdir.php");
include "../config/config_db.php";
include "../config/config.inc.php";

$dbconn = new connect_db;
$mysqli = $dbconn->conn();
$strSQL = "SELECT * ,SUM(bill_bet) AS betplay
			FROM tb_bill 
			WHERE lot_type_id = 7
			GROUP BY tb_bill.bill_number ";
$res = $mysqli->query($strSQL);
$numarray = 0;
$data = array();
$labels = array();

while($row = $res->fetch_array(MYSQLI_ASSOC))
{
	$data[$numarray] = $row['betplay'];
	$labels[$numarray] = ''.$row['bill_number'];
	$numarray ++;
}
# Create a XYChart object of size 300 x 180 pixels, with a pale yellow (0xffffc0) background, a
# black border, and 1 pixel 3D border effect.
$c = new XYChart(800, 250, Transparent,	Transparent, 0);
$c->addTitle("รายงานการซื้อหวย 3 ตัวบน", "tahomabd.ttf", 10, 0x0000ff);
# Set the plotarea at (45, 35) and of size 240 x 120 pixels, with white background. Turn on both
# horizontal and vertical grid lines with light grey color (0xc0c0c0)
$c->setPlotArea(60, 30, 700,180, 0xffffff, -1, -1, 0xc0c0c0, -1);
# Add a legend box with horizontal layout above the plot area at (70, 35). Use 12pt Arial font,
# transparent background and border, and line style legend icon.
$b = $c->addLegend(70, 35, false, "tahoma.ttf", 12);
$b->setBackground(Transparent, Transparent);
$b->setLineStyleKey();

# Set axis label font to 12pt Arial
$c->xAxis->setLabelStyle("tahoma.ttf", 10);

# Set the x and y axis stems to transparent, and the x-axis tick color to grey (0xaaaaaa)
$c->xAxis->setColors(Transparent, TextColor, TextColor, 0xaaaaaa);
$c->yAxis->setColors(Transparent);

# Set the major/minor tick lengths for the x-axis to 10 and 0.
$c->xAxis->setTickLength(10, 0);

# For the automatic axis labels, set the minimum spacing to 80/40 pixels for the x/y axis.
$c->xAxis->setTickDensity(80);
$c->yAxis->setTickDensity(40);
$c->yAxis->setTitlePos(10);

# Add a title to the y axis using dark grey (0x555555) 14pt Arial font
$c->yAxis->setTitle("(บาท)", "tahoma.ttf", 10, 0x555555);

# Add a line layer to the chart with 3-pixel line width
$layer = $c->addLineLayer2();
$layer->setLineWidth(3);

# Add 3 data series to the line layer
$dataSetObj = $layer->addDataSet($data, 0x0000ff, "");

/************/
# Set the labels on the x axis
$c->xAxis->setLabels($labels);
$c->xAxis->setLabelStyle("tahoma.ttf", 8, 0x000000,45);
$c->xAxis->setTitle("(เลข)", "tahoma.ttf", 10, 0x555555);
$c->xAxis->setTitlePos(6);

$dataSetObj->setDataSymbol(CircleShape, 7);



# Enable data label on the data points. Set the label format to nn%.
$layer->setDataLabelFormat("{value|,.} บาท");
$layer->setDataLabelStyle("tahoma.ttf", 7, 0x000000,45);
/***********/

# Output the chart
header("Content-type: image/png");
print($c->makeChart2(PNG));
?>