<?php
    
    
?>

<!DOCTYPE>
<html lang="en">
    <head>
        <title>SE 157B Project</title>
        <style type="text/css">
            body{
                background-image: url(http://sidsyouth.org/wp-content/uploads/2014/03/background.jpg);
                margin: 0;
                font-family: Helvetica, Arial, sans-serif;
            }
            #OpsMenu
            {
                text-align: center;
                padding: 10px;
            }
            .clear{
                clear: both;
            }
            #reportsCont
            {
                height: 60%;
                overflow: auto;
                padding: 10px;
            }
            #dataCont
            {
                padding: 20px;
            }
            
            #footer
            {
                position: fixed;
                bottom: 0;
                width: 100%;
                background-color: #FFF;
            }
            ul{
                margin: 0;
                padding: 0;
                list-style-type: none;
            }
            .leftMenu
            {
                text-align: center;
                width: 16%;
                border: 1px solid #000;
                float:left;
                background-color: #FFF;
            }
            .leftMenu:hover{
                background-color: #EEE;
                cursor: pointer;
            }
            .active
            {
                border: 2px inset #000;
                background-color: #DDD;
            }
            .hidden
            {
                display: none;
            }
            
            table
            {
                border: 1px solid #000;
                border-collapse: collapse;
                background-color: #FFF;
                margin: auto;
            }
            td, th{
                border: 1px solid #000;
                padding: 5px;
                white-space: nowrap;
            }
            tr:nth-child(odd)
            {
                background-color: #EEE;
            }
            
            h4
            {
                margin: 10px 0 10px 0;
            }
            .attrCont{
                border: 2px solid #000;
                border-radius: 10px;
                width: 180px;
                
            }
			.rightside{
				position:absolute;
				left:400px;
				top:500px;
			}
            .selectAttributes
            {
                border-top: 2px solid #000;
                padding: 10px;
            }
            .center
            {
                text-align: center;
            }
            #ERDiag
            {
                width: 700px;
                height: 500px;
                margin: auto;
                overflow-x: auto;
                overflow-y: hidden;
            }
            #rel
            {
                position: relative;
                height: 500px;
            }
            #accounts
            {
                position: absolute;
                top: 5%;
                left: 3%;
            }
            #branch
            {
                position: absolute;
                top: 5%;
                right: 3%;
            }
            #month
            {
                position: absolute;
                top: 35%;
                left: 3%;
            }
            #product
            {
                position: absolute;
                top: 35%;
                right: 3%;
            }
            #facts
            {
                position: absolute;
                top: 15%;
                left: 35%;
            }
            input[type="radio"]
            {
                width: 1.3em;
                height: 1.3em;
            }
            input[type="radio"]:focus
            {
                border: 1px solid #0000FF;
            }
            #showBaseCube
            {
                position: absolute;
                top: 60%;
                left: 38%;
                padding: 15px;
                background-color: #006363;
                border: 1px solid #000;
                border-radius: 20px;
                color: #FFF;
                font-size: 12pt;
            }
            #showBaseCube:hover
            {
                background-color: #1D7373;
                cursor: pointer;
            }
            p{
                margin-top: 10px;
                margin-bottom: 10px;
            }
        </style>
        <script type="text/javascript" src="jquery-1.9.1.js"></script>
    </head>
    <body>
        <h1 class="center">Bank Account OLAP Operations Project</h1>
        <div id="OpsMenu">
            <ul>
                <li class="leftMenu center" id="defBase">
                    <p>Define Base Cube</p>
                </li>
                <li class="leftMenu center" id="viewTables">
                    <p>View Tables</p>
                    <div class="hidden" id="selectTable">
                        <label>Select table to view:</label><select id="tableSelect">
                            <option>account</option>
                            <option>month</option>
                            <option>branch</option>
                            <option>product</option>\
                            <option>household facts</option>
                        </select>
                    </div>
                </li>
                
                <li class="leftMenu center" id="rollUp">
                    <p>Perform Roll-up</p>
                </li>
                <li class="leftMenu center" id="drillDown">
                    <p>Perform Drill-down</p>
                </li>
                <li class="leftMenu center" id="slice">
                    <p>Perform Slice</p>
                </li>
                <li class="leftMenu center" id="dice">
                    <p>Perform Dice</p>
                </li>
            </ul>
        </div>
        
        <div id="dataCont" class="clear">
            <div id="reportsCont" class="hidden">
            
            </div>
            
            <div id="ERDiag" class = "hidden">
                <p>Select an attribute from the relation(s) and the fact table. Then click the Show Base Cube button to view your defined base cube.</p>
                <div id="rel">
                <div id="accounts" class="attrCont">
                    <p class="center"><input type="checkbox" name="accountTable" value="acounts" id="accountCheck" class="hidden"/>Accounts</p>
                    <div id="selectAccounts" class="selectAttributes">
                        <!--<input type="checkbox" name="acctHier" id="name"/><label id="name">Name</label><br/>-->
                        <input type="radio" name="acctHier" value="account_address" id="address"/><label id="address">Address</label><br/>
                        <input type="radio" name="acctHier" value="account_city" id="city"/><label id="city">City</label><br/>
                        <input type="radio" name="acctHier" value="account_state" id="state"/><label id="state">State</label><br/>
						 <input type="radio" name="acctHier" value="blank" id="none"/><label id="state">None</label><br/>
                    </div>    
                </div>
                
                <div id="branch" class="attrCont">
                    <p class="center"><input type="checkbox" name="branchTable" value="branch" id="branchCheck" class="hidden"/>Branch</p>
                    <div id="selectBranch" class="selectAttributes">
                        <!--<input type="checkbox" name="branchHier" id="branchName"/><label id="branchName">Name</label><br/>-->
                        <input type="radio" name="branchHier" value="branch_address"id="branchAddress"/><label id="branchAddress">Address</label><br/>
                        <input type="radio" name="branchHier" value="branch_city" id="branchCity"/><label id="branchCity">City</label><br/>
                        <input type="radio" name="branchHier" value="branch_state" id="branchState"/><label id="branchState">State</label><br/>
						<input type="radio" name="branchHier" value="blank" id="none"/><label id="state">None</label><br/>
                    </div>    
                </div>
                
                <div id="month" class="attrCont">
                    <p class="center"><input type="checkbox" value="month" name="monthTable" id="monthCheck" class="hidden"/>Month</p>
                    <div id="selectMonth" class="selectAttributes">
                        <input type="radio" name="monthHier" value="month" id="mth"/><label id="mth">Month</label><br/>
                        <input type="radio" name="monthHier" value="quarter" id="quarter"/><label id="quarter">Quarter</label><br/>
                        <input type="radio" name="monthHier" value="year" id="year"/><label id="year">Year</label><br/>
						<input type="radio" name="monthHier" value="blank" id="none"/><label id="state">None</label><br/>
                    </div>    
                </div>
                
                <div id="product" class="attrCont">
                    <p class="center"><input type="checkbox" value="products" name="productTable" id="productCheck" class="hidden"/>Products</p>
                    <div id="selectProducts" class="selectAttributes">
                        <input type="radio" name="prodHier" value="product_description" id="description"/><label id="description">Description</label><br/>
                        <input type="radio" name="prodHier" value="type" id="type"/><label id="type">Type</label><br/>
                        <input type="radio" name="prodHier" value="category" id="category"/><label id="category">Category</label><br/>
						 <input type="radio" name="prodHier"  value = "blank"id="none"/><label id="category">None</label><br/>
                    </div>    
                </div>
                
                <div id="facts" class="attrCont">
                    <p class="center">Household Facts</p>
                    <div id="selectFacts" class="selectAttributes">
                        <input type="radio" name="fact" id="bal" value="primary_balance"/><label id="bal">Balance</label><br/>
                        <input type="radio" name="fact" id="transCnt" value="transaction_count"/><label id="transCnt">Transaction Count</label><br/>
                        <input type="radio" name="fact" id="acctCnt" value="account_count"/><label id="acctCnt">Account Count</label><br/>

                    </div>    
                </div>
				<div id="selector" class ="center">
        <label>Select A concept Hierarchy</label>
					<select id="selectH">
					<option value="accounts">Accounts</option>
					<option value="month">Month</option>
					<option value="branch">Branch</option>
					<option value="products">Products</option>
					</select>
		</div>		
                <button id="showBaseCube">Show Base Cube</button>
                
                </div>
            </div>
			
			
        </div>
		
        <div id="footer" class="center">
            <h4>Programmed by: Clark Stonehocker, Chris Nguyen, and Quang Pham</h4>
        </div>
    </body>
    <script type="text/javascript">
        
        $(".leftMenu").click(function(){
            $(".leftMenu").removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            if (index != 1)
            {
                $("#selectTable, #reportsCont, #ERDiag").hide();
                
            }
            else
            {
                $("#selectTable").show();
                var table = $("#tableSelect option:selected").text();
                $.ajax({
                    url: "get_table.php",
                    type: "POST",
                    data: {tableName:table},
                    success: function(response) {
                        $("#reportsCont").html(response).show();
                    },
                    error: function(response){
                        $("#reportsCont").text("Error");
                    }
                });     
            }
        });
        $("#tableSelect").change(function()
        {
            var table = $("#tableSelect option:selected").text();
            $.ajax({
                url: "get_table.php",
                type: "POST",
                data: {tableName:table},
                success: function(response) {
                    $("#reportsCont").html(response);
                    
                },
                error: function(response){
                    $("#reportsCont").text("Error");
                }
            });                     
        });
        $("#defBase").click(function(){
            $("#ERDiag").show(); 
        });
        $("input[name='acctHier']").change(function(){
           $("#accountCheck").prop('checked', true);
        });
        $("input[name='branchHier']").change(function(){
           $("#branchCheck").prop('checked', true);
        });
        $("input[name='monthHier']").change(function(){
           $("#monthCheck").prop('checked', true);
        });
        $("input[name='prodHier']").change(function(){
           $("#productCheck").prop('checked', true);
        });
        $("#showBaseCube").click(function(){
			var conceptH = $("#selectH").val();
            var accountAttr = $("input[name='acctHier']:checked").val();
            var branchAttr = $("input[name='branchHier']:checked").val();
            var monthAttr = $("input[name='monthHier']:checked").val();
            var prodAttr = $("input[name='prodHier']:checked").val();
            var factAttr = $("input[name='fact']:checked").val();
            alert(conceptH);
            $.ajax({
                url:"build_base_cube.php",
                type:"POST",
                data:{month:monthAttr, account:accountAttr, branch:branchAttr, product:prodAttr, fact:factAttr},
                success: function(response){
                    $("#ERDiag").hide();
                    $("#reportsCont").html(response).show();
                },
                error: function(response){
                    $("#reportsCont").text("Error creating base cube");
                }
            });
                
        });
    </script>
</html>