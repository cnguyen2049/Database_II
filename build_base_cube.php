<?php
    $mysqli = new mysqli('localhost', 'root', 'hachiman24', 'movedb');
    if($mysqli->connect_errno)
    {
        print("Error connecting" . $myqli->connect_error);
    }
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $accountAttr = $_POST['account'];
        $branchAttr = $_POST['branch'];
        $monthAttr = $_POST['month'];
        $prodAttr = $_POST['product'];
        $factAttr = $_POST['fact'];
        $fact;
        $comma = ", ";
        $headers = "";
      
        $query = "SELECT ";
        if(isset($monthAttr))
        {
			if($monthAttr!="blank")
			{
            $query .= $monthAttr . $comma;
            $headers .= "<th>$monthAttr</th>";
			}
         
        }
        if(isset($accountAttr))
        {
			if($accountAttr!="blank")
			{
            $query .= $accountAttr . $comma;
            $headers .= "<th>$accountAttr</th>";
			}
        }
        if(isset($branchAttr))
        {
			if($branchAttr!="blank")
			{
            $query .= $branchAttr . $comma;
            $headers .= "<th>$branchAttr</th>";
			}
        }
        if(isset($prodAttr))
        {
			if($prodAttr!="blank")
			{
            $query .= $prodAttr . $comma;
            $headers .= "<th>$prodAttr</th>";
			}
        }
        if(isset($factAttr))
        {
           
            switch($factAttr)
            {
                case 'primary_balance':
                    $query .= "sum($factAttr) AS TotalBalance";
                    $fact = "TotalBalance";
                    $headers .= "<th>Total Balance</th>";
                    break;
                case 'transaction_count':
                    $query .= "sum($factAttr) AS NumOfTransactions";
                    $fact = "NumOfTransactions";
                    $headers .= "<th>Num of Transactions</th>";
                    break;
                case 'account_count':
                    $query .= "sum($factAttr) AS NumOfAccounts";
                    $fact = "NumOfAccounts";
                    $headers .= "<th>Num of Accounts</th>";
                    break;
            }
        }
        
        
        
        
        $query .= " FROM month, account, branch, product, household_facts";
        $query .= " WHERE month.month_key = household_facts.month_key AND account.account_key = household_facts.account_key
                        AND branch.branch_key = household_facts.branch_key AND product.product_key = household_facts.product_key Group By quarter";
        
        echo "<p>$query</p>";
        $result = $mysqli->query($query);
        
        echo "<table>
                <tr>" . $headers . "</tr>";
                            
        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
            if(isset($monthAttr))
            {
				if($monthAttr!="blank")
				{
					echo  "<td>" . $row[$monthAttr] . "</td>"; 
				}
            }
            if(isset($accountAttr))
            {
				if($accountAttr!="blank")
				{
                echo "<td>" . $row[$accountAttr] . "</td>";
				}
            }
            if(isset($branchAttr))
            {
				if($branchAttr!="blank")
				{
					echo "<td>" . $row[$branchAttr] . "</td>";
				}
            }
            if(isset($prodAttr))
            {
				if($prodAttr!="blank")
				{
					echo "<td>" . $row[$prodAttr] . "</td>";
				}
            }
            if(isset($factAttr))
            {
                echo "<td>" . $row[$fact] . "</td>";
            }
            
            
        }
        echo "</table>";
        
        
        
        $mysqli->close();
    }
?>