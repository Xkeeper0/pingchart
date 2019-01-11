<!doctype html>
<html>
<head>
	<title>network monitor</title>
	<style>

* {
    -ms-interpolation-mode: nearest-neighbor;
    image-rendering: pixelated;
}
html, body {
	background: black; color: #fff; font-family: Verdana, sans-serif;
	margin-bottom: 2em;
}
* { text-align: center; }

a {
	color: #88f;
}
table {
	border-collapse: collapse; cell-spacing: 0; border-spacing: 0; margin: 0 auto;
}
td, tr {
	padding: 0; margin: 0; border: none;
}
img {
	border: 0; margin: 0; padding: 0; display: block;
}

td {
	border-top: 1px solid black;
	padding: 0 0 0 4px;
	border-right: 1px solid #888;
}

table.chart {
	table-layout:	fixed;
	width:		800px;
	max-width:	100%;
	position:	fixed;
	bottom:		0;
	left:		0;
	right:		0;
	margin:		0 auto;
}

table.chart td {
	border-right: 2px solid black;
	padding: 0.25em;
}

table.chart td#f1 {	background: linear-gradient(to right, black, #00ff00); }
table.chart td#f2 {     background: linear-gradient(to right, #00ff00, #ffff00); }
table.chart td#f3 {     background: #ff0000; }


label { position: fixed; top: -1px; left: -1px; background: black; color: white; border: 1px solid gray;
display: block; font-size: 60%; padding: 0.25em 0.5em;}
input { display: none; }
input:checked ~ table {
	filter: brightness(140%) contrast(300%);
}
	</style>
</head>
<body>
<label for="contrast">toggle high contrast</label>
<input type="checkbox" id="contrast">
<table>
	<thead>
		<tr><th>home</th><th>gateway</th><th>google</th></tr>
	</thead>
	<tbody>
<?php


	$x	= scandir(".");
	if (isset($_GET['list'])) {
		foreach ($x as $f) {
			print "<tr><td colspan='3'><a href='$f'>$f</a></td></tr>\n";
		}
		print "</tbody></table></body></html>";
		die();
	}
	$ds	= [];

	$min	= date("Y-m-d", time() - 86400 * 2);
	if (isset($_GET['all'])) {
		$min = "0000-00-00";
	} else {
		echo "
		<tr><td colspan='3'><a href='?all=yes'>show all</a></td></tr>";
	}

	foreach ($x as $f) {
		if (substr($f, 0, 4) === "home") {
			$date	= substr($f, 5, 10);
			if ($date >= $min) {
				$ds[]	= $date;
			}
		}
	}

	foreach ($ds as $day) {
		echo "
		<tr><td>". pd("home", $day) ."</td><td>". pd("gateway", $day) ."</td><td>". pd("google", $day) ."</td></tr>";
	}

	//print_r($ds);

	function pd($f, $d) {
		$fn	= $f .'-'. $d .'.png';
		if (file_exists($fn)) {
			if (substr($d, 0, 8) === "2018-12-2" || substr($d, 0, 8) === "2018-12-3" || substr($d, 0, 4) === "2019") {
				$h	= "height='576'";
			} else {
				$h	= "height='288'";
			}
			return "<img src='$fn' xwidth='640' xheight='576' title='$f, $d' alt='$f, $d'>";
		} else {
			return "&nbsp;";
		}
	}
?>
	</tbody>
        <tfoot>
                <tr><th>home</th><th>gateway</th><th>google</th></tr>
        </tfoot>
</table>

<table class="chart">
	<tr>
		<td id="f1" style='width: 50%;'>
			<span style='color: white; float: left;'>0ms</span>
			<span style='color: black; float: right;'>100ms</span>
		</td>
		<td id="f2" style='width: 50%;'>
		<!--	<span style='color: black; float: left;'>100ms</span> -->
			<span style='color: black; float: right;'>500ms</span>
		</td>
		<td id="f3" style='width: 50px;'>lost</td>
	</tr>
</table>

</body>
</html>

