<?php
session_start();
?>
<!DOCtype html>

<!--
1. TESTING DEPENDANT BETWEEN SKILL AND TEAM
3. TEAM SELECTION NEEDS TO DISPLAY TABLE AND IS NOT
2. SEPERATION OF SELECTIONS NEEDS TO BE CLEANED UP
-->

<?php
mysql_connect('127.0.0.1', 'root', 'd1226605');
mysql_select_db('skills');
?>
<html>
<head>
<title>Test skill team dependant</title>
</head>
<body>

<p>Select the skills you are looking for</p>
<?php

        $sql = "SELECT skill FROM skills ORDER BY skill";
        $rs = mysql_query($sql);

                echo "<form name='skill' method='post'>";
                echo "<select name='select[]' multiple='multiple' size='50'>";
                while($row = mysql_fetch_array($rs))    {
                echo "<option value='".$row['skill']."'>".$row['skill']."</option>";
                }
?>
                </select>

                <input type="submit" value="submit">
                </form>

<?php
        $selected = array();
        foreach ((array) $_POST['select'] as $skillselect)      {
        $selected[] = "'".mysql_real_escape_string($skillselect)."'";
        $selected_joined = join(', ', $selected);
        echo $selected_joined;
        echo "<br>";
        }

if(isset($selected_joined))      {
        $cv = mysql_query("CREATE OR REPLACE VIEW test AS SELECT empname, skill, pro, desire, en  FROM login L INNER JOIN users U ON L.id = U.en WHERE skill in ($selected_joined)");
        mysql_query($cv);
        $msql = "SELECT empname, skill, pro, desire FROM test";
        $record = mysql_query($msql);

                echo "<table border=1 align=center>";
                        echo "<tr>";
                        echo "<th>Name</th>";
                        echo "<th>Skill</th>";
                        echo "<th>Proficiency</th>";
                        echo "<th>Desired Level</th>";
                        echo "</tr>";
                                echo "<tr>";
                                while($rws = mysql_fetch_array($record)) {
                                echo "<td>".$rws[empname]."</td>";
                                echo "<td>".$rws[skill]."</td>";
                                echo "<td>".$rws[pro]."</td>";
                                echo "<td>".$rws[desire]."</td>";
                                echo "</tr>";
                		}
					$cv3 = mysql_query("CREATE OR REPLACE VIEW test3 AS SELECT skill, pro, desire, en FROM test T INNER JOIN login L WHERE T.empname = L.empname");
					mysql_query($cv3);
        				$sql2 = "SELECT DISTINCT teamname FROM team TM INNER JOIN test3 TES ON TM.employee = TES.en";
        				$rs2 = mysql_query($sql2);

                				echo "<form name='team' method='post'>";
                				echo "<select name='select2[]' multiple='multiple'>";
                        			while($row2 = mysql_fetch_array($rs2))  {
                        			echo "<option value='".$row2['teamname']."'>".$row2['teamname']."</option>";
       							 }
	 					echo "</select>";	
						echo "<input type='submit' value='submit'>";
						echo "</form>";
$_SESSION['skill'] = $selected_joined;
echo $_SESSION['skill'];
}else{
echo $_SESSION['skill'];
$selected_joined = $_SESSION['skill'];

				$sql2 = "SELECT DISTINCT teamname FROM team ORDER BY teamname";
				$rs2 = mysql_query($sql2);

				        echo "<form name='team2' method='post'>";
				        echo "<select name='select3[]' multiple='multiple'>";
					while($row2 = mysql_fetch_array($rs2)) {
				        echo "<option value='".$row2['teamname']."'>".$row2['teamname']."</option>";
					}
					echo "</select>";
					echo "<input type='submit' value='submit'>";
					echo "</form>";

						if(isset($_POST['select3'])) {
						session_unset();
						$selected3 = array();
						foreach ((array) $_POST['select3'] as $teamselect3) {
						$selected3[] = "'".mysql_real_escape_string($teamselect3)."'";
						$selected_joined3 = join(', ', $selected3);
						}							
                                                        $cv4 = mysql_query("CREATE OR REPLACE VIEW test2 AS SELECT en, skill, pro, desire, teamname FROM users U INNER JOIN team T WHERE U.en = T.employee");
                                                        mysql_query($cv4);
                                                        $msql4 = "SELECT teamname, empname, skill, pro FROM test2 TE JOIN login L ON TE.en = L.id WHERE teamname in ($selected_joined3)";
                                                        $record4 = mysql_query($msql4);

                                                                echo "<table border=1 align=center>";
                                                                echo "<tr>";
                                                                echo "<th>Team</th>";
                                                                echo "<th>Name</th>";
                                                                echo "<th>Skill</th>";
                                                                echo "<th>Proficiency</th>";
                                                                echo "</tr>";
                                                                        echo "<tr>";
                                                                        while($rws4 = mysql_fetch_array($record4)) {
                                                                        echo "<td>".$rws4[teamname]."</td>";
                                                                        echo "<td>".$rws4[empname]."</td>";
                                                                        echo "<td>".$rws4[skill]."</td>";
                                                                        echo "<td>".$rws4[pro]."</td>";
                                                                        echo "</tr>";
								}
							}

						$selected2 = array();
       						foreach ((array) $_POST['select2'] as $teamselect2)     {
       						$selected2[] = "'".mysql_real_escape_string($teamselect2)."'";
       						$selected_joined2 = join(', ', $selected2);
               					echo $selected_joined2;
                                                               }
       						if(isset($selected_joined2))       {
  						$cv2 = mysql_query("CREATE OR REPLACE VIEW test2 AS SELECT en, skill, pro, desire, teamname FROM test3 TES INNER JOIN team T WHERE TES.en = T.employee");
						mysql_query($cv2);
        					$msql2 = "SELECT teamname, empname, skill, pro FROM test2 TE JOIN login L ON TE.en = L.id WHERE teamname in ($selected_joined2)";
        					$record2 = mysql_query($msql2);

                					echo "<table border=1 align=center>";
                        				echo "<tr>";
                        				echo "<th>Team</th>";
                        				echo "<th>Name</th>";
                        				echo "<th>Skill</th>";
                        				echo "<th>Proficiency</th>";
                        				echo "</tr>";
                                				echo "<tr>";
                                				while($rws2 = mysql_fetch_array($record2)) {
                                				echo "<td>".$rws2[teamname]."</td>";
                                				echo "<td>".$rws2[empname]."</td>";
                                				echo "<td>".$rws2[skill]."</td>";
                                				echo "<td>".$rws2[pro]."</td>";
                                				echo "</tr>";
                                        				}
                                       					}
}

?>
</body>
</html>
