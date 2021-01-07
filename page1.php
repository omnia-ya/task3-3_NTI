<?php
session_start();
//session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Supermarket Application</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<style>
  		.container{
	  		padding-top:50px; 
	  		padding-right: 200px;
	  		padding-left: 200px;
  		}
  		a{
  			text-decoration: none !important;
  		}
  </style>
</head>
<body>
	<div class="container">
		<h1 style="text-align:center"><span style="color:#17a2b8">Supermaeket</span> Application</h1>
        <form method="POST"  style="margin-top: 40px;">
            <div class="form-group">
                <input name="client" value="<?php echo(isset($_POST['client']) ? $_POST['client']:""); ?>" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Client name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">City:</label>
                    <select name="city" class="form-control" value="<?php echo(isset($_POST['city']) ? $_POST['city']:""); ?>">
                        <option value="Cairo" <?php echo(isset($_POST['city']) && $_POST['city']=='Cairo' ? 'selected' :''); ?>>Cairo</option>
                        <option value="Giza" <?php echo(isset($_POST['city']) && $_POST['city']=='Giza' ? 'selected' :''); ?>>Giza</option>
                        <option value="Alex" <?php echo(isset($_POST['city']) && $_POST['city']=='Alex' ? 'selected' :''); ?>>Alex</option>
                        <option value="Others"> <?php echo(isset($_POST['city']) && $_POST['city']=='Others' ? 'selected' :''); ?>Others</option>
                    </select>
            </div>
            <div class="form-group">
                <input name="products" value="<?php echo(isset($_POST['products']) ? $_POST['products']:""); ?>" type="text" class="form-control" id="exampleInputPassword1" placeholder="Number of products">
            </div>
            <button type="submit" name="submit" class="btn btn-info btn-block">Enter Products</button>
        <!--</form> !-->
        <?php
            if(!empty($_POST)){
                //if(isset($_POST['submit'])){
                //}
                if(!is_numeric($_POST['products'])){
                    echo "<div class='alert alert-danger' style='margin-top:20px'>Please enter a correct number</div>";
                }
                if(is_numeric($_POST['client'])){
                    echo "<div class='alert alert-danger' style='margin-top:20px'>Please enter a correct name</div>";  
                }
                if(!$_POST['client'] or !$_POST['city'] or !$_POST['products'] or !is_numeric($_POST['products']) or is_numeric($_POST['client'])){
                    echo "<div class='alert alert-danger' style='margin-top:20px'>Please enter the data</div>";
                }
                else{
                echo '<table class="table">
                <thead>
                  <tr>
                    <th scope="col" style="width:260px">Product Name</th>
                    <th scope="col" style="width:250px" >Price</th>
                    <th scope="col">Quantity</th>
                  </tr>
                </thead>
              </table>';
                for($i=1;$i<=$_POST['products'];$i++){
                    echo '
                    <div class="row" style="margin-top:20px">
                        <div class="col">
                        <input value="';
                        echo(isset($_POST["nameP$i"]) ? $_POST["nameP$i"]:"");
                        echo '" name="nameP'.$i.'" type="text" class="form-control">
                        </div>
                        <div class="col">
                        <input value="';
                        echo(isset($_POST["price$i"]) ? $_POST["price$i"]:"");
                        echo '" name="price'.$i.'" type="text" class="form-control">
                        </div>
                        <div class="col">
                        <input value="';
                        echo(isset($_POST["quantity$i"]) ? $_POST["quantity$i"]:"");
                        echo '" name="quantity'.$i.'" type="text" class="form-control">
                        </div>
                    </div>';
                    
                }
                
                echo '<button type="submit" name="submit2" class="btn btn-primary btn-block" style="margin-top:20px;margin-bottom:20px">Calculate</button>';
                // if($_POST["nameP$i"] =="" or $_POST["price$i"]=="" or $_POST["quantity$i"]==""){
                //    echo "hi";     
                // }
                if(isset($_POST['submit2'])){
                    
                    //delivary
                    if($_POST['city']=='Cairo'){
                        $delivary = 0;
                    }
                    else if($_POST['city']=='Giza'){
                        $delivary = 30; 
                    }
                    else if($_POST['city']=='Alex'){
                        $delivary = 60; 
                    }
                    else if($_POST['city']=='Others'){
                        $delivary = 100; 
                    }
                   
                    echo '<table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Sub Total</th>
                      </tr>
                    </thead>
                    <tbody>';
                    $totalArray= [];
                    for($i=1;$i<=$_POST["products"];$i++){
                        echo '<tr>
                                <td>'.$_POST["nameP$i"].'</td>
                                <td>'.$_POST["price$i"].'</td>
                                <td>'.$_POST["quantity$i"].'</td>
                                <td>'.$totalP = (int)$_POST["price$i"]*(int)$_POST["quantity$i"].'</td>';
                                array_push($totalArray,$totalP);
                                $total = array_sum($totalArray);
                            echo '</tr>';        
                     }
                   //disscount 
                    if($total < 1000){
                        $discountValue = $total * 0;
                    }
                    else if($total < 3000){
                        $discountValue = $total * 0.1;
                    }
                    else if($total < 4500){
                        $discountValue = $total * 0.15;
                    }
                    else if($total > 4500){
                        $discountValue = $total * 0.2;
                }
                  //echo $total;
                    echo '<tr>
                        <th scope="row">Client Name</th>
                        <td colspan="3">'.$_POST["client"].'</td>
                      </tr>
                      <tr>
                        <th scope="row">City</th>
                        <td colspan="3">'.$_POST["city"].'</td>
                      </tr>
                      <tr>
                        <th scope="row">Total</th>
                        <td colspan="3">'.$total.'</td>
                      </tr>
                      <tr>
                        <th scope="row">Disscount Value</th>
                        <td colspan="3">'.$discountValue.' EGP</td>
                      </tr>
                      <tr>
                        <th scope="row">Total after Disscount</th>
                        <td colspan="3">'.$total - $discountValue.' EGP</td>
                      </tr>
                      <tr>
                        <th scope="row">Delivary</th>
                        <td colspan="3">'.$delivary.' EGP</td>
                      </tr>
                      <tr style="color:red">
                        <th scope="row">Total Net</th>
                        <td colspan="3" style="text-align:right;padding-right:90px"><b>'.$delivary + ($total - $discountValue).' EGP</b></td>
                      </tr>
                    </tbody>
                  </table>';
                }
            }
            }
        ?>
        </form>
	</div>
</body>
</html>