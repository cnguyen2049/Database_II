
<?php

$stack  = array();
$num = count($_POST['option']);
echo $num;
$i =0;
$column = "";
if(!empty($_POST['option'])) {
    foreach($_POST['option'] as $check ) {
			$stack[] = $check;
			if(++$i === $num){
				$column .= $check ;
			}
			else{
				$column .= $check .",";
			}
             //echoes the value set in the HTML form for each checked checkbox.
                         //so, if I were to check 1, 3, and 5 it would echo value 1, value 3, value 5.
                         //in your case, it would echo whatever $row['Report ID'] is equivalent to.
    }
}
echo $stack[0];

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'hachiman24';
//$column = 'primary_sex';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=movedb", $username, $password);
    /*** echo a message saying we have connected ***/
    echo 'Connected to database<br />';

    /*** The SQL SELECT statement ***/
    $sql = "SELECT " .$column. " FROM account";
	echo $sql;
    /*** fetch into an PDOStatement object ***/
    $stmt = $dbh->query($sql);

    /*** echo number of columns ***/
   // $result = $stmt->fetch(PDO::FETCH_ASSOC);

    /*** loop over the object directly ***/
	/*
	echo "<table border='1'>
	<tr>
	<th> primary_surname</th>
	<th> primary_sex </th>
	</tr>";
*/
echo "<table border='1'>";
if(!empty($_POST['option'])) {
    foreach($_POST['option'] as $test ) {
		echo "<th> " .$test. "</th>";
	}
	echo "</tr>";
}
foreach($_POST['option'] as $values ) {
	$temp = $values;
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {	echo "</tr>";
		$j =0;
		while($j<$num){
		
		echo "<td>" . $account_key = $row[$stack[$j]] . "</td>";
		$j++;
		}
		
    }
	
}
echo "</tr>";
echo "</table>";
    /*** close the database connection ***/
    $dbh = null;
}
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>